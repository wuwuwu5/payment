   {{ data_get($params, 'return') }} = tinymce.init({
       force_br_newlines : true,
       force_p_newlines : false,
       forced_root_block : '',
        selector: '#{{ data_get($params, 'id') }}',
//skin:'oxide-dark',
        language: 'zh_CN',
        plugins: "print preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media template code codesample table charmap hr pagebreak nonbreaking anchor insertdatetime advlist lists wordcount imagetools textpattern help emoticons autosave  autoresize axupimgs",
        toolbar: 'code undo redo restoredraft | cut copy paste pastetext | forecolor backcolor bold italic underline strikethrough link anchor | alignleft aligncenter alignright alignjustify outdent indent | \
styleselect formatselect fontselect fontsizeselect | bullist numlist | blockquote subscript superscript removeformat | \
table image media charmap emoticons hr pagebreak insertdatetime print preview | fullscreen | bdmap  lineheight formatpainter axupimgs',
        height: 650, //编辑器高度
        width: 800, //编辑器高度
        min_height: 400,
        fontsize_formats: '12px 14px 16px 18px 24px 36px 48px 56px 72px',
        font_formats: '微软雅黑=Microsoft YaHei,Helvetica Neue,PingFang SC,sans-serif;苹果苹方=PingFang SC,Microsoft YaHei,sans-serif;宋体=simsun,serif;仿宋体=FangSong,serif;黑体=SimHei,sans-serif;Arial=arial,helvetica,sans-serif;Arial Black=arial black,avant garde;Book Antiqua=book antiqua,palatino;',
        importcss_append: true,
        init_instance_callback: function(editor) {
           editor.setContent(`{!!  data_get($params, 'content') !!}`);
        },
        file_picker_callback: function (callback, value, meta) {
            //要先模拟出一个input用于上传本地文件
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            //你可以给input加accept属性来限制上传的文件类型
            //例如：input.setAttribute('accept', '.jpg,.png');
            input.click();
            input.onchange = function () {
                layer.load(1); //上传loading
                var file = this.files[0];

                var xhr, formData;

                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', g_upload_files);
                xhr.onload = function () {
                    var json;
                    if (xhr.status != 200) {
                        layer.closeAll('loading'); //关闭loading
                        failFun('上传失败');
                        return;
                    }
                    json = JSON.parse(xhr.responseText);
                    if (!json || typeof json.data.src != 'string') {
                        layer.closeAll('loading'); //关闭loading
                        failFun('上传失败');
                        return;
                    }
                    layer.closeAll('loading'); //关闭loading

                    if (meta.filetype == 'file') {
                        callback(json.data.src, {text: file.name});
                    }

// Provide image and alt text for the image dialog
                    if (meta.filetype == 'image') {
                        callback(json.data.src, {alt: file.name});
                    }
// Provide alternative source and posted for the media dialog
                    if (meta.filetype == 'media') {
                        callback(json.data.src, {source2: 'alt.ogg', poster: file.name});
                    }
                };
                formData = new FormData();
                formData.append('file', file, file.name);
                xhr.send(formData);
            }
        },
        images_upload_handler: function (blobInfo, succFun, failFun) {
            var xhr, formData;
            var file = blobInfo.blob();//转化为易于理解的file对象
            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', g_upload_files);
            xhr.onload = function () {
                layer.load(1); //上传loading
                var json;
                if (xhr.status != 200) {
                    layer.closeAll('loading'); //关闭loading
                    failFun('上传失败');
                    return;
                }
                json = JSON.parse(xhr.responseText);

                if (!json || typeof json.data.src != 'string') {
                    layer.closeAll('loading'); //关闭loading
                    failFun('上传失败');
                    return;
                }
                layer.closeAll('loading'); //关闭loading
                succFun(json.data.src);
            };
            formData = new FormData();
            formData.append('file', file, file.name);//此处与源文档不一样
            xhr.send(formData);
        },
        autosave_ask_before_unload: false,
    });
