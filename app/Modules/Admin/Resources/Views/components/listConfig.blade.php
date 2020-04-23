<script>
    var listConfig = {
        table_name: '{{ $table_name }}',
        page_name: '{{ $page_name }}',
        restful:true,
        index_url: "{!! url()->current() !!}", // 删除操作时会自动拼接 数据 ID
        list_url: "{{$list_url}}",
        edit_field_url: "{{$edit_url}}",
        create_url: '{{$create_url}}',
        stroe_url: "{{$store_url}}",
        checked_url: '',
        open_height: '90%', // 弹出编辑和添加高度
        open_width: '90%' // 弹出编辑和添加高度
    };
</script>
@include('admin::components.layuiTpl')
