@extends('admin::layout.app')
@push('styles')
    <style>
        img {
            border: 1px dashed #99a2aa;
        }

        .btn-cover {
            position: absolute;
            bottom: 22px;
            left: 510px;
        }
    </style>
@endpush
@section('content')
    <div class="layui-form " id="layuiadmin-form" style="background-color: #fff">
        @csrf
        {{method_field('PUT')}}
        <div class="layui-form-item">
            <label for="" class="layui-form-label"><strong class="item-required">*</strong>分组</label>
            <div class="layui-input-block">
                <div class="col-lg-4">
                    <div id="category" style="width:100%" title="分组"></div>
                </div>
            </div>
        </div>

        {{ Form::LayImg([
          'title'=>'图片',
          'name'=>'path',
          'value'=>'',
          'width'=>'500px',
          'height'=>'200px',
          'rq' => '',
         'value' => $show->path,
          ]
          )}}


        {{Form::LayText([
           'name'=>'name',
           'title'=>'名称',
           'tips'=>'',
           'rq'=>'rq|length[2,100]',
           'value' => $show->name,
       ])}}

        {{Form::LayText([
           'name'=>'redirect',
           'title'=>'跳转路径',
           'tips'=>'',
           'rq'=>'length[2,200]',
           'value' => $show->redirect,
       ])}}



        {{Form::LayRadio([
                'name'=>'is_published',
                'title'=>'状态',
                'tips'=>'is_published',
                'filter'=>'is_published',
                'on_id' => $show->is_published,
                'list'=>[
                     ['id'=>0,'name'=>'禁用'],
                     ['id'=>1,'name'=>'发布'],
                ]
            ])}}

        {{   Form::LaySubmit()}}
    </div>
@endsection
@push('scripts')
    <script src="{{admin_asset('/tinymce/tinymce.min.js')}}"></script>
    <script>
        layui.use(['index', 'uploader', 'form', 'verify', 'renderXmSelect', 'custorm', 'alioss', 'request'], function () {
            var renderXmSelect = layui.renderXmSelect;
            var alioss = layui.alioss;
            alioss.img();


            renderXmSelect.render('#category', '分组', 'category_id', {radio: true, initValue:['{{$show->category_id}}']}, @json(treeCategories('slides')));
        })
    </script>

@endpush
