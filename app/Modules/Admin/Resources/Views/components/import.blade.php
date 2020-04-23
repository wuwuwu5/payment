<div class="layui-btn-group">
    <button class="layui-btn wkcms" data-type="diy_add" data-title="导入表格" data-w="600px" data-h="600px"
            data-url="{{ route('admin.excel.import') }}" data-post_url="{{ admin_route('index','importpost') }}">
        导入表格
    </button>
    <a href="{{  admin_route('index','importtpl')}}" target="_blank" class="layui-btn  layui-btn-green">
        下载导入模板 </a>
</div>
