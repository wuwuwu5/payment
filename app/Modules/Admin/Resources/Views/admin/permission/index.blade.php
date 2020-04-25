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
        layui.use(['index', 'table', 'treetable'], function () {
            var $ = layui.jquery;
            var treetable = layui.treetable;

            // 渲染表格
            layer.load(2);

            var table_id = "#LAY-list-table";

            treetable.render({
                treeColIndex: 2,
                treeSpid: 0,
                treeIdName: 'id',
                treePidName: 'parent_id',
                elem: table_id,
                url: listConfig.list_url + "?limit=999",
                page: false,
                response: {
                    statusName: 'code' //规定数据状态的字段名称，默认：code
                    , statusCode: 200 //规定成功的状态码，默认：0
                    , msgName: 'msg' //规定状态信息的字段名称，默认：msg
                    , countName: 'count' //规定数据总数的字段名称，默认：count
                    , dataName: 'data' //规定数据列表的字段名称，默认：data
                },
                cols: [[
                    {field: 'icon', title: '图标', templet: "#tpl-icon", width: 80, align: 'center'},
                    {field: 'sort', width: 80, title: '排序', edit: 1},
                    {field: 'cn_name', minWidth: 200, title: '名称'},
                    {field: 'name', title: '路由', edit: 1},
                    {title: '操作', width: 200, align: 'center', toolbar: '#tpl-create-edit'}
                ]],
                done: function () {
                    layer.closeAll('loading');
                }
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
