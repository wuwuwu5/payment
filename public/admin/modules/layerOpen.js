layui.define(['layer', 'request', 'table'], function (exports) {
    var $ = layui.$;
    var layer = layui.layer;
    var req = layui.request;
    var table = layui.table;

    var layerOpen = {
        open: openLayer,
        edit: openEditLayer,
        show: openShow,
        paperShow: openPaperShow,
        paperCreateShow: openPaperCreateShow,
        paperEditLayer: openPaperEditLayer,
        openPaperEditShow: openPaperEditShow,
    };

    function is_mobile() {
        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            return true;
        }
        return false;
    }

    function layuiPx(w, h) {
        var config = new Array();
        if (is_mobile()) {
            var base_w = 1200;
            var view_w = $(window).width();
            var view_h = $(window).height();

            config[0] = w;
            config[1] = h;

            if (w.indexOf('px') != -1) {
                console.log('px 计算');
                w = w.replace(/px/g, "");
                h = h.replace(/px/g, "");
                //如果存在px单位则进行计算
                config[0] = (view_w * 90 / 100) + 'px';
                var mh = (h * view_h / 960);

                config[1] = (h * view_h / 960) + 'px';
                if (mh > 100) {
                    config[0] = '100%';
                    config[1] = '100%';
                }

            } else {
                config[0] = '100%';
                config[1] = '100%';
            }

        } else {
            config[0] = w;
            config[1] = h;
        }
        return config;

    }

    function openLayer(config, yesFun, susFuc, cacFun) {
        btn = config.btn || ['确定', '取消'];
        rep_px = layuiPx(config.w, config.h);

        top.layer.open({
            type: config.type,
            title: config.title,
            content: config.url,
            area: [rep_px[0], rep_px[1]],
            btn: btn,
            btnAlign: 'c',
            yes: function (index, layero) {
                if (typeof (yesFun) == "function") {
                    return yesFun(layero, index);
                }
            },
            success: function (index, layero) {
                window.document.body.style = 'overflow:hidden';
                if (typeof (susFuc) == "function") {
                    return susFuc(layero, index);
                }
            },
            cancel: function (index, layero) {
                if (typeof (cacFun) == "function") {
                    return cacFun(layero, index);
                }
            },
            end: function () {
                window.document.body.style = 'overflow:auto';
            }
        });
    }

    function openLayerTop(config, yesFun, susFuc, cacFun) {
        btn = config.btn || ['确定', '取消'];
        rep_px = layuiPx(config.w, config.h);

        top.layer.open({
            type: config.type,
            title: config.title,
            content: config.url,
            area: [rep_px[0], rep_px[1]],
            btn: btn,
            btnAlign: 'c',
            yes: function (index, layero) {
                if (typeof (yesFun) == "function") {
                    return yesFun(layero, index);
                }
            },
            success: function (index, layero) {
                window.document.body.style = 'overflow:hidden';
                if (typeof (susFuc) == "function") {
                    return susFuc(layero, index);
                }
            },
            cancel: function (index, layero) {
                if (typeof (cacFun) == "function") {
                    return cacFun(layero, index);
                }
            },
            end: function () {
                window.document.body.style = 'overflow:auto';
            }
        });
    }

    /**
     * 编辑页面监听Iframe 提交
     * @param url
     * @param post_url
     * @param config
     */
    function openEditLayer(url, post_url, config, callFun) {
        var default_config = {
            type: 2,
            btn: ['立即提交', '取消操作'],
            url: url,
            w: config.w,
            h: config.h,
            title: config.title
        }
        var configs = $.extend({}, default_config);
        openLayer(configs, function (layero, index) {

            var iframeWindow = window.parent['layui-layer-iframe' + index],
                submit = layero.find('iframe').contents().find("#LAY-form-submit");

            //监听提交
            iframeWindow.layui.form.on('submit(LAY-form-submit)', function (data) {
                var field = data.field; //获取提交的字段
                req.post(post_url, field, function (res) {
                    top.layer.msg(res.msg);
                    if (res.code == 200) {
                        table.reload('LAY-list-table');
                        top.layer.close(index); //关闭弹层
                    }
                    callFun && callFun(res)
                })

            });

            submit.trigger('click');
        })
    }

    /**
     * 编辑页面监听Iframe 提交
     * @param url
     * @param post_url
     * @param config
     */
    function openPaperEditLayer(url, post_url, config, callFun) {
        var default_config = {
            type: 2,
            btn: ['立即提交', '取消操作'],
            url: url,
            w: '90%',
            // w: config.w,
            h: '90%',
            // h: config.h,
            title: config.title
        }
        var configs = $.extend({}, default_config);
        openLayer(configs, function (layero, index) {
            var iframeWindow = $('#layui-layer-iframe' + index),
                submit = layero.find('iframe').contents().find("#LAY-form-submit");
            //监听提交
            iframeWindow.layui.form.on('submit(LAY-form-submit)', function (data) {
                var field = data.field; //获取提交的字段
                req.post(post_url, field, function (res) {
                    layer.msg(res.msg);
                    if (res.code == 200) {
                        table.reload('LAY-list-table');
                        layer.close(index); //关闭弹层
                    }
                    callFun && callFun(res)
                })

            });

            submit.trigger('click');
        })
    }

    function openShow(url, config, yesFun) {
        var default_config = {
            type: 2,
            btn: ['关闭'],
            url: url,
            w: '90%',
            // w: config.w,
            // h: config.h,
            h: '90%',
            title: config.title
        }
        openLayer(default_config, function (layero, index) {
            layer.close(index); //关闭弹层
        })
    }

    function openPaperEditShow(url, config, yesFun) {
        var default_config = {
            type: 2,
            btn: ['关闭'],
            url: url,
            w: config.w,
            h: config.h,
            title: config.title
        }

        openLayerTop(default_config, function (layero, index) {
            top.layer.close(index); //关闭弹层
        })
    }

    function openPaperShow(url, config, yesFun) {
        var default_config = {
            type: 2,
            btn: ['关闭'],
            url: url,
            w: '90%',
            // w: config.w,
            // h: config.h,
            h: '90%',
            title: config.title
        }
        openLayer(default_config, function (layero, index) {
            table.reload('LAY-list-table');
            layer.close(index); //关闭弹层
        }, null, function (layero, index) {
            table.reload('LAY-list-table');
        })
    }

    function openPaperCreateShow(url, config, yesFun) {
        var default_config = {
            type: 2,
            btn: ['关闭'],
            url: url,
            w: config.w,
            h: config.h,
            title: config.title
        }

        openLayerTop(default_config, function (layero, index) {
            table.reload('LAY-list-table');
            top.layer.close(index); //关闭弹层
        }, null, function (layero, index) {
            table.reload('LAY-list-table');
        })
    }

    exports('layerOpen', layerOpen);
})
