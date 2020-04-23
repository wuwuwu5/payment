layui.define(['table', 'jquery', 'form', 'xmSelect'], function (exports) {
    "use strict";

    var MOD_NAME = 'myXmSelect';
    var xmSelect = layui.xmSelect;
    var myXmSelect = function () {
        this.v = '1.1.0';
    };

    /**
     * 初始化表格选择器
     */
    myXmSelect.prototype.render = function (opt) {
        var config = {
            el: opt.el,
            tips: opt.tips,
            clickClose: true,
            theme: {
                color: '#1E9FFF',
            },
            height: '300px',
            name: opt.name,
            tree: {
                show: true,
                strict: false,
                expandedKeys: [-2],
            },
            filterable: true,
            data: opt.data,
            autoRow: true,
            on: opt.on
        };

        if (opt.radio === true) {
            config.radio = true;
        } else {
            config.checkbox = true;
        }
        if (opt.clickClose === undefined) {
            config.clickClose = true;
        } else {
            config.clickClose = false;
        }

        return xmSelect.render(config);
    };


    //自动完成渲染
    var myXmSelectc = new myXmSelect();

    exports(MOD_NAME, myXmSelectc);
})
