@extends('admin::layout.app')
@section('content')
    <div class="layui-card panel">
        <div class="layui-card-header">搜索
            <div class="panel-action">
                <a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a></div>
        </div>
        <div class="layui-card-body">
            <div class="layui-form">
                <div class="layui-form-item ">
                    <div class="layui-inline">
                        <div class="layui-input-inline">
                            <input type="text" name="username" placeholder="用户名" autocomplete="off"
                                   class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <div class="layui-input-inline">
                            <input type="text" name="nickname" placeholder="用户姓名" autocomplete="off"
                                   class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <button class="layui-btn layui-btn-normal layuiadmin-btn-admin" lay-submit
                                lay-filter="LAY-list-search">
                            <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
                        </button>
                    </div>
                </div>
                <div class="layui-form-item ">
                    <div class="layui-inline">
                        <button class="layui-btn layui-btn-normal wkcms" data-type="add" data-w="90%" data-h="90%">+
                            添加
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin::components.table')
@endsection
@push('scripts')
    @include('admin::components.listConfig')
    <script>
        layui.use(['index', 'listTable', 'form', 'layer'], function () {
            var listTable = layui.listTable;

            var cols = [[
                {field: 'id', title: 'ID'},
                {field: 'username', title: '登录名'},
                {field: 'nickname', title: '用户姓名'},
                {field: 'email', title: '邮箱'},
                {field: 'mobile', title: '手机号'},
                {
                    field: 'locked', title: '禁用', templet:
                        function (d) {
                            return layui_switch('locked', d, '启用|禁用', 0, 1, '/admin/users/' + d.id + '/status');
                        }
                },
                {title: '操作', align: 'center', toolbar: '#tpl-admin-user-options'}
            ]];

            //渲染
            listTable.render(listConfig.list_url, cols, {cellMinWidth: 80});
            // 查询
            listTable.search();
        });
    </script>
@endpush

