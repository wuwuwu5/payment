@extends('admin::layout.app')
@push('styles')
    <link rel="stylesheet" href="{{ admin_asset('/modules/treetable-lay/treetable.css') }}">
@endpush
@section('content')
    <div class="layui-card panel">
        <div class="layui-list-btn">
            <button class="layui-btn layui-btn-normal wkcms" data-type="add" style="margin-left: 15px;">+ 添加</button>
        </div>
    </div>
    @include('admin::components.table_tree')
@endsection
@push('scripts')
    @include('admin::components.listConfig')
    <script>
        layui.use(['index', 'table', 'treetable', 'form', 'layer', 'request'], function () {
            var $ = layui.jquery;
            var treetable = layui.treetable;
            var form = layui.form;
            var layer = layui.layer;
            var req = layui.request;

            // 渲染表格
            layer.load(2);

            var table_id = "#LAY-list-table";

            function treeTableRender() {
                return treetable.render({
                    treeColIndex: 1,
                    treeSpid: 0,
                    treeIdName: 'id',
                    treePidName: 'pid',
                    elem: table_id,
                    url: listConfig.list_url + '?type=' + '{{request()->input('type')}}',
                    page: false,
                    response: {
                        statusName: 'code' //规定数据状态的字段名称，默认：code
                        , statusCode: 200 //规定成功的状态码，默认：0
                        , msgName: 'msg' //规定状态信息的字段名称，默认：msg
                        , countName: 'count' //规定数据总数的字段名称，默认：count
                        , dataName: 'data' //规定数据列表的字段名称，默认：data
                    },
                    cols: [[
                        {field: 'weigh', width: 80, title: '排序', edit: 1},
                        {field: 'nickname', minWidth: 100, title: '展示名称'},
                        {
                            field: 'status', title: '状态', width: 100, templet:
                                function (d) {
                                    return layui_category_switch('status', d, '启用|禁用', 1, 0, '/admin/categories/' + d.id + '/status');
                                }
                        },
                        {title: '操作', width: 200, align: 'center', toolbar: '#tpl-edit'}
                    ]],
                    done: function () {
                        layer.closeAll('loading');
                    }
                });
            }

            treeTableRender();

            //监听列表其他组件事件,开关设置
            form.on('switch(table-category-checked)', function (obj) {
                var field = $(this).data('field');
                var value = obj.elem.checked ? 1 : 0;
                var url = $(this).data('url');
                // 文件数据
                var data = {};
                // 赋值
                data[field] = value;
                data['_method'] = 'patch';

                layer.load(1);
                req.post(url, data, function (res) {
                    if (res.code === 200) {
                        layer.load(1);
                        treeTableRender();
                        layer.msg(res.msg);
                    }
                })
            });

            $('#btn-expand').click(function () {
                treetable.expandAll(table_id);
            });

            $('#btn-fold').click(function () {

                treetable.foldAll(table_id);
            });
        });
    </script>
@endpush
