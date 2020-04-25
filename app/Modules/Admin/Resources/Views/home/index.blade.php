@extends('admin::layout.app')
    @section('layui_fluid')
    @endsection
    @section('layui_fluid_end')
    @endsection
@section('content')
    <div id="LAY_app">
        <div class="layui-layout layui-layout-admin">
        @include('admin::layout.header')
            <!-- 侧边菜单 -->
        @include('admin::layout.sideMenu')
            <!-- 页面标签 -->
        @include('admin::layout.tab')
            <!-- 主体内容 -->
            <div class="layui-body" id="LAY_app_body">
                <div class="layadmin-tabsbody-item layui-show">
                    <iframe src="" frameborder="0" class="layadmin-iframe" width="100%" style="width: 100%"></iframe>
                </div>
            </div>
            <!-- 辅助元素，一般用于移动设备下遮罩 -->
            <div class="layadmin-body-shade" layadmin-event="shade"></div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        layui.config().use('index');
    </script>
@endsection


