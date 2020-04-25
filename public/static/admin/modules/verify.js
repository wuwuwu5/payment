layui.define(['form'], function (exports) {
    var $ = layui.$,
        form = layui.form;

    form.verify({
        phone: [/(^$)|^1\d{10}$/, '请输入正确的手机号'],
        email: [/(^$)|^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/, '邮箱格式不正确'],
        url: [/(^$)|(^#)|(^http(s*):\/\/[^\s]+\.[^\s]+)/, '链接格式不正确'],
        number: [/(^$)|^\d+$/, '只能填写数字'],
        date: [/(^$)|^(\d{4})[-\/](\d{1}|0\d{1}|1[0-2])([-\/](\d{1}|0\d{1}|[1-2][0-9]|3[0-1]))*$/, '日期格式不正确'],
        identity: [/(^$)|(^\d{15}$)|(^\d{17}(x|X|\d)$)/, '请输入正确的身份证号'],
        ename: function (value, item) { //value：表单的值、item：表单的DOM对象
            if (!new RegExp("^[a-zA-Z][a-zA-Z0-9_]*$").test(value)) {
                return '请使用英文字母开头字符';
            }
        },
        rq: function (value, item) { //value：表单的值、item：表单的DOM对象
            var title = $(item).data('title');
            if (!title) {
                //自动获取
                title = $(item).attr('placeholder');

                title = $(item).parents('.layui-form-item').find('.layui-form-label').text();
                if (!title) {
                    title = $(item).parents('.layui-form-item').find('.layui-form-label').text();
                }
                if (!title) {

                }
                if (!title) {
                    title = $(item).attr('tips');
                }


            }

            if (!value) {
                return '必填' + title;
            }

        },
        rq2: function (value, item) { //value：表单的值、item：表单的DOM对象
            var title = $(item).data('title');
            if (!title) {
                //自动获取
                title = $(item).attr('placeholder');
                if (!title) {
                    title = $(item).attr('tips');
                }


            }

            if (!value) {
                return '必填' + title;
            }

        },
        required: function (value, item) { //value：表单的值、item：表单的DOM对象
            var title = $(item).data('title');
            if (!title) {
                //自动获取
                title = $(item).parents('.layui-form-item').find('.layui-form-label').text();
                if (!title) {
                    title = $(item).parents('.layui-form-item').find('.layui-form-label').text();
                }
                if (!title) {
                    title = $(item).attr('placeholder');
                }
                if (!title) {
                    title = $(item).attr('tips');
                }


            }

            if (!value) {
                return '必填' + title;
            }

        },
        max_number: function (value, item) { //value：表单的值、item：表单的DOM对象
            var max2 = $(item).attr('max');

            value = parseInt(value);

            is_true = value > max2 ? 1 : 0;

            if (is_true) {

                return '不能超过' + max2;

            }


        },

        thumb: function (value, item) {

            var title = $(item).data('title');
            if (!title) {
                //自动获取
                title = $(item).parents('.layui-form-item').find('.layui-form-label').text();
                if (!title) {
                    title = $(item).parents('.layui-form-item').find('.layui-form-label').text();
                }
                if (!title) {
                    title = $(item).attr('placeholder');
                }
                if (!title) {
                    title = $(item).attr('tips');
                }

            }
            if (!value) {
                return '请上传' + title || '请上传必填图片';
            }


        },
        checkbox: function (value, item) {
            //获得checkbox的名字
            var checkbox_name = $(item).attr('name');
            var length = $(item).data('min');
            length = length || 1;//可以把上面第一种方案改成这种，更加优化
            var title = $(item).data('title');
            var size_length = $("[name='" + checkbox_name + "']:checked").length;
            if (size_length < length) {
                $(item).parent(".layui-input-block").addClass('layui-form-danger');
                return '请选择' + title + '最少' + length + '项' || '必填一项';
            }
        },
        radio: function (value, item) {
            //获得checkbox的名字
            var checkbox_name = $(item).attr('name');

            var title = $(item).data('title');
            var pline = $(item).parents('.layui-inline,.layui-form-item,.layui-input-block').find('.layui-form-label').text();
            title = title || pline;
            if (!title) {
                title = $(item).attr('placeholder');
            }
            if (!title) {
                title = $(item).attr('tips');
            }
            var size_length = $("[name='" + checkbox_name + "']:checked").length;
            if (!size_length) {
                $(item).parents(".layui-input-block").addClass('layui-form-danger');
                return '请选择' + title || '请选择';
            }
        },
        pass: [
            /^[\S]{6,12}$/, '密码必须6到12位，且不能出现空格'
        ],
        cnname: [
            /^[\u4e00-\u9fa5]+$/,
            '中文开头'
        ],
        en: [
            /^[a-zA-Z]+$/,
            '必须纯英文'
        ],
        fva: function (value, item) {
            if (!$.trim(value)) {
                var name = item.name;
                var hideen = $(item).is(':hidden');
                if (hideen) {
                    return $(item).attr('title') + "不能为空";
                }
            }
        },
        options: function (value, item) {
            let val = $.trim(layui.layedit.getContent($(item).data('edit')))
            if (val === null || val === "" || val === undefined) {
                return item.getAttribute('placeholder') + '选项不能为空'
            }
        },
        select_papers: function (value, item) {
            var select = $(item).attr('ts-selected')
            if (select === undefined || select === null || select === '') {
                return '必填试卷'
            }
            if ($.trim(value) === undefined || $.trim(value) === null || $.trim(value) === '') {
                return '必填试卷'
            }
        },
        select_whites: function (value, item) {
          var val = $('input[name="type"]:checked').val();
          console.log(val)

          if (val == 1) {
              var select = $(item).attr('ts-selected')
              if (select === undefined || select === null || select === '') {
                  return '必填考生'
              }

              if ($("input[name^='white_lists']").length <= 0) {
                  return '必填考生'
              }
          }
        },
        id_card: function (value, item) {
            const regIdCard = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;
            if (!regIdCard.test(value)) {
                return '身份证号填写有误';
            }
        },
    });


    exports('verify', {});
});
