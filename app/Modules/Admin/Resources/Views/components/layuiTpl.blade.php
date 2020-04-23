@verbatim
    <script type="text/html" id="toolbarSlideManage">
        <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="open_layer" data-url="{{d.slide_manage_edit}}"
           data-w="100%" data-h="100%"><i
                class="layui-icon layui-icon-edit"></i>编辑</a>
        <a class="layui-btn layui-btn-danger layui-btn-xs" kq-event="del_layer" data-token="{{ d._token }}"
           data-url="{{d.slide_manage_del}}" data-w="100%" data-h="100%"><i
                class="layui-icon layui-icon-delete"></i>删除</a>
    </script>
    <script type="text/html" id="toolbarSlide">
        <div class="layui-btn-container">
            <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="open_layer" data-url="{{d.slide_manage}}"
               data-w="100%" data-h="100%"><i
                    class="layui-icon layui-icon-add-1"></i>添加轮播图</a>
            <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit"><i
                    class="layui-icon layui-icon-edit"></i>编辑</a>
            <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i
                    class="layui-icon layui-icon-delete"></i>删除</a>
        </div>
    </script>
    <script type="text/html" id="toolbarDelCheck">
        <div class="layui-btn-container">
            <button class="layui-btn layui-btn-sm layui-btn-primary" lay-event="delete">
                <i class="layui-icon layui-icon-delete"></i>全部删除
            </button>
            <button class="layui-btn layui-btn-xs layui-btn-normal" lay-event="check_pass"><i
                    class="layui-icon layui-icon-ok"></i>设置已审核
            </button>
            <button class="layui-btn layui-btn-xs layui-btn-normal" lay-event="check_unpass"><i
                    class="layui-icon layui-icon-close"></i>设置未审核
            </button>
        </div>
    </script>
    <script type="text/html" id="toolbarDel">
        <div class="layui-btn-container">
            <button class="layui-btn layui-btn-sm layui-btn-primary" lay-event="delete">
                全部删除
            </button>
        </div>
    </script>
    <script type="text/html" id="tpl-create-edit">
        {{# if(d.btns){ }}
        <p>
            {{#  layui.each(d.btns, function(index, item){ }}

            <a href="{{ item.url }}" target="{{ item.target || '_self' }}"
               class="layui-btn {{ item.class_name }} layui-btn-xs"><i
                    class="layui-icon {{ item.icon || '' }}"></i>{{ item.name }}</a>
            {{# if(index>3){  }}
            <br/>
            {{# } }}
            {{#  }); }}
        </p>
        {{#  }; }}
        {{# if(d.btn_open){ }}
        <p>
            {{#  layui.each(d.btn_open, function(index, item){ }}
            <a lay-event="open_layer" data-w="{{ item.w || '1200px' }}"
               data-h="{{ item.h || '800px' }}"
               data-title="{{ item.title || item.name }}" data-url="{{ item.url }}"
               class="layui-btn {{ item.class_name }} layui-btn-xs"><i
                    class="layui-icon {{ item.icon || '' }}"></i>{{ item.name }}</a>
            {{# if(index>3){  }}
            <br/>
            {{# } }}
            {{#  }); }}

        </p>
        {{#  }; }}
        {{# if(d.btn_posts){ }}
        <p>
            {{#  layui.each(d.btn_posts, function(index, item){ }}
            <a lay-event="open_post" data-w="{{ item.w || '1200px' }}"
               data-h="{{ item.h || '800px' }}"
               data-title="{{ item.title || item.name }}" data-post_url="{{ item.post_url }}"
               class="layui-btn {{ item.class_name }} layui-btn-xs"><i
                    class="layui-icon {{ item.icon || '' }}"></i>{{ item.name }}</a>
            {{# if(index>3){  }}
            <br/>
            {{# } }}
            {{#  }); }}

        </p>
        {{#  }; }}
        {{# if(!d.no_edit_btn){  }}
        <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit"><i
                class="layui-icon layui-icon-edit"></i>编辑</a>
        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i
                class="layui-icon layui-icon-delete"></i>删除</a>
        {{# } }}
    </script>
    <script type="text/html" id="tpl-user-create-edit">
        {{# if(d.btns){ }}
        <p>
            {{#  layui.each(d.btns, function(index, item){ }}

            <a href="{{ item.url }}" target="{{ item.target || '_self' }}"
               class="layui-btn {{ item.class_name }} layui-btn-xs"><i
                    class="layui-icon {{ item.icon || '' }}"></i>{{ item.name }}</a>
            {{# if(index>3){  }}
            <br/>
            {{# } }}
            {{#  }); }}
        </p>
        {{#  }; }}
        {{# if(d.btn_open){ }}
        <p>
            {{#  layui.each(d.btn_open, function(index, item){ }}
            <a lay-event="open_layer" data-w="{{ item.w || '1200px' }}"
               data-h="{{ item.h || '800px' }}"
               data-title="{{ item.title || item.name }}" data-url="{{ item.url }}"
               class="layui-btn {{ item.class_name }} layui-btn-xs"><i
                    class="layui-icon {{ item.icon || '' }}"></i>{{ item.name }}</a>
            {{# if(index>3){  }}
            <br/>
            {{# } }}
            {{#  }); }}

        </p>
        {{#  }; }}
        {{# if(d.btn_posts){ }}
        <p>
            {{#  layui.each(d.btn_posts, function(index, item){ }}
            <a lay-event="open_post" data-w="{{ item.w || '1200px' }}"
               data-h="{{ item.h || '800px' }}"
               data-title="{{ item.title || item.name }}" data-post_url="{{ item.post_url }}"
               class="layui-btn {{ item.class_name }} layui-btn-xs"><i
                    class="layui-icon {{ item.icon || '' }}"></i>{{ item.name }}</a>
            {{# if(index>3){  }}
            <br/>
            {{# } }}
            {{#  }); }}

        </p>
        {{#  }; }}
        {{# if(!d.no_edit_btn){  }}
        <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit"><i
                class="layui-icon layui-icon-edit"></i>编辑</a>
        <a class="layui-btn layui-btn-warm layui-btn-xs" lay-event="reset_password"><i
                class="layui-icon"></i>重置密码</a>
        {{# } }}
    </script>
    <script type="text/html" id="tpl-edit">
        {{# if(d.btns){ }}
        <p>
            {{#  layui.each(d.btns, function(index, item){ }}

            <a href="{{ item.url }}" target="{{ item.target || '_self' }}"
               class="layui-btn {{ item.class_name }} layui-btn-xs"><i
                    class="layui-icon {{ item.icon || '' }}"></i>{{ item.name }}</a>
            {{# if(index>3){  }}
            <br/>
            {{# } }}
            {{#  }); }}
        </p>
        {{#  }; }}
        {{# if(d.btn_open){ }}
        <p>
            {{#  layui.each(d.btn_open, function(index, item){ }}
            <a lay-event="open_layer" data-w="{{ item.w || '1200px' }}"
               data-h="{{ item.h || '800px' }}"
               data-title="{{ item.title || item.name }}" data-url="{{ item.url }}"
               class="layui-btn {{ item.class_name }} layui-btn-xs"><i
                    class="layui-icon {{ item.icon || '' }}"></i>{{ item.name }}</a>
            {{# if(index>3){  }}
            <br/>
            {{# } }}
            {{#  }); }}

        </p>
        {{#  }; }}
        {{# if(d.btn_posts){ }}
        <p>
            {{#  layui.each(d.btn_posts, function(index, item){ }}
            <a lay-event="open_post" data-w="{{ item.w || '1200px' }}"
               data-h="{{ item.h || '800px' }}"
               data-title="{{ item.title || item.name }}" data-post_url="{{ item.post_url }}"
               class="layui-btn {{ item.class_name }} layui-btn-xs"><i
                    class="layui-icon {{ item.icon || '' }}"></i>{{ item.name }}</a>
            {{# if(index>3){  }}
            <br/>
            {{# } }}
            {{#  }); }}

        </p>
        {{#  }; }}
        {{# if(!d.no_edit_btn){  }}
        <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit"><i
                class="layui-icon layui-icon-edit"></i>编辑</a>
        {{# } }}
    </script>

    <script type="text/html" id="tpl-del">
        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i
                class="layui-icon layui-icon-delete"></i>删除</a>
    </script>
    <script type="text/html" id="tpl-create-no-edit">
        {{# if(d.btns){ }}
        <p>
            {{#  layui.each(d.btns, function(index, item){ }}

            <a href="{{ item.url }}" class="layui-btn {{ item.class_name }} layui-btn-xs"><i
                    class="layui-icon {{ item.icon || '' }}"></i>{{ item.name }}</a>
            {{#  }); }}
            {{# if(index>3){  }}
            <br/>
            {{# } }}
        </p>
        {{#  }; }}
        {{# if(d.btn_open){ }}
        <p>
            {{#  layui.each(d.btn_open, function(index, item){ }}
            <a lay-event="open_layer" data-w="{{ item.w || '1200px' }}"
               data-h="{{ item.h || '800px' }}"
               data-title="{{ item.title || item.name }}" data-url="{{ item.url }}"
               class="layui-btn {{ item.class_name }} layui-btn-xs"><i
                    class="layui-icon {{ item.icon || '' }}"></i>{{ item.name }}</a>
            {{#  }); }}
            {{# if(index>3){  }}
            <br/>
            {{# } }}
        </p>
        {{#  }; }}

    </script>
    <script type="text/html" id="tpl-user-thumb">
        {{# if(d.thumb){ }}
        <img lay-event="show_img" style="" src= {{ d.thumb}}>
        {{#  }; }}
    </script>
    <script type="text/html" id="tpl-icon">
        <span class="{{ d.icon }}"></span>
    </script>

    <script>
        function layui_btn_tpl(title, event, classname) {
            return ' <a class="layui-btn  layui-btn-xs ' + classname + '" lay-event="' + event + '"><i class="layui-icon layui-icon-delete"></i>' + title + '</a>';
        }

        //回调函数
        function layui_switch(field, d, text, true_value, false_value) {
            text = text || '是|否';
            true_value = true_value || 1;
            false_value = false_value || 0;
            return '<input type="checkbox" data-true_value="' + true_value + '" data-false_value="' + false_value + '"  lay-skin="switch" lay-text="' + text + '" lay-filter="table-checked" ' +
                'value="' + d[field] + '" data-id="' + d.id + '"  data-field="' + field + '" ' + (d[field] == true_value ? 'checked' : '') + '>';
        }

        //回调函数
        function layui_user_switch(field, d, text, true_value, false_value) {
            text = text || '是|否';
            true_value = true_value || 0;
            false_value = false_value || 1;
            return '<input type="checkbox" data-true_value="0" data-false_value="1"  lay-skin="switch" lay-text="启用|禁用" lay-filter="table-user-checked" ' +
                'value="' + d[field] + '" data-id="' + d.id + '"  data-field="' + field + '" ' + (d[field] == 0 ? 'checked' : '') + '>';
        }

        //回调函数
        function layui_status_switch(field, d, text, true_value, false_value) {
            text = text || '是|否';
            true_value = true_value || 0;
            false_value = false_value || 1;
            return '<input type="checkbox" data-true_value="1" data-false_value="0"  lay-skin="switch" lay-text="启用|禁用" lay-filter="table-status-checked" ' +
                'value="' + d[field] + '" data-id="' + d.id + '"  data-field="' + field + '" ' + (d[field] == 1 ? 'checked' : '') + '>';
        }

        function layui_pic(img) {
            if (img) {
                return ' <img lay-event="show_img" style="height:70px;" src="' + img + '">';
            }
        }

        //回调函数设置label
        function layui_label(value, class_style) {
            var class_name = 'label-' + class_style;
            return '<span class="label  ' + class_name + '">' + value + '</span>';
        }

        //回调标题设置查看
        function layui_title_show(title, url, type, w, h) {
            switch (type) {
                case 'open_layer':
                    return '<a lay-tips="点击查看详情" href="javascript:void(0)" class="text-primary" data-w="' + (w || '80%') + '" data-h="' + (h || '80%') + '" data-url="' + url + '" ' +
                        'data-title="' + (title) + '" lay-event="open_layer">' + (title) + '</a>';
                    break;
                case 'link':
                    return '<a class="text-primary" href="' + url + '" >' + (title) + '</a>';
                    break;
            }


        }

        function layui_btn_show(title, url, type, classname, w, h) {
            switch (type) {
                case 'open_layer':
                    return '<a lay-tips="点击查看详情" href="javascript:void(0)" class="layui-btn layui-btn-xs ' + (classname || 'layui-btn-normal') + '" data-w="' + (w || '80%') + '" data-h="' + (h || '80%') + '" data-url="' + url + '" ' +
                        'data-title="' + (title) + '" lay-event="open_layer">' + (title) + '</a>';
                    break;
                case 'link':
                    return '<a class="layui-btn layui-btn-xs ' + (classname || 'layui-btn-normal') + '" href="' + url + '" >' + (title) + '</a>';
                    break;
            }
        }

        function layui_open_post(title, url, post, tips, w, h) {
            w = w || '100%';
            h = h || '100%';
            tips = tips || '操作';
            return '<a href="javascript:void(0)" data-title="' + tips + '" lay-event="open_layer_post" class="layui-btn layui-btn-normal layui-btn-xs" data-post_url="' + post + '" data-url="' + url + '" data-w="' + w + '" data-h="' + h + '">' + title + '</a>'
        }

    </script>
    <script type="text/html" id="tpl-edit">
        {{# if(d.btns){ }}
        <p>
            {{#  layui.each(d.btns, function(index, item){ }}

            <a href=" " target="{{ item.target || '_self' }}"
               class="layui-btn {{ item.class_name }} layui-btn-xs"><i
                    class="layui-icon {{ item.icon || '' }}"></i>{{ item.name }}</a>
            {{# if(index>3){  }}
            <br/>
            {{# } }}
            {{#  }); }}
        </p>
        {{#  }; }}
        {{# if(d.btn_open){ }}
        <p>
            {{#  layui.each(d.btn_open, function(index, item){ }}
            <a lay-event="open_layer" data-w="{{ item.w || '1200px' }}"
               data-h="{{ item.h || '800px' }}"
               data-title="{{ item.title || item.name }}" data-url="{{ item.url }}"
               class="layui-btn {{ item.class_name }} layui-btn-xs"><i
                    class="layui-icon {{ item.icon || '' }}"></i>{{ item.name }}</a>
            {{# if(index>3){  }}
            <br/>
            {{# } }}
            {{#  }); }}

        </p>
        {{#  }; }}
        {{# if(d.btn_posts){ }}
        <p>
            {{#  layui.each(d.btn_posts, function(index, item){ }}
            <a lay-event="open_post" data-w="{{ item.w || '1200px' }}"
               data-h="{{ item.h || '800px' }}"
               data-title="{{ item.title || item.name }}" data-post_url="{{ item.post_url }}"
               class="layui-btn {{ item.class_name }} layui-btn-xs"><i
                    class="layui-icon {{ item.icon || '' }}"></i>{{ item.name }}</a>
            {{# if(index>3){  }}
            <br/>
            {{# } }}
            {{#  }); }}

        </p>
        {{#  }; }}
        {{# if(!d.no_edit_btn){  }}
        <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit"><i
                class="layui-icon layui-icon-edit"></i>编辑</a>
        {{# } }}
    </script>
    <script type="text/html" id="tpl-edit-add">
        {{# if(d.btns){ }}
        <p>
            {{#  layui.each(d.btns, function(index, item){ }}

            <a href=" " target="{{ item.target || '_self' }}"
               class="layui-btn {{ item.class_name }} layui-btn-xs"><i
                    class="layui-icon {{ item.icon || '' }}"></i>{{ item.name }}</a>
            {{# if(index>3){  }}
            <br/>
            {{# } }}
            {{#  }); }}
        </p>
        {{#  }; }}
        {{# if(d.btn_open){ }}
        <p>
            {{#  layui.each(d.btn_open, function(index, item){ }}
            <a lay-event="open_layer" data-w="{{ item.w || '1200px' }}"
               data-h="{{ item.h || '800px' }}"
               data-title="{{ item.title || item.name }}" data-url="{{ item.url }}"
               class="layui-btn {{ item.class_name }} layui-btn-xs"><i
                    class="layui-icon {{ item.icon || '' }}"></i>{{ item.name }}</a>
            {{# if(index>3){  }}
            <br/>
            {{# } }}
            {{#  }); }}

        </p>
        {{#  }; }}
        {{# if(d.btn_posts){ }}
        <p>
            {{#  layui.each(d.btn_posts, function(index, item){ }}
            <a lay-event="open_post" data-w="{{ item.w || '1200px' }}"
               data-h="{{ item.h || '800px' }}"
               data-title="{{ item.title || item.name }}" data-post_url="{{ item.post_url }}"
               class="layui-btn {{ item.class_name }} layui-btn-xs"><i
                    class="layui-icon {{ item.icon || '' }}"></i>{{ item.name }}</a>
            {{# if(index>3){  }}
            <br/>
            {{# } }}
            {{#  }); }}

        </p>
        {{#  }; }}
        {{# if(!d.no_edit_btn){  }}
        <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit" data-w="70%"
           data-h="95%"><i
                class="layui-icon layui-icon-edit" ></i>编辑</a>
        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i
                class="layui-icon layui-icon-delete"></i>删除</a>
        {{# if(d.type == "offspring"){ }}
        <a class="layui-btn  layui-btn-warm layui-btn-xs" lay-event="add_child_question" data-w="75%"
           data-h="98%"><i
                class="layui-icon layui-icon-list"></i>详情</a>
        {{#  }; }}
        {{# } }}
    </script>
    <script type="text/html" id="tpl-user-show">
        {{# if(d.btns){ }}
        <p>
            {{#  layui.each(d.btns, function(index, item){ }}

            <a href=" " target="{{ item.target || '_self' }}"
               class="layui-btn {{ item.class_name }} layui-btn-xs"><i
                    class="layui-icon {{ item.icon || '' }}"></i>{{ item.name }}</a>
            {{# if(index>3){  }}
            <br/>
            {{# } }}
            {{#  }); }}
        </p>
        {{#  }; }}
        {{# if(d.btn_open){ }}
        <p>
            {{#  layui.each(d.btn_open, function(index, item){ }}
            <a lay-event="open_layer" data-w="{{ item.w || '1200px' }}"
               data-h="{{ item.h || '800px' }}"
               data-title="{{ item.title || item.name }}" data-url="{{ item.url }}"
               class="layui-btn {{ item.class_name }} layui-btn-xs"><i
                    class="layui-icon {{ item.icon || '' }}"></i>{{ item.name }}</a>
            {{# if(index>3){  }}
            <br/>
            {{# } }}
            {{#  }); }}

        </p>
        {{#  }; }}
        {{# if(d.btn_posts){ }}
        <p>
            {{#  layui.each(d.btn_posts, function(index, item){ }}
            <a lay-event="open_post" data-w="{{ item.w || '1200px' }}"
               data-h="{{ item.h || '800px' }}"
               data-title="{{ item.title || item.name }}" data-post_url="{{ item.post_url }}"
               class="layui-btn {{ item.class_name }} layui-btn-xs"><i
                    class="layui-icon {{ item.icon || '' }}"></i>{{ item.name }}</a>
            {{# if(index>3){  }}
            <br/>
            {{# } }}
            {{#  }); }}

        </p>
        {{#  }; }}
        {{# if(!d.no_edit_btn){  }}
        <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="user_show"><i
                class="layui-icon layui-icon-edit"></i>详情</a>
        {{# } }}
    </script>
    <script type="text/html" id="tpl-exam-users">
        {{# if(d.btns){ }}
        <p>
            {{#  layui.each(d.btns, function(index, item){ }}

            <a href=" " target="{{ item.target || '_self' }}"
               class="layui-btn layui-btn-primary {{ item.class_name }} layui-btn-xs"><i
                    class="layui-icon {{ item.icon || '' }}"></i>{{ item.name }}</a>
            {{# if(index>3){  }}
            <br/>
            {{# } }}
            {{#  }); }}
        </p>
        {{#  }; }}
        {{# if(d.btn_open){ }}
        <p>
            {{#  layui.each(d.btn_open, function(index, item){ }}
            <a lay-event="open_layer" data-w="{{ item.w || '1200px' }}"
               data-h="{{ item.h || '800px' }}"
               data-title="{{ item.title || item.name }}" data-url="{{ item.url }}"
               class="layui-btn {{ item.class_name }} layui-btn-xs"><i
                    class="layui-icon {{ item.icon || '' }}"></i>{{ item.name }}</a>
            {{# if(index>3){  }}
            <br/>
            {{# } }}
            {{#  }); }}

        </p>
        {{#  }; }}
        {{# if(d.btn_posts){ }}
        <p>
            {{#  layui.each(d.btn_posts, function(index, item){ }}
            <a lay-event="open_post" data-w="{{ item.w || '1200px' }}"
               data-h="{{ item.h || '800px' }}"
               data-title="{{ item.title || item.name }}" data-post_url="{{ item.post_url }}"
               class="layui-btn {{ item.class_name }} layui-btn-xs"><i
                    class="layui-icon {{ item.icon || '' }}"></i>{{ item.name }}</a>
            {{# if(index>3){  }}
            <br/>
            {{# } }}
            {{#  }); }}

        </p>
        {{#  }; }}
        {{# if(!d.no_edit_btn){  }}
        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="show_exam_users" data-w="90%"  data-h="90%">进入评卷</a>
        {{# } }}
    </script>
    <script type="text/html" id="tpl-exam-show-users">
        {{# if(d.btns){ }}
        <p>
            {{#  layui.each(d.btns, function(index, item){ }}

            <a href=" " target="{{ item.target || '_self' }}"
               class="layui-btn layui-btn-primary {{ item.class_name }} layui-btn-xs"><i
                    class="layui-icon {{ item.icon || '' }}"></i>{{ item.name }}</a>
            {{# if(index>3){  }}
            <br/>
            {{# } }}
            {{#  }); }}
        </p>
        {{#  }; }}
        {{# if(d.btn_open){ }}
        <p>
            {{#  layui.each(d.btn_open, function(index, item){ }}
            <a lay-event="open_layer" data-w="{{ item.w || '1200px' }}"
               data-h="{{ item.h || '800px' }}"
               data-title="{{ item.title || item.name }}" data-url="{{ item.url }}"
               class="layui-btn {{ item.class_name }} layui-btn-xs"><i
                    class="layui-icon {{ item.icon || '' }}"></i>{{ item.name }}</a>
            {{# if(index>3){  }}
            <br/>
            {{# } }}
            {{#  }); }}

        </p>
        {{#  }; }}
        {{# if(d.btn_posts){ }}
        <p>
            {{#  layui.each(d.btn_posts, function(index, item){ }}
            <a lay-event="open_post" data-w="{{ item.w || '1200px' }}"
               data-h="{{ item.h || '800px' }}"
               data-title="{{ item.title || item.name }}" data-post_url="{{ item.post_url }}"
               class="layui-btn {{ item.class_name }} layui-btn-xs"><i
                    class="layui-icon {{ item.icon || '' }}"></i>{{ item.name }}</a>
            {{# if(index>3){  }}
            <br/>
            {{# } }}
            {{#  }); }}

        </p>
        {{#  }; }}
        {{# if(!d.no_edit_btn){  }}
        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="join_marking">查看试卷</a>
        {{# } }}
    </script>
    <script type="text/html" id="tpl-achievement-users">
        {{# if(d.btns){ }}
        <p>
            {{#  layui.each(d.btns, function(index, item){ }}

            <a href=" " target="{{ item.target || '_self' }}"
               class="layui-btn {{ item.class_name }} layui-btn-xs"><i
                    class="layui-icon {{ item.icon || '' }}"></i>{{ item.name }}</a>
            {{# if(index>3){  }}
            <br/>
            {{# } }}
            {{#  }); }}
        </p>
        {{#  }; }}
        {{# if(d.btn_open){ }}
        <p>
            {{#  layui.each(d.btn_open, function(index, item){ }}
            <a lay-event="open_layer" data-w="{{ item.w || '1200px' }}"
               data-h="{{ item.h || '800px' }}"
               data-title="{{ item.title || item.name }}" data-url="{{ item.url }}"
               class="layui-btn {{ item.class_name }} layui-btn-xs"><i
                    class="layui-icon {{ item.icon || '' }}"></i>{{ item.name }}</a>
            {{# if(index>3){  }}
            <br/>
            {{# } }}
            {{#  }); }}

        </p>
        {{#  }; }}
        {{# if(d.btn_posts){ }}
        <p>
            {{#  layui.each(d.btn_posts, function(index, item){ }}
            <a lay-event="open_post" data-w="{{ item.w || '1200px' }}"
               data-h="{{ item.h || '800px' }}"
               data-title="{{ item.title || item.name }}" data-post_url="{{ item.post_url }}"
               class="layui-btn {{ item.class_name }} layui-btn-xs"><i
                    class="layui-icon {{ item.icon || '' }}"></i>{{ item.name }}</a>
            {{# if(index>3){  }}
            <br/>
            {{# } }}
            {{#  }); }}

        </p>
        {{#  }; }}
        {{# if(!d.no_edit_btn){  }}
        <a class="layui-btn layui-btn layui-btn-xs" lay-event="show_achievement_users" data-h="90%" data-w="90%">查看详情</a>
        <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="show_achievement_analysis" data-h="90%" data-w="90%">考试分析</a>
        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="add_exam" data-h="90%" data-w="90%">安排补考</a>
        {{# } }}
    </script>
    <script type="text/html" id="tpl-invigilate-users">
        {{# if(d.btns){ }}
        <p>
            {{#  layui.each(d.btns, function(index, item){ }}

            <a href=" " target="{{ item.target || '_self' }}"
               class="layui-btn {{ item.class_name }} layui-btn-xs"><i
                    class="layui-icon {{ item.icon || '' }}"></i>{{ item.name }}</a>
            {{# if(index>3){  }}
            <br/>
            {{# } }}
            {{#  }); }}
        </p>
        {{#  }; }}
        {{# if(d.btn_open){ }}
        <p>
            {{#  layui.each(d.btn_open, function(index, item){ }}
            <a lay-event="open_layer" data-w="{{ item.w || '1200px' }}"
               data-h="{{ item.h || '800px' }}"
               data-title="{{ item.title || item.name }}" data-url="{{ item.url }}"
               class="layui-btn {{ item.class_name }} layui-btn-xs"><i
                    class="layui-icon {{ item.icon || '' }}"></i>{{ item.name }}</a>
            {{# if(index>3){  }}
            <br/>
            {{# } }}
            {{#  }); }}

        </p>
        {{#  }; }}
        {{# if(d.btn_posts){ }}
        <p>
            {{#  layui.each(d.btn_posts, function(index, item){ }}
            <a lay-event="open_post" data-w="{{ item.w || '1200px' }}"
               data-h="{{ item.h || '800px' }}"
               data-title="{{ item.title || item.name }}" data-post_url="{{ item.post_url }}"
               class="layui-btn {{ item.class_name }} layui-btn-xs"><i
                    class="layui-icon {{ item.icon || '' }}"></i>{{ item.name }}</a>
            {{# if(index>3){  }}
            <br/>
            {{# } }}
            {{#  }); }}

        </p>
        {{#  }; }}
        {{# if(!d.no_edit_btn){  }}
        <a class="layui-btn layui-btn layui-btn-xs" lay-event="show_invigilate_users" data-w="90%" data-h="90%">进入监控</a>
        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="delayed">延时</a>
        {{# } }}
    </script>
    <script type="text/html" id="tpl-invigilate-options">
        {{# if(d.btns){ }}
        <p>
            {{#  layui.each(d.btns, function(index, item){ }}

            <a href=" " target="{{ item.target || '_self' }}"
               class="layui-btn {{ item.class_name }} layui-btn-xs"><i
                    class="layui-icon {{ item.icon || '' }}"></i>{{ item.name }}</a>
            {{# if(index>3){  }}
            <br/>
            {{# } }}
            {{#  }); }}
        </p>
        {{#  }; }}
        {{# if(d.btn_open){ }}
        <p>
            {{#  layui.each(d.btn_open, function(index, item){ }}
            <a lay-event="open_layer" data-w="{{ item.w || '1200px' }}"
               data-h="{{ item.h || '800px' }}"
               data-title="{{ item.title || item.name }}" data-url="{{ item.url }}"
               class="layui-btn {{ item.class_name }} layui-btn-xs"><i
                    class="layui-icon {{ item.icon || '' }}"></i>{{ item.name }}</a>
            {{# if(index>3){  }}
            <br/>
            {{# } }}
            {{#  }); }}

        </p>
        {{#  }; }}
        {{# if(d.btn_posts){ }}
        <p>
            {{#  layui.each(d.btn_posts, function(index, item){ }}
            <a lay-event="open_post" data-w="{{ item.w || '1200px' }}"
               data-h="{{ item.h || '800px' }}"
               data-title="{{ item.title || item.name }}" data-post_url="{{ item.post_url }}"
               class="layui-btn {{ item.class_name }} layui-btn-xs"><i
                    class="layui-icon {{ item.icon || '' }}"></i>{{ item.name }}</a>
            {{# if(index>3){  }}
            <br/>
            {{# } }}
            {{#  }); }}

        </p>
        {{#  }; }}
        {{# if(!d.no_edit_btn){  }}
        <a class="layui-btn layui-btn layui-btn-xs" lay-event="exam_option" data-value="2">作废</a>
        <a class="layui-btn layui-btn layui-btn-xs" lay-event="exam_option" data-value="6">强退</a>
        <a class="layui-btn layui-btn layui-btn-xs" lay-event="exam_option" data-value="7">交卷</a>
        {{# } }}
    </script>
    <script type="text/html" id="tpl-exam-marking">
        {{# if(d.btns){ }}
        <p>
            {{#  layui.each(d.btns, function(index, item){ }}

            <a href=" " target="{{ item.target || '_self' }}"
               class="layui-btn {{ item.class_name }} layui-btn-xs"><i
                    class="layui-icon {{ item.icon || '' }}"></i>{{ item.name }}</a>
            {{# if(index>3){  }}
            <br/>
            {{# } }}
            {{#  }); }}
        </p>
        {{#  }; }}
        {{# if(d.btn_open){ }}
        <p>
            {{#  layui.each(d.btn_open, function(index, item){ }}
            <a lay-event="open_layer" data-w="{{ item.w || '1200px' }}"
               data-h="{{ item.h || '800px' }}"
               data-title="{{ item.title || item.name }}" data-url="{{ item.url }}"
               class="layui-btn {{ item.class_name }} layui-btn-xs"><i
                    class="layui-icon {{ item.icon || '' }}"></i>{{ item.name }}</a>
            {{# if(index>3){  }}
            <br/>
            {{# } }}
            {{#  }); }}

        </p>
        {{#  }; }}
        {{# if(d.btn_posts){ }}
        <p>
            {{#  layui.each(d.btn_posts, function(index, item){ }}
            <a lay-event="open_post" data-w="{{ item.w || '1200px' }}"
               data-h="{{ item.h || '800px' }}"
               data-title="{{ item.title || item.name }}" data-post_url="{{ item.post_url }}"
               class="layui-btn {{ item.class_name }} layui-btn-xs"><i
                    class="layui-icon {{ item.icon || '' }}"></i>{{ item.name }}</a>
            {{# if(index>3){  }}
            <br/>
            {{# } }}
            {{#  }); }}

        </p>
        {{#  }; }}
        {{# if(!d.no_edit_btn){  }}
        <a class="layui-btn layui-btn-normal layui-btn" lay-event="join_marking">阅卷</a>
        {{# } }}
    </script>
    <script type="text/html" id="tpl-exam-option">
        {{# if(d.btns){ }}
        <p>
            {{#  layui.each(d.btns, function(index, item){ }}

            <a href=" " target="{{ item.target || '_self' }}"
               class="layui-btn {{ item.class_name }} layui-btn-xs"><i
                    class="layui-icon {{ item.icon || '' }}"></i>{{ item.name }}</a>
            {{# if(index>3){  }}
            <br/>
            {{# } }}
            {{#  }); }}
        </p>
        {{#  }; }}
        {{# if(d.btn_open){ }}
        <p>
            {{#  layui.each(d.btn_open, function(index, item){ }}
            <a lay-event="open_layer" data-w="{{ item.w || '1200px' }}"
               data-h="{{ item.h || '800px' }}"
               data-title="{{ item.title || item.name }}" data-url="{{ item.url }}"
               class="layui-btn {{ item.class_name }} layui-btn-xs"><i
                    class="layui-icon {{ item.icon || '' }}"></i>{{ item.name }}</a>
            {{# if(index>3){  }}
            <br/>
            {{# } }}
            {{#  }); }}

        </p>
        {{#  }; }}
        {{# if(d.btn_posts){ }}
        <p>
            {{#  layui.each(d.btn_posts, function(index, item){ }}
            <a lay-event="open_post" data-w="{{ item.w || '1200px' }}"
               data-h="{{ item.h || '800px' }}"
               data-title="{{ item.title || item.name }}" data-post_url="{{ item.post_url }}"
               class="layui-btn {{ item.class_name }} layui-btn-xs"><i
                    class="layui-icon {{ item.icon || '' }}"></i>{{ item.name }}</a>
            {{# if(index>3){  }}
            <br/>
            {{# } }}
            {{#  }); }}

        </p>
        {{#  }; }}
        {{# if(!d.no_edit_btn){  }}
        <a class="layui-btn layui-btn-xs" lay-event="copy">复制</a>
        <a class="layui-btn layui-btn-normal  layui-btn-xs"  data-w="60%" data-h="95%" lay-event="edit">编辑</a>
        <a class="layui-btn layui-btn-danger  layui-btn-xs" lay-event="del">删除</a>
        {{# } }}
    </script>
@endverbatim
