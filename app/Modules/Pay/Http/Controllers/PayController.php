<?php

namespace App\Modules\Pay\Http\Controllers;

use App\Modules\Admin\Models\Category;
use App\Modules\Admin\Models\CategoryGroup;
use App\Modules\Pay\Models\Order;
use EasyWeChat\Factory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PayController extends Controller
{

    // 请求微信接口的公用配置, 所以单独提出来
    private function payment()
    {
        $config = [
            // 必要配置, 这些都是之前在 .env 里配置好的
            'app_id' => config('wechat.payment.default.app_id'),
            'mch_id' => config('wechat.payment.default.mch_id'),
            'key' => config('wechat.payment.default.key'),   // API 密钥
            'notify_url' => config('wechat.payment.default.notify_url'),   // 通知地址
        ];

        // 这个就是 easywechat 封装的了, 一行代码搞定, 照着写就行了
        $app = Factory::payment($config);

        return $app;
    }

    /**
     * 首页
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function index(Request $request)
    {
        $app = Factory::officialAccount(config('wechat.official_account.default'));

        $oauth = $app->oauth;

        // 未登录
        if (empty(session('wechat_user'))) {

            session(['target_url' => '/pay']);

            return $oauth->redirect();
        }

        $class = CategoryGroup::query()
            ->where('name', 'project')
            ->with('categories')
            ->first();

        $categories = $class->categories;

        $level1 = $categories->filter(function ($item) {
            return $item->level == 1;
        })->pluck('nickname', 'id');


        $level2 = $categories->filter(function ($item) {
            return $item->level == 2;
        })->groupBy('pid');


        foreach ($level2 as $key => $item) {
            $level2[$key] = $item->pluck('nickname', 'id')->toArray();
        }


        return view('pay::pay', compact('level1', 'level2'));
    }

    /**
     * 支付
     *
     * @param Request $request
     * @return array|\EasyWeChat\Kernel\Support\Collection|\Illuminate\Http\JsonResponse|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function pay(Request $request)
    {
        $project = Category::query()->where('level', 1)->find($request->input('project_id'));

        if (empty($project)) {
            return response()->json(['code' => -1, 'message' => '项目类型非法']);
        }

        $class = Category::query()->where('level', 2)->find($request->input('class_id'));

        if (empty($class)) {
            return response()->json(['code' => -1, 'message' => '班型类型非法']);
        }

        // 用户
        $user = session('wechat_user');

        // 价格
        $price = $request->get('price');

        if (empty($price) || $price * 100 < 1) {
            return response()->json(['code' => -1, 'message' => '输入的金额非法']);
        }

        $order = Order::create([
            'title' => $project->nickname . '_' . $class->nickname . '_' . '缴费' . '_' . $price,
            'user_id' => $user->id,
            'out_trade_no' => date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT) . rand(1000, 9999),
            'total_fee' => $price * 100,
            'status' => 0,
            'class_id' => $class->id,
            'project_id' => $project->id,
            'place_order_at' => now(),
        ]);

        // 微信支付实例
        $payment = $this->payment();

        $total_fee = $price * 100;//微信支付以分为单位

        //统一下单
        $result = $payment->order->unify([
            'body' => '微信支付',
            'out_trade_no' => $order['out_trade_no'],
            'total_fee' => $total_fee,
            'trade_type' => 'JSAPI',
            'openid' => $user->openid,
        ]);

        if (isset($result['result_code']) && $result['result_code'] == 'SUCCESS' && $result['return_code'] == 'SUCCESS') {
            $prepayId = $result['prepay_id'];
            $jssdk = $payment->jssdk;
            $config = $jssdk->sdkConfig($prepayId);
            $config['timeStamp'] = $config['timestamp'];
            return response()->json(['code' => 0, 'data' => $config]);
        } else {
            return response()->json(['code' => -1, 'message' => '支付失败']);
        }
    }

    /**
     * 微信测评支付回调方法，修改订单状态
     * @return mixed
     */
    public function notify()
    {
        info("有回调");

        $payment = \EasyWeChat::payment();

        $response = $payment->handlePaidNotify(function ($message, $fail) {
            if ($message['return_code'] === 'SUCCESS' && $message['result_code'] === 'SUCCESS') {

                $order = Order::query()
                    ->where('out_trade_no', $message['out_trade_no'])
                    ->first();

                if (empty($order)) {
                    info("订单失踪");
                    info($message);
                    info('----------');
                    return true;
                }

                $order->status = 1;
                $order->payment_at = now();
                $order->save();
                return true;
            } else {
                return $fail('失败');
            }
        });

        return $response;
    }
}
