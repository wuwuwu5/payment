<div class="layui-form-item">
    @include('admin::components.form.label',['params'=>$params])
    <div class="layui-input-block">
        <div style="margin-bottom: 20px;">
            <textarea class="layui-textarea"  id="{{array_get($params, 'id', array_get($params, 'name'))}}"       lay-verify="{{array_get($params,'rq','')}}"     style="display: none">
                {{ array_get($params,'value','')}}
            </textarea>
        </div>
    </div>
</div>


{{--
    富文本使用需要配合js和事件监听一起来用 ，不需要指定name 在js监听中添加，默认富文本会增加一个 file文件上传的，这个监听中可以删除掉


           <script>
        layui.use(['index','form', 'verify','request','layedit'], function(){
            var $ = layui.$
                ,layedit = layui.layedit
                ,form = layui.form
                ,verify = layui.verify
                ,request = layui.request;
       //构建一个默认的编辑器 这里得到了一个index 如果说是 点击添加一个富文本 可以通过这个Index来获取到 数据
       layedit.set({
            uploadImage: {
                url: g_upload_files
                ,type: 'post' //默认post
            }
        });
       var index = layedit.build('LAY_demo1');
        //编辑器外部操作
        // alert(layedit.getText(index)); //获取编辑器纯文本内容
        //  alert(layedit.getContent(index)); //获取编辑器内容
        //        alert(layedit.getSelection(index));
            form.render();
            //提交
            form.on('submit(layuiadmin-form)', function(obj){
                layer.msg(JSON.stringify(obj.field));
                console.log(layedit.getContent(index))
                //请求登入接口
                console.log(obj.field);
                let editurl = $(this).data('edit');
                request.post(editurl, obj.field, function (res) {
                    if (res.code != 200) {
                        layer.msg(res.msg, {icon: 5, shift: 6});
                    }else {
                        layer.msg(res.msg, {icon: 1, shift: 6});
                    }
                })
            });
        });
    </script>
    --}}
