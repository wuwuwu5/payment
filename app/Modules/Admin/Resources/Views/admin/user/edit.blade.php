@extends('admin::layout.app')
@section('content')
    <div class="layui-form " id="layuiadmin-form" style="background-color: #fff">
        @csrf
        @method('PUT')

        {{Form::LayText([
           'name'=>'username',
           'title'=>'登录名',
           'tips'=>'',
           'value'=> $show->username,
           'rq'=>'rq'
       ])}}


        {{Form::LayText([
            'name'=>'nickname',
            'title'=>'用户姓名',
            'tips'=>'',
            'rq'=>'rq',
            'value'=>$show->nickname
        ])}}


        {{   Form::LayText([
               'name'=>'id_card',
               'title'=>'证件号码',
               'tips'=>'',
               'rq'=>'rq|identity',
               'value'=>$show->id_card
            ])
       }}

        {{   Form::LayText([
                 'name'=>'email',
                 'title'=>'邮箱',
                 'tips'=>'',
                 'rq'=>'email',
                 'value'=>$show->email
            ])
        }}
{{--        {{   Form::LayText([--}}
{{--                 'name'=>'mobile',--}}
{{--                 'title'=>'手机号',--}}
{{--                 'tips'=>'',--}}
{{--                 'rq'=>'phone',--}}
{{--                 'value'=>$show->phone--}}
{{--            ])--}}
{{--        }}--}}

        {{Form::LayText([
         'name'=>'password',
         'title'=>'密码',
         'type' => 'password',
         'tips'=>'',
         'rq'=>'',
         'value'=>'',
         'mark'=>'不填表示不更新密码'
        ])}}
        {{Form::LayRadio([
                'name'=>'is_admin',
                'title'=>'超级管理员',
                'tips'=>'',
                'rq'=>'',
                'on_id'=>$show->is_admin,
                'list'=>[
                     ['id'=>1,'name'=>'是'],
                     ['id'=>0,'name'=>'否']
                ]
        ])}}

        {{
        Form::LayCheckbox([
                    'name'=>'roles',
                    'title'=>'角色',
                    'filter'=>'role',
                    'tips'=>'',
                    'on_id'=>$show->roles->pluck('id')->toArray(),
                    'rq'=>'rq',
                    'list'=>$role??[]
            ])
    }}

        <div class="layui-form-item">
            <label class="layui-form-label">
                部门
            </label>
            <div class="layui-input-block">
                <div id="groupset" title="选择部门"></div>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">
                数据部门
            </label>
            <div class="layui-input-block">
                <div id="data_groupset" title="选择部门"></div>
            </div>
        </div>

{{--        <div class="layui-form-item">--}}
{{--            <label class="layui-form-label">权限选择</label>--}}
{{--            <div class="layui-input-block" style="">--}}
{{--                @include('admin::role.permission')--}}
{{--            </div>--}}
{{--        </div>--}}

        {{   Form::LaySubmit()}}
    </div>
@endsection
@push('scripts')
    <script>
        layui.use(['index', 'uploader', 'xmSelect', 'myXmSelect',  'form'], function () {
            var uploader = layui.uploader;
            var xmSelect = layui.xmSelect;
            var myXmSelect = layui.myXmSelect;
            var form = layui.form;
            var $ = layui.$;

            uploader.one("#thumbUpload");
            //部门所选
            var groupset_lists = myXmSelect.render({
                el: '#groupset',
                tips: '选择部门',
                radio: true,
                autoRow: true,
                name: 'groupset_lists',
                tree: {
                    show: true,
                    strict: false,
                    expandedKeys: [-1],
                },
                data: @json(examCategories('groupset'))
            });

            groupset_lists.setValue(@json(userHasGroupset($show)))

            //部门所选
            var data = myXmSelect.render({
                el: '#data_groupset',
                tips: '选择部门',
                checkbox: true,
                autoRow: true,
                name: 'data_groupset',
                tree: {
                    show: true,
                    strict: false,
                    expandedKeys: [-1],
                },
                data: @json(examCategories('groupset'))
            });

            data.setValue(@json(userHasPermissionGroupset($show)))

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
