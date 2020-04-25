@extends('admin::layout.app')
@section('content')
    <div class="layui-form " id="layuiadmin-form" style="background-color: #fff">
        {{ csrf_field() }}
        @if(isset($show))
            {{ method_field('PUT') }}
        @endif
        <div class="layui-form-item">
            <label for="" class="layui-form-label"><strong class="item-required">*</strong>父级</label>
            <div class="layui-input-block">
                <select name="parent_id" lay-search>
                    <option value="0">顶级权限</option>
                    @if(!empty($permissions))
                        @php
                            $permissions = tree($permissions);
                        @endphp
                        @foreach($permissions as $perm)
                            <option
                                value="{{$perm['id']}}" {{ isset($show->id) && $perm['id'] == ($show->parent_id ?? 0) ? 'selected' : '' }} >{{$perm['cn_name']}}</option>
                            @if(isset($perm['_child']))
                                @foreach($perm['_child'] as $childs)
                                    <option
                                        value="{{$childs['id']}}" {{ isset($show->id) && $childs['id'] ==  ($show->parent_id ?? 0) ? 'selected' : '' }} >
                                        ┗━━{{$childs['cn_name']}}</option>
                                    @if(isset($childs['_child']))
                                        @foreach($childs['_child'] as $lastChilds)
                                            <option
                                                value="{{$lastChilds['id']}}" {{ isset($show->id) && $lastChilds['id'] ==  ($show->parent_id ?? 0) ? 'selected' : '' }} >
                                                ┗━━━━{{$lastChilds['cn_name']}}</option>
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        {{ Form::LayText(['name'=>'name','title'=>'路由地址','value'=>$show->name ?? '','rq'=>'rq']) }}
        {{ Form::LayText(['name'=>'cn_name','title'=>'名称','rq'=>'rq','value'=>$show->cn_name ?? '',]) }}
        {{ Form::LayIcon(['name'=>'icon','title'=>'图标','value'=>$show->icon ?? '']) }}
        {{ Form::LaySubmit() }}
    </div>
@endsection
@push('scripts')
    <script>
        layui.use(['index', 'uploader'], function () {
            var uploader = layui.uploader;
            uploader.one("#thumbUpload");
        })
    </script>

@endpush
