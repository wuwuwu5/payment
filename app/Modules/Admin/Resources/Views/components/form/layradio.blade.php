<div class="layui-form-item">
   @include('admin::components.form.label',['params'=>$params])
    <div class="layui-input-block">
        @if(!empty($params['list']))
            @foreach ($params['list'] as $v)
                <input
                    type="radio"
                    name="{{ $params['name'] }}"
                    value="{{ $v['id'] }}"
                    title="{{ $v['name'] }}"
                    lay-verify="{{ array_get($params,'rq','radio') }}"
                    params-title="{{ $params['title'] ?? '' }}"
                    lay-filter="{{ array_get($params,'filter','')}}"
                    {{ array_get($params,'on_id','')==$v['id']?'checked':'' }}
                    style="{{array_get($params,'style','')}}"
                >
            @endforeach
        @endif
    </div>
</div>

{{--
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
--}}
