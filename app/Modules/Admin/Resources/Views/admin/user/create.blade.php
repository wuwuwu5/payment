@extends('admin::layout.app')
@section('content')
    <div class="layui-form " id="layuiadmin-form" style="background-color: #fff">

        {{Form::LayText([
           'name'=>'username',
           'title'=>'登录名',
           'tips'=>'',
           'rq'=>'rq'
       ])}}


        {{Form::LayText([
            'name'=>'nickname',
            'title'=>'用户姓名',
            'tips'=>'',
            'rq'=>'rq',
        ])}}


        {{   Form::LayText([
               'name'=>'id_card',
               'title'=>'证件号码',
               'tips'=>'',
               'rq'=>'rq|identity',
            ])
       }}
        {{Form::LayText([
       'name'=>'password',
       'title'=>'密码',
       'type' => 'password',
       'tips'=>'',
       'rq'=>'rq',
       'value'=>'',
      ])}}

        {{   Form::LayText([
                 'name'=>'email',
                 'title'=>'邮箱',
                 'tips'=>'',
                 'rq'=>'email',
            ])
        }}
        {{   Form::LayText([
                 'name'=>'mobile',
                 'title'=>'手机号',
                 'tips'=>'',
                 'rq'=>'phone',
            ])
        }}


{{--        {{Form::LayRadio([--}}
{{--                'name'=>'is_admin',--}}
{{--                'title'=>'超级管理员',--}}
{{--                'tips'=>'',--}}
{{--                'rq'=>'',--}}
{{--                'list'=>[--}}
{{--                     ['id'=>1,'name'=>'是'],--}}
{{--                     ['id'=>0,'name'=>'否']--}}
{{--                ]--}}
{{--        ])}}--}}

        {{--        {{--}}
        {{--        Form::LayCheckbox([--}}
        {{--                    'name'=>'roles',--}}
        {{--                    'title'=>'角色',--}}
        {{--                    'filter'=>'role',--}}
        {{--                    'tips'=>'',--}}
        {{--                    'rq'=>'rq',--}}
        {{--                    'list'=>$role??[]--}}
        {{--            ])--}}
        {{--    }}--}}



        {{   Form::LaySubmit()}}
    </div>
@endsection
@push('scripts')
    <script>
        layui.use(['index', 'form'], function () {
            var form = layui.form;
            var $ = layui.$;
        })
    </script>

@endpush
