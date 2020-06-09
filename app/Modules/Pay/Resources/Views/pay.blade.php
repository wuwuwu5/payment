<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,viewport-fit=cover">
    <title>进阶教育</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="{{asset('static/weui/weui.css')}}"/>
    <link rel="stylesheet" href="{{asset('static/weui/example.css')}}"/>
</head>
<body ontouchstart>
<div class="weui-toptips weui-toptips_warn js_tooltips">错误提示</div>
<div class="page form_input_status js_show">
    <div class="weui-form" style="padding-top: 1rem;">
        <div class="weui-form__text-area">
            <img src="{{asset('/static/weui/log2.jpg')}}" style="width: 100%;">
            <div class="weui-form__desc" style="margin-top: 1rem;"><h2>在线支付系统</h2></div>
        </div>
        <div class="weui-form__control-area">
            <div class="weui-cells__group weui-cells__group_form">
                <div class="weui-cells weui-cells_form">
                    <div class="weui-cell weui-cell_active">
                        <div class="weui-cell__hd"><label class="weui-label">项目</label></div>
                        <div class="weui-cell__bd" id="showPicker" style="color: rgba(0,0,0,0.5)">请选择项目</div>
                        <input type="hidden" value="" name="project_id">
                    </div>

                    <div class="weui-cell weui-cell_active">
                        <div class="weui-cell__hd"><label class="weui-label">班型</label></div>
                        <div class="weui-cell__bd" id="showClass" style="color: rgba(0,0,0,0.5)">请选择班型</div>
                        <input type="hidden" value="" name="class_id">
                    </div>
                    <div class="weui-cell weui-cell_active">
                        <div class="weui-cell__hd"><label class="weui-label">金额</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" placeholder="请输入金额" value="" name="price"
                                   pattern="[0-9]+([.]{1}[0-9]+){0,1}">
                        </div>
                    </div>
                    <div class="weui-cell weui-cell_active">
                        <div class="weui-cell__hd"><label class="weui-label">手机号</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" placeholder="请输入手机号" value="" name="phone">
                        </div>
                    </div>
                </div>
                <div class="weui-form__opr-area" style="margin-top: 3rem;">
                    <a class="weui-btn weui-btn_primary" href="javascript:" id="showTooltips">支付</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{asset('static/bootstrap-3.3.7/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script src="https://res.wx.qq.com/open/libs/weuijs/1.2.1/weui.min.js"></script>
<script>
    var classes = [];
    var types = @json($level2)

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $('#showPicker').on('click', function () {
        weui.picker(@json($level1), {
            onChange: function (result) {
                classes = [];
            },
            onConfirm: function (result) {
                var project_id = result[0]['value'];
                classes = types[project_id];
                $('input[name="project_id"]').val(project_id);
                $('#showPicker').text(result[0]['label']);
            },
            title: '项目'
        });
    });

    $('#showClass').on('click', function () {
        weui.picker(classes, {
            onChange: function (result) {

            },
            onConfirm: function (result) {
                var class_id = result[0]['value'];
                $('input[name="class_id"]').val(class_id);
                $('#showClass').text(result[0]['label']);
            },
            title: '班型'
        });
    });

    $('input[name="price"]').blur(function () {
        var price = $(this).val();
        var $tooltips = $('.js_tooltips');

        if ($tooltips.css('display') != 'none') return;

        if (!price) {
            $tooltips.text("请输入金额");
            $tooltips.fadeIn(100);
            setTimeout(function () {
                $tooltips.fadeOut(100);
            }, 2000);
            return false;
        }

        var reg = new RegExp("^[0-9]+([.]{1}[0-9]+){0,1}$");

        if (!reg.test(price)) {
            $tooltips.text("金额请输入数字");
            $('input[name="price"]').val('');
            $tooltips.fadeIn(100);
            setTimeout(function () {
                $tooltips.fadeOut(100);
            }, 2000);
            return false;
        }

        if (price * 100 < 1) {
            $tooltips.text("金额最小为0.01");
            $('input[name="price"]').val('');
            $tooltips.fadeIn(100);
            setTimeout(function () {
                $tooltips.fadeOut(100);
            }, 2000);
            return false;
        }

        if (price * 100 > 10000000) {
            $tooltips.text("金额最大为99999.99");
            $('input[name="price"]').val('');
            $tooltips.fadeIn(100);
            setTimeout(function () {
                $tooltips.fadeOut(100);
            }, 2000);
            return false;
        }
    });

    $('input[name="phone"]').blur(function () {
        var phone = $(this).val();
        var $tooltips = $('.js_tooltips');

        if (!phone) {
            $tooltips.text("请输入手机号");
            $tooltips.fadeIn(100);
            setTimeout(function () {
                $tooltips.fadeOut(100);
            }, 2000);
            return false;
        }

        var phoneReg = new RegExp("^1\\d{10}$");

        if (!phoneReg.test(phone)) {
            $tooltips.text("请输入正确的手机号");
            $tooltips.fadeIn(100);
            setTimeout(function () {
                $tooltips.fadeOut(100);
            }, 2000);
            return false;
        }
    });

    $('#showTooltips').on('click', function () {
        if ($(this).hasClass('weui-btn_disabled')) return;

        var $tooltips = $('.js_tooltips');

        if ($tooltips.css('display') != 'none') return;

        // 项目
        var project_id = $('input[name="project_id"]').val();

        if (!project_id) {
            $tooltips.text("请选择项目");
            $tooltips.fadeIn(100);
            setTimeout(function () {
                $tooltips.fadeOut(100);
            }, 2000);
            return false;
        }

        // 班型ID
        var class_id = $('input[name="class_id"]').val();
        if (!class_id) {
            $tooltips.text("请选择班型");
            $tooltips.fadeIn(100);
            setTimeout(function () {
                $tooltips.fadeOut(100);
            }, 2000);
            return false;
        }

        var price = $('input[name="price"]').val();

        if (!price) {
            $tooltips.text("请输入金额");
            $tooltips.fadeIn(100);
            setTimeout(function () {
                $tooltips.fadeOut(100);
            }, 2000);
            return false;
        }

        var reg = new RegExp("^[0-9]+([.]{1}[0-9]+){0,1}$");

        if (!reg.test(price)) {
            $tooltips.text("金额请输入数字");
            $('input[name="price"]').val('');
            $tooltips.fadeIn(100);
            setTimeout(function () {
                $tooltips.fadeOut(100);
            }, 2000);
            return false;
        }

        if (price * 100 < 1) {
            $tooltips.text("金额最小为0.01");
            $('input[name="price"]').val('');
            $tooltips.fadeIn(100);
            setTimeout(function () {
                $tooltips.fadeOut(100);
            }, 2000);
            return false;
        }

        if (price * 100 > 10000000) {
            $tooltips.text("金额最大为99999.99");
            $('input[name="price"]').val('');
            $tooltips.fadeIn(100);
            setTimeout(function () {
                $tooltips.fadeOut(100);
            }, 2000);
            return false;
        }

        var phone = $('input[name="phone"]').val();

        if (!phone) {
            $tooltips.text("请输入手机号");
            $tooltips.fadeIn(100);
            setTimeout(function () {
                $tooltips.fadeOut(100);
            }, 2000);
            return false;
        }

        var phoneReg = new RegExp("^1\\d{10}$");

        if (!phoneReg.test(phone)) {
            $tooltips.text("手机号非法");
            $tooltips.fadeIn(100);
            setTimeout(function () {
                $tooltips.fadeOut(100);
            }, 2000);
            return false;
        }

        $.ajax({
            url: '{{route('pay.store')}}',
            data: {'project_id': project_id, 'class_id': class_id, 'price': price, 'phone': phone},
            type: 'POST',
            dataType: "json",
            success: function (res) {
                if (res.code != 0) {
                    swal({
                        type: "warning",
                        title: res.message
                    });
                    return false;
                }
                a = res.data;
                callpay()
            }
        })
    });

    function callpay() {
        if (typeof WeixinJSBridge == "undefined") {
            if (document.addEventListener) {
                document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
            } else if (document.attachEvent) {
                document.attachEvent('WeixinJSBridgeReady', jsApiCall);
                document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
            }
        } else {
            jsApiCall();
        }
    }

    //调用微信JS api 支付
    function jsApiCall() {
        WeixinJSBridge.invoke(
            'getBrandWCPayRequest', a,
            function (res) {
                WeixinJSBridge.log(res.err_msg);
                if (res.err_msg == 'get_brand_wcpay_request:ok') {
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
                } else {
                }
            }
        );
    }
</script>
</body>
</html>
