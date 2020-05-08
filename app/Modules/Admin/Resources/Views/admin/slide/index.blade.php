@extends('admin::layout.app')
@push('styles')
@endpush
@section('content')
    <div class="layui-card panel">
        <div class="layui-list-btn">
            <button class="layui-btn layui-btn-normal wkcms"
                    data-url="{{ route('admin.categories.create', ['type' => $category_group->name ?? '']) }}"
                    data-post_url="{{route('admin.categories.store', ['category_group_id' => $category_group->id ?? ''])}}"
                    data-type="diy_add"
                    style="margin-left: 15px;">+ 添加分组
            </button>
            <button class="layui-btn layui-btn-normal wkcms"
                    data-type="add"
                    style="margin-left: 15px;">+ 添加轮播图
            </button>
        </div>
    </div>
    <div class="layui-card">
        <div class="layui-card-header">数据</div>
        <div class="layui-card-body">
            <div class="layui-collapse">
                @forelse($categories as $key => $value)
                    <div class="layui-colla-item">
                        <h2 class="layui-colla-title">{{$value->nickname}}</h2>
                        <div class="layui-colla-content layui-show">
                            <table id="LAY-list-table-{{$value->name}}" lay-filter="LAY-list-table-{{$value->name}}"
                                   class="layui-table">
                            </table>
                        </div>
                    </div>
                @empty
                    <div style="text-align: center">无数据</div>
                @endforelse
            </div>

        </div>
    </div>

@endsection
@push('scripts')
    @include('admin::components.listConfig')
    <script>
        layui.use(['index', 'listTable', 'table'], function () {
            var table = layui.table;
            var listTable = layui.listTable;
            listTable.top();

            @forelse($categories as $key => $value)
            table.render({
                elem: '#LAY-list-table-{{$value->name}}',
                cols: [[
                    {field: 'sort', 'title': '序号'},
                    {field: 'name', 'title': '名称'},
                    {
                        field: 'is_published', 'title': '状态', templet: function (d) {
                            if (d.is_published === false) {
                                return '未发布';
                            } else {
                                return '发布';
                            }
                        }
                    },
                    {title: '操作', align: 'center', toolbar: '#tpl-article'}
                ]],
                data:@json($value->slides)
            });

            listTable.handle(null, null, 'tool(LAY-list-table-{{$value->name}})');

            @endforeach
        });
    </script>
@endpush
