@extends('admin::layout.app')
@push('styles')
@endpush
@section('content')
    <div class="layui-card panel">
        <div class="layui-list-btn">
            <button class="layui-btn layui-btn-normal wkcms" data-type="add" style="margin-left: 15px;">+ 添加</button>
        </div>
    </div>
    @include('admin::components.table')
@endsection
@push('scripts')
    @include('admin::components.listConfig')
    <script>
        layui.use(['index', 'listTable'], function () {
            var listTable = layui.listTable;

            var cols = [[
                {field: 'id', title: 'ID'},
                {field: 'title', title: "标题"},
                {
                    field: 'creator', title: "创建人", templet: function (d) {
                        if (!d.creator) {
                            return '';
                        }

                        return d.creator.username;
                    }
                },
                {
                    field: 'is_published', title: "发布状态", templet: function (d) {
                        if (d.is_published === false) {
                            return '未发布';
                        }

                        return '已发布';
                    }
                },
                {
                    field: 'category', title: "分类", templet: function (d) {
                        if (!d.category) {
                            return '无分类';
                        }

                        return d.category.nickname;
                    }
                },
                {title: '操作', align: 'center', toolbar: '#tpl-article'}
            ]];

            //渲染
            listTable.render(listConfig.list_url, cols, {cellMinWidth: 80});
            // 查询
            listTable.search();
        });
    </script>
@endpush
