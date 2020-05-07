layui.define(['table', 'jquery', 'form', 'xmSelect'], function (exports) {
    "use strict";

    var MOD_NAME = 'myXmSelect';
    var xmSelect = layui.xmSelect;
    var renderXmSelect = function () {
        this.v = '1.1.0';
    };

    /**
     * 初始化表格选择器
     */
    renderXmSelect.prototype.render = function (el, tips, name, config, data) {
        // 默认配置
        var default_config = {
            el: el,
            tips: tips,
            height: '300px',
            clickClose: true,
            filterable: true,
            name: name,
            theme: {
                color: '#1E9FFF',
            },
            layVerify: true,
            layVerType: 'required',
            tree: {
                show: true,
                strict: false,
                showFolderIcon: true,
            },
            data: data
        };

        default_config = $.extend({}, default_config, config);

        return layui.xmSelect.render(default_config);
    };


    //自动完成渲染
    var renderXmSelect = new renderXmSelect();

    exports(MOD_NAME, renderXmSelect);
})
