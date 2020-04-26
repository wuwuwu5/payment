
<div class="layui-form-item">
    @include('admin::components.form.label',['params'=>$params])
    <div class="layui-input-block ">
        <input
            id="{{ array_get($params,'id',array_get($params,'name'))}}"
            type="{{ array_get($params,'type','text') }}"
            name="{{ array_get($params,'name') }}"
            value="{{ array_get($params,'value','') }}"
            placeholder="{{ array_get($params,'tips',array_get($params,'title'))}}"
            lay-verify="{{array_get($params,'rq', '')}}"
            style="{{array_get($params,'style','')}}"
            autocomplete="off" class="layui-input "
        />
    </div>
</div>


{{--
   {{Form::LayText([
         'name'=>'email',
         'title'=>'邮箱',
         'tips'=>'',
         'rq'=>'',
         'value'=>$show->email
        ])}}
        {{Form::LayText([
         'name'=>'password',
         'title'=>'密码',
         'type' => 'password',
         'tips'=>'',
         'rq'=>'',
         'value'=>'',
         'mark'=>'不填表示不更新密码'
        ])}}

--}}
