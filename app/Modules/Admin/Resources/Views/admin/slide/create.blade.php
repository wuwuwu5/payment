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
          ]
          )}}



        {{Form::LayText([
           'name'=>'title',
           'title'=>'标题',
           'tips'=>'',
           'rq'=>'rq|length[2,100]'
       ])}}

        {{Form::LayText([
           'name'=>'short_title',
           'title'=>'副标题',
           'tips'=>'',
           'rq'=>'length[2,60]'
       ])}}


        {{Form::LayText([
           'name'=>'keywords',
           'title'=>'关键字',
           'tips'=>'多个关键字使用,分割',
       ])}}

        {{
          Form::LayTinymce([
           'name'=>'body',
           'title'=>'内容',
           'tips'=>'',
           'value'=>  '',
            'rq'=>'rqu',
        ])
       }}

        <div class="layui-form-item">
            <label for="" class="layui-form-label"><strong class="item-required"></strong>文章主栏目</label>
            <div class="layui-input-block">
                <div class="col-lg-4">
                    <div id="column_id" style="width:100%" title="文章主栏目"></div>
                </div>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="" class="layui-form-label"><strong class="item-required"></strong>文章副栏目</label>
            <div class="layui-input-block">
                <div class="col-lg-4">
                    <div id="column2_id" style="width:100%" title="文章副栏目"></div>
                </div>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="" class="layui-form-label"><strong class="item-required"></strong>标签</label>
            <div class="layui-input-block">
                <div class="col-lg-4">
                    <div id="tag" style="width:100%" title="标签"></div>
                </div>
            </div>
        </div>


        {{Form::LayRadio([
                'name'=>'not_post',
                'title'=>'评论选项',
                'tips'=>'not_post',
                'filter'=>'not_post',
                'list'=>[
                     ['id'=>0,'name'=>'禁止评论'],
                     ['id'=>1,'name'=>'允许评论'],
                ]
            ])}}


        {{   Form::LayDate([
                'name'=>'published_at',
                'title'=>'发布时间',
                'tips'=>''
             ])
        }}

        {{   Form::LaySubmit()}}
    </div>
@endsection
@push('scripts')
    <script src="{{admin_asset('/tinymce/tinymce.min.js')}}"></script>
    <script>
        layui.use(['index', 'uploader', 'form', 'verify', 'renderXmSelect', 'custorm', 'alioss', 'request'], function () {
            var renderXmSelect = layui.renderXmSelect;
            var alioss = layui.alioss;
            var request = layui.request;
            var form = layui.form;
            var $ = layui.$;
            alioss.img();


            {{   Form::LayTinymceJs(['id'=>'body', 'return'=>'body', 'content' =>'' ]) }}


            renderXmSelect.render('#category', '分组', 'category_id', {radio: true}, @json(treeCategories('slides')));
        })
    </script>

@endpush
