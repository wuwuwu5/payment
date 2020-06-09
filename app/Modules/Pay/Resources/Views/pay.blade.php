<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>支付</title>
    <link href="{{asset('static/bootstrap-3.3.7/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('static/sweetalert/sweetalert.css')}}" rel="stylesheet">
</head>
<body>
<div class="row" style="padding: 1rem;">
    <div class="col-lg-12 col-md-12">
        <form class="form-horizontal" action="javaScript:">
            <div class="form-group">
                <label for="class" class="col-sm-2 control-label">项目类型</label>
                <div class="col-sm-10">
                    <select class="form-control" id="class" name="project_id">
                        <option value="">请选择项目</option>
                        @foreach($level1 as $key => $name)
                            <option value="{{$key}}">{{$name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="subject" class="col-sm-2 control-label">班型</label>
                <div class="col-sm-10">
                    <select class="form-control" id="subject" name="class_id">
                        <option value="">请选择班型</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="total_price" class="col-sm-2 control-label">输入金额</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="total_price" placeholder="输入金额" name="price">
                </div>
            </div>
            <div class="form-group" style="text-align: right">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary" style="width: 12rem;">提交</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="{{asset('static/bootstrap-3.3.7/js/jquery.min.js')}}"></script>
<script src="{{asset('static/bootstrap-3.3.7/js/bootstrap.min.js')}}"></script>
<script src="{{asset('static/sweetalert/sweetalert.js')}}"></script>

<script>
    var level2 = @json($level2);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(function () {
        var a;

        $('select[name="project_id"]').change(function () {
            var val = $(this).val();
            var str = '<option value="">请选择班型</option>';
            if (!val) {
                $('select[name="class_id"]').html("").append(str);
                return;
            }

            var data = level2[val];


            if (!data) {
                $('select[name="class_id"]').html("").append(str);
                return;
            }

            for (let index in data) {
                str += '<option value="' + index + '">' + data[index] + '</option>'
            }

            $('select[name="class_id"]').html("").append(str);
            return;
        });

        $('button[type="submit"]').click(function () {

            // 项目
            var project_id = $('select[name="project_id"]').val();

            if (!project_id) {
                swal({
                    type: "warning",
                    title: "请选择项目类型!",
                });
                return false;
            }

            // 班型ID
            var class_id = $('select[name="class_id"]').val();
            if (!class_id) {
                swal({
                    type: "warning",
                    title: "请选择班型!",
                });
                return false;
            }

            var price = $('input[name="price"]').val();

            if (!price) {
                swal({
                    type: "warning",
                    title: "请输入金额!",
                });
                return false;
            }

            var reg = new RegExp("^[0-9]+([.]{1}[0-9]+){0,1}$");

            if (!reg.test(price)) {
                swal({
                    type: "warning",
                    title: "金额请输入数字!",
                });
                return false;
            }

            if (price * 100 < 1) {
                swal({
                    type: "warning",
                    title: "金额最小为0.01!",
                });
                return false;
            }

            if (price * 100 > 10000000) {
                swal({
                    type: "warning",
                    title: "金额最大为99999.99!",
                });
                return false;
            }


            $.ajax({
                url: '{{route('pay.store')}}',
                data: {'project_id': project_id, 'class_id': class_id, 'price': price},
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
                        swal("支付成功", "success");

                        setTimeout(function () {
                            window.location.reload();
                        }, 1000);
                    } else {

                    }
                }
            );
        }
    });
</script>
</body>
</html>
