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
                            <select name="status">
                                <option value="">请选择状态</option>
                                <option value="0">未支付</option>
                                <option value="1">已支付</option>
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
            </div>
        </div>
    </div>
    @include('admin::components.table')
@endsection
@push('scripts')
    @include('admin::components.listConfig')
    <script>
        layui.use(['index', 'listTable', 'form', 'layer'], function () {
            var listTable = layui.listTable;

            var cols = [[
                {field: 'id', title: 'ID'},
                {
                    field: 'project', title: '项目类型', templet: function (d) {
                        if (!d.project_info) {
                            return "";
                        }
                        return d.project_info.nickname;
                    }
                },
                {
                    field: 'class', title: '班型', templet: function (d) {
                        if (!d.class_info) {
                            return "";
                        }
                        return d.class_info.nickname;
                    }
                },
                {field: 'phone', title: '手机号'},
                {field: 'out_trade_no', title: '订单号'},
                {field: 'title', title: '订单标题'},
                {
                    field: 'total_fee', title: '支付金额', templet: function (d) {
                        return d.total_fee / 100;
                    }
                },
                {field: 'place_order_at', title: '下单时间'},
                {
                    field: 'status', title: '订单状态', templet: function (d) {
                        if (d.status == 0) {
                            return '未支付';
                        }
                        return '已支付';
                    }
                },
                {field: 'payment_at', title: '支付时间'},
            ]];

            //渲染
            listTable.render(listConfig.list_url, cols, {cellMinWidth: 80});
            // 查询
            listTable.search();
        });
    </script>
@endpush

