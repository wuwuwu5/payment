@extends('admin::layout.app')
@section('content')
    <style>
        .layui-btn-lg {
            height: 60px;
            line-height: 60px;
            padding: 0 28px;
        }
        @media screen and (max-width: 990px) {
            .item-div {
                justify-content: start !important;
            }
        }
    </style>
    <div class="layui-row layui-col-space15">
        <div style="padding: 20px; background-color: #F2F2F2;">
            <div class="layui-row layui-col-space15">
                <div class="layui-col-md6">
                    <div class="layui-card" style="padding-bottom: 20px">
                        <div class="layui-card-header">快捷方式</div>
                        <div class="layui-card-body">
                            <div class="item-div" style="display: flex; justify-content: center">
                                <a lay-href=""
                                   class="layui-btn layui-btn-primary layui-btn-lg"
                                   style="background: #f2f3f7; border: none">
                                    <i class="layui-side-icon layui-icon layui-icon-app"
                                       style="position:inherit;"></i>
                                    考试安排
                                </a>
                                <a lay-href="" type="button"
                                   class="layui-btn layui-btn-primary layui-btn-lg"
                                   style="background: #f2f3f7; border: none;">
                                    <i class="layui-side-icon layui-icon layui-icon-file"
                                       style="position:inherit;"></i>
                                    题库管理
                                </a>
                                <a lay-href="" type="button"
                                   class="layui-btn layui-btn-primary layui-btn-lg"
                                   style="background: #f2f3f7; border: none;">
                                    <i class="layui-side-icon layui-icon layui-icon-friends"
                                       style="position:inherit;"></i>
                                    人员管理
                                </a>
                            </div>
                            <div class="item-div" style="display: flex; justify-content: center; margin-top: 20px">
                                <a lay-href="" type="button"
                                   class="layui-btn layui-btn-primary layui-btn-lg"
                                   style="background: #f2f3f7; border: none;">
                                    <i class="layui-side-icon layui-icon layui-icon-list"
                                       style="position:inherit;"></i>
                                    试卷管理
                                </a>
                                <a lay-href="" type="button"
                                   class="layui-btn layui-btn-primary layui-btn-lg"
                                   style="background: #f2f3f7; border: none;">
                                    <i class="layui-side-icon layui-icon layui-icon-chart-screen"
                                       style="position:inherit;"></i>
                                    考试监控
                                </a>
                                <a lay-href="" type="button"
                                   class="layui-btn layui-btn-primary layui-btn-lg"
                                   style="background: #f2f3f7; border: none">
                                    <i class="layui-side-icon layui-icon layui-icon-table"
                                       style="position:inherit;"></i>
                                    人工评卷
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="layui-col-md6">
                    <div class="layui-card">
                        <div class="layui-card-header">消息提示</div>
                        <div class="layui-card-body" style="padding-bottom: 30px;">
                            <div style="display: flex;">
                                <div
                                    style="background: #f2f3f7; padding: 5px 20px;border-radius: 3px;width: 160px;height: 50px">
                                    <p>进行中的考试</p>
                                    <p style="font-size: 20px;color: #5b8de8;">{{$started ?? 0}}</p>
                                </div>
                                <div
                                    style="background: #f2f3f7; padding: 5px 20px;border-radius: 3px;width: 160px;margin-left: 20px;height: 50px">
                                    <p>已完成的考试</p>
                                    <p style="font-size: 20px;color: #5b8de8;">{{$ended ?? 0}}</p>
                                </div>
                            </div>
                            <div style="margin-top: 20px">
                                <div
                                    style="background: #f2f3f7; padding: 5px 20px;border-radius: 3px;width: 160px;height: 50px">
                                    <p>未开始的考试</p>
                                    <p style="font-size: 20px;color: #5b8de8;">{{$not_started ?? 0}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
