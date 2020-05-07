@extends('admin::layout.app')
@push('styles')
@endpush
@section('content')
    <div class="layui-card panel">
        <div class="layui-list-btn">
            <button class="layui-btn layui-btn-normal wkcms"
                    data-url="{{ route('admin.categories.create', ['type' => $category_group->name]) }}"
                    data-post_url="{{route('admin.categories.store', ['category_group_id' => $category_group->id])}}"
                    data-type="diy_add"
                    style="margin-left: 15px;">+ 添加分组
            </button>
        </div>
    </div>
    @include('admin::components.table')
@endsection
@push('scripts')
    @include('admin::components.listConfig')
    <script>
        layui.use(['index', 'listTable'], function () {
            var listTable = layui.listTable;

            //渲染
            listTable.render(listConfig.list_url, {}, {cellMinWidth: 80});
            // 查询
            listTable.search();
        });
    </script>
@endpush
