@extends('admin::layout.app')
@section('content')
    <div class="layui-card panel">
        <div class="layui-list-btn">
            <button class="layui-btn layui-btn-normal wkcms" data-type="add" style="margin-left: 15px">+ 添加</button>
        </div>
    </div>
    <div class="layui-card">
        <div class="layui-card-header">
            <button class="layui-btn layui-btn-primary layui-btn-sm wkcms" data-type="all_del">全部删除</button>
        </div>
        <div class="layui-card-body">
            <table id="LAY-list-table" lay-filter="LAY-list-table"></table>
        </div>
    </div>
@endsection
@push('scripts')
    @include('admin::components.listConfig')
    <script>
        layui.use(['index', 'listTable'], function () {
            var listTable = layui.listTable;
            var cols = null;

            @if(is_admin())
                cols = [[
                {type: 'checkbox'},
                {field: 'id', width: 80, title: 'ID'},
                {field: 'cn_name', title: '角色'},
                {field: 'name', title: '标识符'},
                {field: 'mark', title: '说明'},
                {title: '操作', width: 200, align: 'center', toolbar: '#tpl-create-edit'}
            ]];
            @else
                cols = [[
                {type: 'checkbox'},
                {field: 'id', width: 80, title: 'ID'},
                {field: 'cn_name', title: '角色'},
                {field: 'name', title: '标识符'},
                {field: 'mark', title: '说明'}
            ]];
            @endif

            //渲染
            listTable.render(listConfig.list_url, cols);
        });
    </script>
@endpush
