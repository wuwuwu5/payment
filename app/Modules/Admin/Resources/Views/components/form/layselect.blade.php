<div class="layui-form-item">
    @include('admin::components.form.label',['params'=>$params])
    <div class="layui-input-block">
        <select
            id="{{ array_get($params,'id',array_get($params,'name'))}}"
            name="{{ $params['name'] }}"
            lay-filter="{{array_get($params,'filter','') }}"
            lay-verify="{{array_get($params,'rq','')}}"
            {{ array_get($params,'search','lay-search') }}
        >
            <option value="">直接选择或搜索选择</option>
            @if(!empty($params['list']))
                @if(isset($params['key_type']) && $params['key_type']=='key_value')
                    @foreach ($params['list'] as $k=>$v)
                        @if(isset($params['on_id']))
                            <option {{ $params['on_id'] ==$k?'selected':'' }} value="{{ $k }}">{{ $v }}</option>
                        @else
                            <option value="{{ $k }}">{{ $v }}</option>
                        @endif
                    @endforeach
                @else
                    @foreach ($params['list'] as $v)
                        @if(isset($params['on_id']))
                            <option
                                {{ $params['on_id']==$v['id']?'selected':'' }} value="{{ $v['id'] }}">{{ $v['name'] }}</option>
                        @else
                            <option
                                 value="{{ $v['id'] }}">{{ $v['name'] }}</option>
                        @endif

                    @endforeach
                @endif

            @endif
        </select>
    </div>
</div>


{{--
      {{Form::LaySelect(
            [
              'name'=>'is_must',
              'title'=>'是否必选',
              'tips'=>'',
              'value'=>'',
              'key_type'=>'key_value'
              'rq'=>'rq',
              'on_id'=>1,
               'list'=>[
                   ['id'=>1,'name'=>'必选'],
                   ['id'=>0,'name'=>'可选']
                ]
            ])
        }}
--}}
