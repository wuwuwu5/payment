@extends('admin::layout.app')
@push('styles')
@endpush
@section('content')
    <div class="layui-card panel">
        <div class="layui-list-btn">
            <button class="layui-btn layui-btn-normal wkcms" data-type="add" style="margin-left: 15px;">+ 添加</button>
        </div>
    </div>
@endsection
@push('scripts')
    @include('admin::components.listConfig')
    <script>
        layui.use(['index', 'listTable'], function () {
            var listTable = layui.listTable;

            var cols = [[
                {field: 'id', title: 'ID'},
            ]];

            //渲染
            listTable.render(listConfig.list_url, cols, {cellMinWidth: 80});
            // 查询
            listTable.search();
        });
    </script>
@endpush
