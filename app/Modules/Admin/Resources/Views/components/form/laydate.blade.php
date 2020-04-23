<div class="layui-form-item">
   @include('admin::components.form.label',['params'=>$params])
    <div class="layui-input-block">
        <input
            id="{{ array_get($params,'id',array_get($params,'name'))}}"
            type="{{ array_get($params,'type','text')}}"
            name="{{ array_get($params,'name') }}"
            value="{{ array_get($params,'value','')}}"
            placeholder="{{ array_get($params,'tips',array_get($params,'title'))}}"
            lay-verify="{{array_get($params,'rq','')}}"
            kq-event="date"
            params-obj="{{ array_get($params,'name')}}"
            data-min="{{ array_get($params,'min','')}}"
            data-max="{{ array_get($params,'max','')}}"
            data-config="{{array_get($params,'config',"{}") }}"
            data-format="{{array_get($params,'format',"yyyy-MM-dd HH:mm:ss") }}"
            style="{{array_get($params,'style','')}}"
            autocomplete="off" class="layui-input"/>
    </div>
</div>


{{--

{{Form::LayDate([
                    'name'=>'end_at',
                    'title'=>'结束时间',
                    'tips'=>'',
                    'rq'=>'rq',
                    'mark'=>'',
                     'min'=>'2',
                     'value'=>$show->end_at,
            ])}}--}}
