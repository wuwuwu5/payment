@extends('admin::layout.app')
@section('content')
    <div class="layui-card">
        <div class="layui-tab layui-tab-card">
            <ul class="layui-tab-title">
                @forelse($settings as $setting)
                    <li class="{{ $loop->first ? 'layui-this' :''}}">{{$setting->cn_name}}</li>
                @empty
                    <li class="layui-this">暂无配置</li>
                @endforelse
            </ul>
            <div class="layui-tab-content" style="min-height: 100px;">
                @forelse($settings as $setting)
                    <div class="layui-tab-item {{ $loop->first ? 'layui-show' :''}}">
                        <div class="layui-card">
                            <div class="layui-card-body">
                                <div class="layui-form">
                                    @csrf
                                    @method('PUT')
                                    @foreach($setting->value as $item)
                                        @if(!isset($item['type']) || empty($item['type']))
                                            @continue
                                        @endif
                                        @php
                                            $form_type = 'Lay'. ucfirst($item['type'])
                                        @endphp
                                        @if($form_type == 'LayRadio')
                                            {{  Form::{$form_type}([
                                                 'title' => $item['name'],
                                                 'name' => $item['field'],
                                                 'on_id' => $item['value'],
                                                 'list' => $item['list'],
                                             ])}}
                                        @else
                                            {{  Form::{$form_type}(['title' => $item['name'], 'name' => $item['field'], 'value' => $item['value'],'id'=>$setting->name.$item['field']])}}
                                        @endif
                                    @endforeach
                                    <div class="layui-form-item">
                                        <label class="layui-form-label"></label>
                                        <button class="layui-btn"
                                                data-edit="{{route('admin.settings.update',['setting' => $setting->id])}}"
                                                lay-submit lay-filter="layuiadmin-form" data-type="{{$setting->name}}">
                                            提交
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="layui-tab-item layui-show">
                        暂无配置
                    </div>
                @endforelse
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        layui.use(['index', 'form', 'verify', 'request', 'layedit', 'alioss'], function () {
            var $ = layui.$
                , layedit = layui.layedit
                , form = layui.form
                , request = layui.request
                , alioss = layui.alioss;

            alioss.file();
            alioss.img();

            layedit.set({
                uploadImage: {
                    url: g_upload_files
                    , type: 'post' //默认post
                }
            });


            form.render();

            //提交
            form.on('submit(layuiadmin-form)', function (obj) {
                delete obj.field.file;
                //请求登入接口
                let editurl = $(this).data('edit');
                request.post(editurl, obj.field, function (res) {
                    if (res.code != 200) {
                        layer.msg(res.msg, {icon: 5, shift: 6});
                    } else {
                        layer.msg(res.msg, {icon: 1, shift: 6});
                    }
                })
            });
        });
    </script>
@endpush

