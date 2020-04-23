<div class="layui-form-item">
    @include('admin::components.form.label',['params'=>$params])
    <div class="layui-input-block">
            <textarea id="{{array_get($params, 'id', array_get($params, 'name'))}}" cols="30" rows="10"
                      lay-verify="{{array_get($params,'rq','')}}">{{ array_get($params,'value','')}}</textarea>
    </div>
</div>

