layui.define(['table', 'form', 'request', 'layerOpen', 'laypage', 'layer', 'laydate'], function (exports) {
    var $ = layui.$;
    var table = layui.table;
    var form = layui.form;
    var req = layui.request;
    var element = layui.element;
    var laydate = layui.laydate;
    var layerOpen = layui.layerOpen;
    var laypage = layui.laypage;
    var layer = layui.layer
    var listTable = {
        render: listTableRender,
        search: listSearch,
        handle: handleListenTable,
        top: handelTopListenTable,
        diy_list: diyList,

    };
    var data_url = '';

    function diyList(objApp, url, pageconfig, handleFun, successCallback, errorCallback) {
        layer.load(3); //风格1的加载
        pageconfig = pageconfig || {};
        var laypage = layui.laypage;
        var laypageparams = {
            obj_id: 'page',
            limit: 10,
            limits: [1, 10, 30, 50, 70],
            layout: ['count', 'prev', 'page', 'next', 'limit', 'skip'],
        };
        laypageparams = $.extend(laypageparams, pageconfig);
        req.post(url, {limit: laypageparams.limit}, function (data) {
            if (data.total <= 0) {
                return false;
            }
            laypage.render({
                limit: laypageparams.limit,
                elem: laypageparams.obj_id,
                count: data.total,
                limits: laypageparams.limits,
                layout: laypageparams.layout,
                theme: "#62a8ea",
                jump: function (obj, first) {
                    if (typeof (handleFun) != "function" && typeof (successCallback) == "function") {
                        return successCallback(obj, first);
                    }
                    if (first) {
                        if (typeof (handleFun) == "function") {
                            return handleFun(data);
                        } else {
                            return $(".tuku-list").empty().append(data.contents);
                        }

                    }
                    layer.load(3); //风格1的加载
                    $.ajax({
                        url: url,
                        dataType: 'json',
                        type: 'post',
                        data: {
                            offset: obj.curr,
                            limit: obj.limit,
                            _token: $('[name="csrf-token"]').attr('content')
                        },
                        success: function (tdata) {
                            if (tdata.total <= 0) {
                                return false;
                            }

                            if (typeof (handleFun) == "function") {

                                return handleFun(tdata);
                            } else {
                                console.log(tdata.contents);
                                $(objApp).empty().append(tdata.contents);
                                return '';
                            }

                        },
                        complete: function () {
                            layer.closeAll('loading');
                        }
                    })
                }
            });
        }, '', function () {
            layer.closeAll('loading');
        })


    }


    /**
     * 列表表格渲染
     * @param url
     * @param cols
     * @param config
     */
    function listTableRender(url, cols, config, extendFun) {
        data_url = url;
        config = config || {};
        var default_config = {
            elem: '#LAY-list-table',
            page: true,
            toolbar: true,
            method: 'get',
            limit: 15,
            limits: [
                15, 20, 30, 40, 50, 70, 100, 120, 150, 200
            ],
            text: {
                none: '暂无相关数据' //默认：无数据。注：该属性为 layui 2.2.5 开始新增
            },
            cellMinWidth: 120,
            url: url, //模拟接口
            cols: cols,
            response: {
                statusName: 'code' //规定数据状态的字段名称，默认：code
                , statusCode: 200 //规定成功的状态码，默认：0
                , msgName: 'msg' //规定状态信息的字段名称，默认：msg
                , countName: 'count' //规定数据总数的字段名称，默认：count
                , dataName: 'data' //规定数据列表的字段名称，默认：data
            }
        };
        // 合并配置对象
        var render_config = $.extend({}, default_config, config);

        table.render(render_config);
        //监听表
        handleListenTable(extendFun);
        //顶部操作
        handelTopListenTable();
    }

    // 下划线转换驼峰
    function toCamel(str) {
        if (str.indexOf('_') <= 0) {
            return str.toLowerCase().replace(/( |^)[a-z]/g, (L) => L.toUpperCase());
        }

        return str.replace(/([^_])(?:_+([^_]))/g, function ($0, $1, $2) {
            return $1 + $2.toUpperCase();
        });
    }


    /**
     * 监听编辑
     */
    function handleListenTable(extendFun, callFun, elem = null) {
        if (elem == null) {
            elem = 'tool(LAY-list-table)';
        }
        //监听表操作
        table.on(elem, function (obj) {
            var data = obj.data;  //获得当前行数据
            //var del_url = listConfig.restful ? listConfig.index_url + '/' + data.id : listConfig.del_url;

            var w = ($(this).data('w') == null || $(this).data('w') == undefined) ? '90%' : $(this).data('w');
            var h = ($(this).data('h') == null || $(this).data('h') == undefined) ? '90%' : $(this).data('h');

            switch (obj.event) {
                case 'edit':
                    listTableEditEvent(obj, data, extendFun, callFun, w, h);
                    break;
                case 'del':
                    listTableDeLEvent(obj, data, extendFun, callFun);
                    break;
                case 'reset_password':
                    listTableResetPasswordEvent(obj, data, extendFun, callFun);
                    break;
                case 'show_img':
                    listTableShowImgEvent(obj, $(this), data, extendFun, callFun);
                    break;
                case 'published':
                    listTablePublishedEvent(obj, $(this), data, extendFun, callFun);
                    break;
                case 'cancel_published':
                    listTableCancelPublishedEvent(obj, $(this), data, extendFun, callFun);
                    break;
                case 'commend':
                    listTableCommendEvent(obj, $(this), data, extendFun, callFun);
                    break;
                case 'cancel_commend':
                    listTableCancelCommendEvent(obj, $(this), data, extendFun, callFun);
                    break;
            }
            //附加监听表
            if (typeof (extendFun) == "function") {
                return extendFun(obj, $(this));
            }
        });

        //监听单元格编辑
        table.on('edit(LAY-list-table)', function (obj) {
            var value = obj.value, data = obj.data, field = obj.field; //得到字段
            // 要修改的数据
            var fields = {};
            fields[field] = value;
            fields['_method'] = 'patch';

            // 更新
            req.post(data.update_url + '/patch', fields, function (res) {
                layer.msg(res.msg);
                table.reload('LAY-list-table');
                //回调
                callFun && callFun(res)
            })
        });


    }

    /**
     * 顶部删除
     * @returns {*}
     */
    function topDel(callFun) {
        var checkStatus = table.checkStatus('LAY-list-table'),
            checkData = checkStatus.data; //得到选中的数据

        if (checkData.length === 0) {
            return layer.msg('请选择数据');
        }

        layer.confirm('确定删除吗？', function (index) {

            //获得id
            id = new Array();
            for (i in checkData) {
                id.push(checkData[i]['id']);
            }
            var del_url = listConfig.restful ? listConfig.index_url + '/' + id.join(',') : listConfig.del_url;

            field = {
                _method: 'DELETE',
                ids: id.join(','),
                table: listConfig.table_name,
                type_id: 'id',
                handle_str: listConfig.page_name
            };
            req.post(del_url, field, function (res) {
                layer.msg(res.msg);
                if (res.code == 200) {
                    table.reload('LAY-list-table');
                    layer.close(index); //关闭弹层
                    callFun && callFun(res)
                }
            });


        });
    }

    //顶部审批
    function doCheck(status, callFun) {
        var checkStatus = table.checkStatus('LAY-list-table'),
            checkData = checkStatus.data; //得到选中的数据

        if (checkData.length === 0) {
            return layer.msg('请选择数据');
        }

        layer.confirm('确定批量操作吗？', function (index) {

            //获得id
            id = new Array();
            for (i in checkData) {
                id.push(checkData[i]['id']);
            }

            var del_url = listConfig.restful ? listConfig.index_url + '/' + id.join(',') : listConfig.del_url;


            //ajax操作
            field = {
                _method: 'PATCH',
                ids: id.join(','),
                table: listConfig.table_name,
                type_id: 'id',
                status: status,
                handle_str: listConfig.page_name
            };
            req.post(del_url, field, function (res) {
                layer.msg(res.msg);
                if (res.code == 200) {
                    table.reload('LAY-list-table');
                    layer.close(index); //关闭弹层
                    callFun && callFun(res)
                }
            });

        });


    }

    function doHandel(callFun) {
        var checkStatus = table.checkStatus('LAY-list-table'),
            checkData = checkStatus.data; //得到选中的数据

        if (checkData.length === 0) {
            return layer.msg('请选择数据');
        }
        var field = $(this).data('field');
        var value = $(this).data('value');
        console.log($(this).data());
        layer.confirm('确定批量操作吗？', function (index) {

            //获得id
            id = new Array();
            for (i in checkData) {
                id.push(checkData[i]['id']);
            }


            //ajax操作
            var data = {
                field: field,
                field_value: value,
                ids: id.join(',')
            };
            req.post(listConfig.edit_field_url, data, function (res) {
                layer.msg(res.msg);
                if (res.code == 200) {
                    table.reload('LAY-list-table');
                    layer.close(index); //关闭弹层
                    callFun && callFun(res)
                }
            })

        });


    }

    /**
     * 顶部添加
     */
    function topAdd(callFun) {
        var w = $(this).data('w') ? $(this).data('w') : '90%';
        var h = $(this).data('h') ? $(this).data('h') : '90%';

        layerOpen.edit(listConfig.create_url, listConfig.stroe_url, {
            w: listConfig.open_width,
            h: listConfig.open_height,
            title: '添加' + listConfig.page_name,
        }, callFun);

    }

    function select_add(callFun) {
        let select_id = $(this).data('select');
        $('#' + select_id).val();
        let pid = $("input[name='pid']").val();
        let create_url = $('#' + select_id).val();
        if (create_url === "" || create_url === null) {
            return
        }
        create_url += '&pid=' + pid

        let stroe_url = listConfig.restful ? listConfig.index_url : listConfig.stroe_url;

        layerOpen.edit(create_url, stroe_url, {
            w: listConfig.open_width,
            h: listConfig.open_height,
            title: '添加' + listConfig.page_name,
        }, callFun);
    }


    /**
     * 顶部自定义添加
     */
    function topCreate(callFun) {
        var url = $(this).data('url');
        var post_url = $(this).data('post_url');
        var w = $(this).data('w') ? $(this).data('w') : '90%';
        var h = $(this).data('h') ? $(this).data('h') : '90%';

        var title = $(this).data('title');

        if ($(this).data('show') == 1) {
            layerOpen.show(url, {
                h: h,
                w: w,
                title: title
            }, callFun)
        } else {
            layerOpen.edit(url, post_url, {
                h: h,
                w: w,
                title: title
            }, callFun);
        }
    }


    function handelTopListenTable(callFun) {

        var active = {
            all_del: topDel,
            add: topAdd,
            diy_add: topCreate,
            select_add: select_add,
            handel: doHandel
        };

        $('.layui-btn.wkcms').on('click', function () {
            var type = $(this).data('type');
            active[type] ? active[type].call(this, callFun) : '';
        });

        table.on('toolbar(LAY-list-table)', function (obj) {
            //var checkStatus = table.checkStatus(obj.config.id);
            switch (obj.event) {
                case 'delete':
                    //layer.msg('全部删除');
                    topDel();
                    break;
                case 'check_pass':
                    doCheck(1);
                    break;
                case 'check_unpass':
                    doCheck(0);
                    break;
            }
            ;
        });
    }

    /**
     * 列表搜索
     */
    function listSearch() {
        form.on('submit(LAY-list-search)', function (data) {
            var field = data.field;

            for (let key in field) {
                if (field[key] === '') {
                    delete field[key]
                }
            }
            var loading = layer.load(1);
            var tmpUrl = data_url; // 必须要有, 不能删除, 为了解决url参数不断拼接的问题!
            var params = Object.keys(field).map(function (key) {
                return encodeURIComponent(key) + "=" + encodeURIComponent(field[key]);
            }).join("&");
            tmpUrl += '?' + params;
            //执行重载
            table.reload('LAY-list-table', {
                url: tmpUrl,
                page: {
                    curr: 1 //重新从第 1 页开始
                },
                done: function (res, curr, count) {
                    layer.close(loading);
                    for (var k in field) {
                        delete this.where[k];
                    }
                }
            });
        });
    }

    //监听列表其他组件事件,开关设置
    form.on('switch(table-checked)', function (obj) {
        var field = $(this).data('field');
        var value = obj.elem.checked ? 0 : 1;
        var id = $(this).data('id');
        var url = $(this).data('url');

        // 文件数据
        var data = {};

        // 赋值
        data[field] = value;
        data['_method'] = 'patch';

        // 更新
        req.post(url, data, function (res) {
            layer.msg(res.msg);
        });
    });


    // 列表编辑事件
    function listTableEditEvent(obj, data, extendFun, callFun, w, h) {
        layerOpen.edit(data.edit_url, data.update_url, {
            w: ($(this).data('w') == null || $(this).data('w') == undefined) ? '90%' : $(this).data('w'),
            h: ($(this).data('h') == null || $(this).data('h') == undefined) ? '90%' : $(this).data('h'),
            title: '编辑' + listConfig.page_name,
        }, callFun);
    }

    // 列表删除事件
    function listTableDeLEvent(obj, data, extendFun, callFun) {
        console.log(data);
        var del_url = data.destory_url;

        layer.msg('确定删除吗?', {
            time: 0,
            btn: ['确定', '取消'],
            yes: function () {
                var index = layer.load(1);
                var field = {
                    ids: data.id,
                    type_id: 'id',
                    handle_str: '删除' + listConfig.page_name,
                    _method: "DELETE"
                };
                req.post(del_url, field, function (res) {
                    layer.msg(res.msg);
                    if (res.code == 200) {
                        table.reload('LAY-list-table');
                    }
                    callFun && callFun(res)
                }, function () {
                    layer.closeAll();
                    layer.msg('操作失败!');
                }, function () {
                    layer.close(index);
                });
            }
        });
    }

    // 列表重置密码
    function listTableResetPasswordEvent(obj, data, extendFun, callFun) {
        var url = data.update_url + '/password'
        layer.msg('确定重置密吗?', {
            time: 0,
            btn: ['确定', '取消'],
            yes: function (index) {
                req.post(url, {'_method': 'patch'}, function (res) {
                    if (res.code == 200) {
                        layer.msg('重置密码成功!')
                        layer.close(index);
                        table.reload('LAY-list-table');
                    }
                    callFun && callFun(res)
                });
            }
        });
    }

    // 列表显示图片
    function listTableShowImgEvent(obj, that, data, extendFun, callFun) {
        var src = that.data('src');
        src = src || that.attr('src');

        layer.photos({
            photos: {
                "title": "查看"
                ,
                "data": [{
                    "src": src
                }]
            },
            shade: 0.01,
            closeBtn: 1,
            anim: 5
        });
    }

    // 发布
    function listTablePublishedEvent(obj, that, data, extendFun, callFun) {
        layer.msg('确定发布?', {
            time: 0,
            btn: ['确定', '取消'],
            yes: function () {
                var index = layer.load(1);
                req.post(data.publish_url, {'_method': 'patch', 'publish': 1}, function (res) {
                    if (res.code == 200) {
                        layer.msg('发布成功!');
                        data.is_published = true;
                        obj.update(data);
                        that.removeAttr('lay-event').attr('lay-event', 'cancel_published');
                        that.empty().append('<i class="layui-icon layui-icon-close-fill"></i>取消发布');
                    }
                    callFun && callFun(res)
                }, function () {
                    layer.closeAll();
                    layer.msg('操作失败!');
                }, function () {
                    layer.close(index);
                });
            }
        });
    }

    // 取消发布
    function listTableCancelPublishedEvent(obj, that, data, extendFun, callFun) {
        layer.msg('确定取消发布?', {
            time: 0,
            btn: ['确定', '取消'],
            yes: function () {
                var index = layer.load(1);
                req.post(data.publish_url, {'_method': 'patch', 'publish': 0}, function (res) {
                    if (res.code == 200) {
                        layer.msg('取消发布成功!');
                        data.is_published = false;
                        obj.update(data);
                        that.removeAttr('lay-event').attr('lay-event', 'published');
                        that.empty().append('<i class="layui-icon layui-icon-upload-circle"></i>发布');
                    }
                    callFun && callFun(res)
                }, function () {
                    layer.closeAll();
                    layer.msg('操作失败!');
                }, function () {
                    layer.close(index);
                });
            }
        });
    }

    // 推荐
    function listTableCommendEvent(obj, that, data, extendFun, callFun) {
        layer.msg('确定推荐?', {
            time: 0,
            btn: ['确定', '取消'],
            yes: function () {
                var index = layer.load(1);
                req.post(data.commend_url, {'_method': 'patch', 'commend': 1}, function (res) {
                    if (res.code == 200) {
                        layer.msg('推荐成功!');
                        data.is_commend = true;
                        obj.update(data);
                        that.removeAttr('lay-event').attr('lay-event', 'cancel_commend');
                        that.empty().append('<i class="layui-icon layui-icon-close-fill"></i>取消推荐');
                    }
                    callFun && callFun(res)
                }, function () {
                    layer.closeAll();
                    layer.msg('操作失败!');
                }, function () {
                    layer.close(index);
                });
            }
        });
    }

    // 取消推荐
    function listTableCancelCommendEvent(obj, that, data, extendFun, callFun) {
        layer.msg('确定取消推荐?', {
            time: 0,
            btn: ['确定', '取消'],
            yes: function () {
                var index = layer.load(1);
                req.post(data.commend_url, {'_method': 'patch', 'commend': 0}, function (res) {
                    if (res.code == 200) {
                        layer.msg('取消推荐成功!');
                        data.is_published = false;
                        obj.update(data);
                        that.removeAttr('lay-event').attr('lay-event', 'commend');
                        that.empty().append('<i class="layui-icon layui-icon-upload-circle"></i>推荐');
                    }
                    callFun && callFun(res)
                }, function () {
                    layer.closeAll();
                    layer.msg('操作失败!');
                }, function () {
                    layer.close(index);
                });
            }
        });
    }

    exports('listTable', listTable);
});
