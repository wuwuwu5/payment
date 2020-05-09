@extends('admin::layout.app')
@push('styles')
@endpush
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
                            <input type="text" name="title" placeholder="标题" autocomplete="off"
                                   class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <div class="layui-input-inline">
                            <select class="wkcms" name="is_published">
                                <option value="">选择状态</option>
                                <option value="0">未发布</option>
                                <option value="1">已发布</option>
                            </select>
                        </div>
                    </div>
                    <div class="layui-inline">
                        <div class="layui-input-inline">
                            <select class="wkcms" name="is_commend">
                                <option value="">是否推荐</option>
                                <option value="0">否</option>
                                <option value="1">是</option>
                            </select>
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
        layui.use(['index', 'listTable', 'dropdown'], function () {
            var listTable = layui.listTable;
            var dropdown = layui.dropdown;

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
                {title: '操作', align: 'center', toolbar: '#article_dropdown'}
            ]];

            //渲染
            listTable.render(listConfig.list_url, cols, {
                cellMinWidth: 80,
                done: function (res, curr, count) {
                    var data = res.data;
                    for (var i = 0; i < data.length; i++) {
                        dropdown.suite('#article_dropdown_' + data[i].id, {template: '#tpl-article', data:data[i]});
                    }
                }
            });
            // 查询
            listTable.search();
        });
    </script>
@endpush
