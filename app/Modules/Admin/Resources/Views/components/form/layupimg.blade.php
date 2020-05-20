<div class="layui-form-item">
    @include('admin::components.form.label',['params'=>$params])
    @php
        $md5 =  md5(md5(array_get($params,'id','name') . array_get($params, 'name', time())));
    @endphp
    <div class="layui-input-block" id="{{$md5}}">
        <input type="hidden"
               name="{{ array_get($params,'name','name') }}"
               value="{{array_get($params,'value','')}}"
               lay-verify="{{array_get($params,'rq','')}}"
               autocomplete="off" class="layui-input"/>
        <img src="{{render_cover(array_get($params,'value',''))}}" width="{{array_get($params,'width','200')}}"
             height="{{array_get($params,'height','200')}}" alt="">

        <button class="layui-btn layui-btn-xs layui-btn-info btn-{{ array_get($params,'name','name') }}"
                id='{{ $md5}}'
                data-more="0" data-type="file" data-toggle="fileupimg"
                data-obj="{{ $md5 }}">上传文件
        </button>
        <p>{{array_get($params,'tips','')}}</p>
    </div>
</div>

{{--

    还需要引入  alioss
     layui.use(['index','form','alioss'], function(){
            var alioss = layui.alioss;
                alioss.one()

    // 默认会带有一个 file  需要在form 里面进行删除

      form.on('submit(layuiadmin-form)', function(obj){
                delete obj.field.file; // 这一行需要加


    --}}
