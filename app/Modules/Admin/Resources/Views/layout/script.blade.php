<script src="{{admin_asset('/layui/layui.js')}}"></script>
<script>
    {{--var g_upload_url = '{{ route('admin.upload.index') }}';--}}
    var g_icon_url = '{{ route('admin.icon.index') }}';
    var g_upload_token = '{{ route('admin.upload.token') }}';
    var g_upload_files = '{{ route('admin.upload') }}';
    layui.config({
        version: "{{ env('APP_DEBUG')?time():'v1' }}",
        debug: false,
        base: '{{ admin_asset("/") }}/' //静态资源所在路径
    }).extend({
        index: '/lib/index'//主入口模块,
    }).use('index');
</script>
