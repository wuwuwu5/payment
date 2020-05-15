<script src="{{asset('wp-content/themes/U/ui/js/jquery.min.js')}}" charset="utf-8"></script>
<script src="{{asset('wp-content/themes/U/ui/js/touchEvent.js')}}" charset="utf-8"></script>
<script src="{{asset('wp-content/themes/U/ui/js/qrcode.js')}}" charset="utf-8"></script>
<script src="{{asset('wp-content/themes/U/ui/js/jquery.qrcode.js')}}" charset="utf-8"></script>
<script src="{{asset('wp-content/themes/U/ui/js/jquery.slide.js')}}" charset="utf-8"></script>
<script src="{{asset('wp-content/themes/U/ui/js/web_v=2.3.8.js')}}" charset="utf-8"></script>
<script src="{{asset('wp-content/themes/U/layer/layer/layer.js')}}" charset="utf-8"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
