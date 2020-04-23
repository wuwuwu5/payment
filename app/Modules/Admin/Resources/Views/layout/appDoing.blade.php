<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title') -@cms('system_name')</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @section('style')
        @include('admin::layout.style')
    @show
    @stack('styles')
</head>
<body  style="background: #fff">
@section('layui_fluid')
    <div class="layui-fluid">
        <div class="layui-row layui-col-space15">
            @show
            @yield('content')
            @section('layui_fluid_end')
        </div>
    </div>
@show

@section('script')
    @include('admin::layout.script')
    <script>
        //每个页面都初始化表单数据和检验表单
        layui.use(['index', 'form', 'verify','custorm'], function () {
            var $ = layui.$
                , form = layui.form;
        });
    </script>

@show
@stack('scripts')
</body>
</html>
