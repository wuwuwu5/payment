<div class="layui-form-item">
    @include('admin::components.form.label',['params'=>$params])
    <div class="layui-input-block">
        <textarea
            id="{{ array_get($params,'id',array_get($params,'name'))}}"
            name="{{ array_get($params,'name') }}"
            placeholder="{{ array_get($params,'tips',array_get($params,'title'))}}"
            lay-verify="{{array_get($params,'rq','')}}"
            autocomplete="off"
            style="{{array_get($params,'style','')}}"
            class="layui-textarea">{{array_get($params,'value')}}</textarea>
    </div>
</div>

