@extends('admin::layout.app')
@section('content')
    <div class="layui-form " id="layuiadmin-form" style="background-color: #fff">
        @csrf
        @if(isset($show))
            @method('PUT')
        @endif

        {{Form::LayText([
           'name'=>'username',
           'title'=>'用户名',
           'tips'=>'',
           'value'=> $show->username ?? '',
           'rq'=>'rq|length[2,20]'
       ])}}

        {{Form::LayText([
            'name'=>'nickname',
            'title'=>'昵称',
            'tips'=>'',
            'rq'=>'rq|length[2,20]',
            'value'=>$show->nickname ?? '',
        ])}}


        {{   Form::LayText([
               'name'=>'id_card',
               'title'=>'证件号码',
               'tips'=>'',
               'rq'=>'rq|identity',
               'value'=>$show->id_card?? '',
            ])
       }}

        {{   Form::LayText([
                 'name'=>'email',
                 'title'=>'邮箱',
                 'tips'=>'',
                 'rq'=>'email',
                 'value'=>$show->email?? '',
            ])
        }}
        {{   Form::LayText([
                 'name'=>'mobile',
                 'title'=>'手机号',
                 'tips'=>'',
                 'rq'=>'phone',
                 'value'=>$show->phone ?? '',
            ])
        }}

        @if(isset($show))
            {{Form::LayText([
             'name'=>'password',
             'title'=>'密码',
             'type' => 'password',
             'rq'=>'',
             'value'=>'',
             'tips'=>'为空标识不更新密码'
            ])}}
        @else
            {{Form::LayText([
         'name'=>'password',
         'title'=>'密码',
         'type' => 'password',
         'rq'=>'rq|length[6,20]',
         'value'=>'',
        ])}}
        @endif

        {{
            Form::LayCheckbox([
                                    'name'=>'roles',
                                    'title'=>'角色',
                                    'filter'=>'role',
                                    'tips'=>'',
                                    'on_id'=>$user_has_roles ?? [],
                                    'list'=>$roles ?? []
                            ])
            }}
        {{   Form::LaySubmit()}}
    </div>
@endsection
@push('scripts')
    <script>
        layui.use(['index', 'uploader', 'form', 'verify'], function () {
            var form = layui.form;
            var $ = layui.$;

            form.on('checkbox(permission)', function (data) {
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
