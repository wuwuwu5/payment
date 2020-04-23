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
                        <div class="layui-input-inline">
                            <div id="status"></div>
                        </div>
                    </div>
                    <div class="layui-inline">
                        <div class="layui-input-inline">
                            <div id="group"></div>
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
                        <button class="layui-btn layui-btn-normal wkcms" data-type="add">+ 添加</button>
                        <button style="margin-left: 18px" class="layui-btn layui-btn-normal  layuiadmin-btn-admin wkcms"
                                id="import">
                            + 批量导入
                        </button>
                        <a style="margin-left: 18px" class="layui-btn layui-btn-normal  layuiadmin-btn-admin wkcms"
                           href="/admin/user_import.xlsx" style="margin-left: 10px;">
                            模板下载
                        </a>
                    </div>
                </div>
            </div>
        </div>
        {{--        <div class="layui-list-btn" style="margin-left: 50px">--}}
        {{--            <button class="layui-btn layui-btn-normal layui-btn-normal wkcms" data-type="all_del">删除</button>--}}
        {{--        </div>--}}
    </div>
    @include('admin::components.table')
@endsection
@push('scripts')
    @include('admin::components.listConfig')
    <script>
        layui.use(['index', 'listTable', 'upload', 'table', 'xmSelect', 'myXmSelect', 'form', 'layer'], function () {
            var $ = layui.$
                , listTable = layui.listTable, upload = layui.upload, table = layui.table, xmSelect = layui.xmSelect,
                layer = layui.layer,
                form = layui.form, myXmSelect = layui.myXmSelect;
            cols = [[
                {field: 'id', width: 80, title: 'ID'},
                {field: 'username', title: '登录名'},
                {field: 'nickname', title: '用户姓名'},
                {field: 'email', title: '邮箱'},
                {field: 'mobile', title: '手机号'},
                {
                    field: 'locked', title: '禁用', width: 100, templet:
                        function (d) {
                            return layui_user_switch('locked', d, '启用|禁用');
                        }
                },
                {title: '操作', width: 250, align: 'center', toolbar: '#tpl-user-create-edit'}
            ]];

            //渲染
            listTable.render(listConfig.list_url, cols);

            form.on('submit(LAY-list-search)', function (data) {
                var field = data.field;

                for (let key in field) {
                    if (field[key] === '' || field[key] == undefined) {
                        delete field[key]
                    } else {
                        if (key == 'username' || key == 'nickname') {
                            field[key] = field[key] + '%'
                        }
                    }
                }

                field['page'] = 1;
                var loading = layer.load(1);
                //执行重载
                table.reload('LAY-list-table', {
                    where: field,
                    done: function (res, curr, count) {
                        layer.close(loading);
                        for (var k in field) {
                            delete this.where[k];
                        }
                    }
                });
            });

            //指定允许上传的文件类型
            upload.render({
                elem: '#import'
                , url: '' //改成您自己的上传接口
                , accept: 'file' //普通文件
                , exts: 'xls|excel|xlsx' //只允许上传表格文件
                , before: function (obj) { //obj参数包含的信息，跟 choose回调完全一致，可参见上文。
                    layer.load(1)
                }
                , done: function (res) {
                    layer.closeAll();
                    if (res.code !== 200) {
                        layer.open({content: res.msg, title: '提示'});
                        return
                    }
                    table.reload('LAY-list-table');
                    layer.msg('导入成功');
                },
                error() {
                    layer.closeAll();
                }
            });


        });

    </script>
@endpush

