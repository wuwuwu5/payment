@extends('admin::layout.app')
@section('content')
    <div class="layui-form " id="layuiadmin-form" style="background-color: #fff">
        @csrf
        @if(isset($hshow))
            @method('PUT')
        @endif
        {{ Form::LayText(['name'=>'cn_name','title'=>'角色名称','value'=>$show->cn_name ?? '','rq'=>'rq']) }}
        {{ Form::LayText(['name'=>'name','title'=>'标识符','value'=>$show->name  ?? '','rq'=>'rq|en_string']) }}
        {{ Form::LayTextArea(['name'=>'mark','title'=>'描述说明', 'tips'=>'可为空','value'=>$show->mark  ?? '','rq'=>'']) }}
        <div class="layui-form-item">
            <label class="layui-form-label">权限选择</label>
            <div class="layui-input-block" style="">
                @include('admin::admin.role.permissions', ['permissions' => $permissions, 'role_has_permissions' => $role_has_permissions ?? collect()])
            </div>
        </div>
        {{ Form::LaySubmit() }}
    </div>
@endsection
@push('scripts')
    <script>
        layui.use(['index', 'uploader', 'form'], function () {
            var form = layui.form;
            var $ = layui.$;
            form.on('checkbox', function (data) {
                var check = data.elem.checked;//是否选中
                var checkId = data.elem.id;//当前操作的选项框
                if (check) {
                    //选中
                    var ids = checkId.split("-");
                    if (ids.length == 3) {
                        //第三极菜单
                        //第三极菜单选中,则他的上级选中
                        $("#" + (ids[0] + '-' + ids[1])).prop("checked", true);
                        $("#" + (ids[0])).prop("checked", true);
                    } else if (ids.length == 2) {
                        //第二季菜单
                        $("#" + (ids[0])).prop("checked", true);
                        $("input[id*=" + ids[0] + '-' + ids[1] + "]").each(function (i, ele) {
                            $(ele).prop("checked", true);
                        });
                    } else {
                        //第一季菜单不需要做处理
                        $("input[id*=" + ids[0] + "-]").each(function (i, ele) {
                            $(ele).prop("checked", true);
                        });
                    }
                } else {
                    //取消选中
                    var ids = checkId.split("-");
                    if (ids.length == 2) {
                        //第二极菜单
                        $("input[id*=" + ids[0] + '-' + ids[1] + "]").each(function (i, ele) {
                            $(ele).prop("checked", false);
                        });
                    } else if (ids.length == 1) {
                        $("input[id*=" + ids[0] + "-]").each(function (i, ele) {
                            $(ele).prop("checked", false);
                        });
                    }
                }
                form.render();
            });

        })
    </script>

@endpush
