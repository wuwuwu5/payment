
<div class="layui-form-item">
    @include('admin::components.form.label',['params'=>$params])
    <div class="layui-input-block" id="{{ md5(array_get($params,'id','name'))}}">
        <input  type="hidden"
                name="{{ array_get($params,'name','name') }}"
                value="{{array_get($params,'value','')}}"
                lay-verify="{{array_get($params,'rq','')}}"
                autocomplete="off" class="layui-input"/>
        <div class="icon-add" style="display: inline-block;padding: 9px 0!important">
            <span class="{{ array_get($params,'value','') }}"></span>
        </div>
        <button class="layui-btn layui-btn-xs layui-btn-info"  id='{{ md5(md5(array_get($params,'id','name'))) }}' data-more="0" data-type="file" data-toggle="fileupload" data-obj="{{ md5(array_get($params,'id','name')) }}">上传文件</button>
    </div>
</div>

{{--
    还需要引入  alioss
     layui.use(['index','form','alioss'], function(){
            var alioss = layui.alioss;
                alioss.file()

    // 默认会带有一个 file  需要在form 里面进行删除

      form.on('submit(layuiadmin-form)', function(obj){
                delete obj.field.file; // 这一行需要加

    --}}
