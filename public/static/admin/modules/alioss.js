layui.define(['aliossUploader','layer'], function (exports) {
    var $ = layui.$;
    var aliossUploader = layui.aliossUploader
    var aioss = {
        file: uploadOne,
        img:upimg
        //place_editor: uploadEditor,
    }
    function uploadOne() {
        aliossUploader.render({
            elm: '[data-toggle="fileupload"]',
            layerTitle: '上传数据文件',
            accessidFiled: 'accessid',
            policyFiled: 'policy',
            signatureFiled: 'signature',
            policyUrl: g_upload_token,
            prefixPath: 'file/',
            multiple: false,
            httpStr: 'http',
            allUploaded: function (res) {
                var fileid = $(res[0].elm).data('obj')
                // $('#'+fileid).find('.layui-upload-file').remove();
                $('#'+fileid).find('input').first().val(res[0].key);
                $('#'+fileid).find('button').html('已上传');
                layer.msg('上传成功');
            },
            policyFailed: function (res) {
                layer.msg(JSON.stringify(res));
            }
        });
    }
    function upimg() {
        aliossUploader.render({
            elm: '[data-toggle="fileupimg"]',
            layerTitle: '上传数据文件',
            accessidFiled: 'accessid',
            policyFiled: 'policy',
            signatureFiled: 'signature',
            policyUrl: g_upload_token,
            prefixPath: 'file/',
            multiple: false,
            httpStr: 'http',
            allUploaded: function (res) {
                var fileid = $(res[0].elm).data('obj')
                // $('#'+fileid).find('.layui-upload-file').remove();
                $('#'+fileid).find('input').first().val(res[0].key);
                $('#'+fileid).find('button').html('已上传');
                $('#'+fileid).find('img').attr('src',res[0].ossUrl)
                layer.msg('上传成功');
            },
            policyFailed: function (res) {
                layer.msg(JSON.stringify(res));
            }
        });
    }
    exports('alioss', aioss);
})
