@extends('admin::layout.app')
@section('content')
    @include('admin::components.table')
@endsection
@push('scripts')
    @include('admin::components.listConfig')
    <script>
        layui.use(['index', 'listTable', 'form', 'layer'], function () {
            var listTable = layui.listTable;

            var cols = [[
                {field: 'id', title: 'ID'},
                {field: 'name', title: '昵称'},
                {field: 'phone', title: '手机号'}
            ]];

            //渲染
            listTable.render(listConfig.list_url, cols, {cellMinWidth: 80});
            // 查询
            listTable.search();
        });
    </script>
@endpush

