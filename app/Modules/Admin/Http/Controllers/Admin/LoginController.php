<?php

namespace App\Modules\Admin\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Modules\Tratis\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    // 登录成功跳转
    public $redirectTo = '/admin/index';

    // 展示登录页面
    public $show_login_path = 'admin::admin.login.showLoginForm';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    /**
     * 登录页面展示
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function showLoginForm(Request $request)
    {
        // 记忆回源路由
        if (!session()->has('url.intended')) {
            session(['url.intended' => url()->previous()]);
        }

        return view($this->show_login_path);
    }


    protected function attemptLogin(Request $request)
    {
        return collect(['username', 'email', 'mobile'])->contains(function ($value) use ($request) {
            $account = $request->get('username');
            $password = $request->get('password');
            return $this->guard()->attempt([$value => $account, 'password' => $password, 'locked' => 0], $request->filled('remember'));
        });
    }

    /**
     * 登录
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response|void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string',
            'captcha' => 'required|captcha'
        ], [
            'captcha.required' => trans('validation.required'),
            'captcha.captcha' => trans('validation.captcha'),
        ]);

        if (method_exists($this, 'hasTooManyLoginAttempts') && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        // 登录逻辑
        if ($this->attemptLogin($request)) {

            $user = \auth()->guard('admin')->user();

            $user->session_token = \auth()->guard('admin')->getSession()->getId();
            $user->last_ip = $request->ip();
            $user->login_numbers = $user->login_numbers + 1;
            $user->save();

            if ($request->wantsJson()) {
//                $url = session('url.intended') ?? $this->redirectTo;
                $url = $this->redirectTo;
                return response()->json(['code' => 200, 'msg' => '登录成功!', 'redirect' => $url]);
            }

            return $this->sendLoginResponse($request);
        }

        // 增加错误次数
        $this->incrementLoginAttempts($request);

        // 登录失败
        return $this->sendFailedLoginResponse($request);
    }


    /**
     * 退出登陆
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @author 王凯
     */
    public function logout(Request $request)
    {
        \Auth::guard('admin')->logout();

        session()->invalidate();

        return redirect('/admin/login');
    }
}
