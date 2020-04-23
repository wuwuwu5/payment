<div class="layui-form-item">
    @include('admin::components.form.label',['params'=>$params])
    <div class="layui-input-block">
        <div class="layui-inline" style="">
            <input
                id="{{ array_get($params,'id',array_get($params,'name'))}}"
                type="{{ array_get($params,'type','text')}}"
                name="{{ array_get($params,'name') }}"
                value="{{ array_get($params,'value','')}}"
                lay-verify="{{array_get($params,'rq','')}}"
                placeholder="{{ array_get($params,'tips',array_get($params,'title'))}}"
                data-color_obj="#{{ array_get($params,'c_id',array_get($params,'name')).'_color' }}"
                kq-event="color"
                autocomplete="off" class="layui-input"
            />
        </div>
        <div class="layui-inline" style="left: -15px;margin: 0">
            <div id="{{ array_get($params,'c_id',array_get($params,'name')).'_color' }}"></div>
        </div>
    </div>
</div>
{{--
{{
    Form::LayColor([
'name'=> 'color',
'tips'=> '',
'rq'=>'rq',
'value'=> '',
'title'=> '颜色选择',
]
)}}
--}}
