<div class="layui-form-item">
   @include('admin::components.form.label',['params'=>$params])
    <div class="layui-input-block">
        <div class="test-slider-demo" kq-event="slider" data-type=" {{ array_get($params,'type','default') }}"
             data-range="{{ array_get($params,'range','false') }}"
             data-step="{{ array_get($params,'step','1') }}"
             data-tips="{{ array_get($params,'tips','') }}"
             data-theme="{{ array_get($params,'theme','#009688') }}"
             data-input="{{ array_get($params,'input','false') }}"
             data-inputid="#{{ array_get($params,'name','sider_value') }}"
             data-value="{{ array_get($params,'value','0') }}"
             data-min="{{ array_get($params,'min','0') }}"
             data-max="{{ array_get($params,'min','100') }}"
        ></div>
        <input type="hidden" id="{{ array_get($params,'name','sider_value') }}"  value=" " name="{{ array_get($params,'name','sider_value') }}">
    </div>
</div>

{{--

        {{
Form::LaySlider([
            'name'=>'fenshu',
            'title'=>'角色'
    ])
}}
--}}
