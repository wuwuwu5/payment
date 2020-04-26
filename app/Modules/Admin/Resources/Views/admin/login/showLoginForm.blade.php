@extends('admin::layout.app')
@push('styles')
    <link rel="stylesheet" href="{{admin_asset('/style/login.css')}}">

@endpush
@section('content')
    <div class="layadmin-user-login layadmin-user-display-show" id="LAY-user-login" style="display: none;">

        <div class="layadmin-user-login-main">
            <div class="layadmin-user-login-box layadmin-user-login-header">
                <h2>@cms('system_name')</h2>
                <p>@cms('system_desc')</p>
            </div>
            <div class="layadmin-user-login-box layadmin-user-login-body layui-form">
                <div class="layui-form-item">
                    <label class="layadmin-user-login-icon layui-icon layui-icon-username"
                           for="LAY-user-login-username"></label>
                    <input type="text" name="username" id="LAY-user-login-username" lay-verify="required"
                           placeholder="用户名" class="layui-input">
                </div>
                <div class="layui-form-item">
                    <label class="layadmin-user-login-icon layui-icon layui-icon-password"
                           for="LAY-user-login-password"></label>
                    <input type="password" name="password" id="LAY-user-login-password" lay-verify="required"
                           placeholder="密码" class="layui-input">
                </div>

                <div class="layui-form-item">
                    <div class="layui-row">
                        <div class="layui-col-xs7">
                            <label class="layadmin-user-login-icon layui-icon layui-icon-vercode"
                                   for="LAY-user-login-vercode"></label>
                            <input type="text" name="captcha" id="LAY-user-login-vercode" lay-verify="required"
                                   placeholder="图形验证码" class="layui-input">
                        </div>
                        <div class="layui-col-xs5">
                            <div style="margin-left: 10px;">
                                <img src="{{ captcha_src('math') }}"
                                     data-src="{{ captcha_src('math') }}"
                                     class="layadmin-user-login-codeimg" id="LAY-user-get-vercode">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item" style="margin-bottom: 20px;">
                    <input type="checkbox" name="remember" lay-skin="primary" title="记住密码">
                </div>
                <div class="layui-form-item">
                    <button class="layui-btn layui-btn-fluid" lay-submit lay-filter="LAY-user-login-submit">登 入</button>
                </div>
            </div>
        </div>

        <div class="layui-trans layadmin-user-login-footer">
            <p>© 2019-{{ date('Y') }} <a href="@cms('domain')" target="_blank">@cms('domain')</a></p>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        var postLoginUrl = '{{ route('admin.login') }}';

        layui.use(['index', 'form', 'verify', 'request'], function () {
            var $ = layui.$, form = layui.form, request = layui.request;

            form.render();
            //提交
            form.on('submit(LAY-user-login-submit)', function (obj) {
                //请求登入接口
                request.post(postLoginUrl, obj.field, function (res) {
                    if (res.code != 200) {
                        layer.msg(res.msg, {icon: 5, shift: 6});
                        //刷新验证码
                        $("#LAY-user-get-vercode").click();
                    } else {
                        layer.msg(res.msg, {icon: 1, shift: 6});
                        location.href = res.redirect; //后台主页
                    }
                })

            }, function (res) {

            });

            //更换图形验证码
            $("body").on('click', '#LAY-user-get-vercode', function () {
                var othis = $(this);
                this.src = othis.data('src') + '&t=' + new Date().getTime()
            });
        });
    </script>
@endpush
