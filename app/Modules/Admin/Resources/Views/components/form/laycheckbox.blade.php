<div class="layui-form-item">
    @include('admin::components.form.label',['params'=>$params])
    <div class="layui-input-block">
        @if(!empty($params['list']))
            @foreach ($params['list'] as $v)
                <input
                    @if(isset($params['on_id']))
                    {{ is_array($params['on_id']) ? in_array($v['id'], $params['on_id']) ? "checked" :"":$params['on_id']==$v['id']?'checked':'' }}
                    @endif
                    type="checkbox" name="{{array_get($params,'name','') }}[]"
                    params-min="{{ array_get($params,'min','1') }}"
                    lay-filter="{{array_get($params,'filter','') }}"
                    value="{{ $v['id'] }}"
                    lay-skin="{{ array_get($params,'style','')}}" title="{{ $v['name'] }}">
            @endforeach
        @endif

    </div>
</div>

{{--
       Form::LayCheckbox([
                'name'=>'is_admin',
                'title'=>'超级管理员',
                'tips'=>'',
                'rq'=>'',
                'style'=> 'primary',
                'on_id'=>$show->is_admin,
                'list'=>[
                     ['id'=>1,'name'=>'是'],
                     ['id'=>0,'name'=>'否']
                ]
        ])

--}}
