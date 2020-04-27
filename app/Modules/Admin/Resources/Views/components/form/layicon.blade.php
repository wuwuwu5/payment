<div class="layui-form-item">
    @include('admin::components.form.label',['params'=>$params])
    <div class="layui-input-block" id="{{ md5(array_get($params,'name','name'))}}">
        <input  type="hidden"
                name="{{ array_get($params,'name','name') }}"
                value="{{array_get($params,'value','')}}"
                placeholder="{{ isset($params['tips'])?$params['tips']:$params['title'] }}"
                lay-verify="{{array_get($params,'rq','')}}"
                autocomplete="off" class="layui-input"/>
        <div class="icon-add" style="display: inline-block;padding: 9px 0!important">
            <span class="{{ array_get($params,'value','') }}"></span>
        </div>
        <button class="layui-btn layui-btn-xs layui-btn-info" kq-event="icon" data-more="0" data-obj="{{ md5(array_get($params,'name','name')) }}">文件库选择</button>
    </div>
</div>
