<?php

namespace App\Modules\Pay\Http\Controllers;

use App\Modules\Admin\Models\Category;
use App\Modules\Admin\Models\CategoryGroup;
use App\Modules\Pay\Models\Order;
use App\Modules\Pay\Models\WeChatUser;
use EasyWeChat\Factory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WeChatController extends Controller
{
    // 请求微信接口的公用配置, 所以单独提出来
    public function token()
    {
        $app = Factory::officialAccount(config('wechat.official_account.default'));

        $response = $app->server->serve();

        return $response->send();
    }

    /**
     * 授权回调
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function oauth_callback()
    {
        $app = Factory::officialAccount(config('wechat.official_account.default'));

        $oauth = $app->oauth;

        // 获取 OAuth 授权结果用户信息
        $user = $oauth->user();

        $original = $user->getAttribute('original');

        // 查询用户
        $user = WeChatUser::query()->where('openid', $original['openid'])->first();

        if (empty($user)) {
            $user = WeChatUser::create([
                'nickname' => $original['nickname'],
                'openid' => $original['openid'],
                'avatar' => $original['headimgurl']
            ]);
        }

        session(['wechat_user' => $user]);

        $targetUrl = empty(session('target_url')) ? '/' : session('target_url');

        return redirect()->to($targetUrl);
    }
}
