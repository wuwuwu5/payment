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
        {{ method_field('PUT') }}

        {{ Form::LayImg([
          'title'=>'封面',
          'name'=>'cover',
          'value'=> $show->cover ?? '',
          'width'=>'500px',
          'height'=>'200px',
          'rq' => '',
          'tips'=> '建议图片长宽比为5:2，建议尺寸为500*200，图片大小不超过2MB '
          ]
          )}}

        <div class="layui-form-item">
            <label for="" class="layui-form-label"><strong class="item-required">*</strong>分类</label>
            <div class="layui-input-block">
                <div class="col-lg-4">
                    <div id="category" style="width:100%" title="分类"></div>
                </div>
            </div>
        </div>

        {{Form::LayText([
           'name'=>'title',
           'title'=>'标题',
           'tips'=>'',
           'rq'=>'rq|length[2,100]',
           'value' => $show->title,
       ])}}

        {{Form::LayText([
           'name'=>'short_title',
           'title'=>'副标题',
           'tips'=>'',
           'rq'=>'length[2,200]',
           'value' => $show->short_title,
       ])}}


        {{Form::LayText([
           'name'=>'keywords',
           'title'=>'关键字',
           'tips'=>'多个关键字使用,分割',
           'value' => implode(',', $show->keywords),
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
                'on_id' => $show->not_post == true?1:0,
                'list'=>[
                     ['id'=>0,'name'=>'禁止评论'],
                     ['id'=>1,'name'=>'允许评论'],
                ]
            ])}}


        {{   Form::LayDate([
                'name'=>'published_at',
                'title'=>'发布时间',
                'tips'=>'',
                'value' => $show->published_at,
             ])
        }}

        {{   Form::LaySubmit()}}
    </div>
@endsection
@push('scripts')
    <script src="{{admin_asset('/tinymce/tinymce.min.js')}}"></script>
    <script>
        layui.use(['index', 'uploader', 'form', 'verify', 'xmSelect', 'custorm', 'alioss', 'request'], function () {
            var xmSelect = layui.xmSelect;
            var alioss = layui.alioss;
            var request = layui.request;
            var form = layui.form;
            var $ = layui.$;
            alioss.img();


            {{   Form::LayTinymceJs(['id'=>'body', 'return'=>'body', 'content' =>$show->add->body??'' ]) }}

            // 渲染xmselect
            function renderXmSelect(el, tips, name, config, data, initValue = null) {
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
                    data: data,
                    initValue: initValue
                };

                default_config = $.extend({}, default_config, config);

                return layui.xmSelect.render(default_config);
            }
            @php
                $category_id = empty($show->category_id) ? [] : [$show->category_id];
                $tags = $show->tags->reduce(function ($carry, $item){
                    $carry[] = $item->tag_id;
                    return $carry;
                },[]);
            @endphp

            // 分类
            renderXmSelect('#category', '选择分类', 'category_id', {radio: true}, @json(treeCategories('article')), @json($category_id));
            // tag
            renderXmSelect('#tag', '选择标签', 'tags', {checkbox: true}, @json(treeCategories('tag')), @json($tags));

            // 文章主栏目
            var column_id = layui.xmSelect.render({
                el: '#column_id',
                tips: '文章主栏目',
                height: '300px',
                clickClose: true,
                filterable: true,
                radio: true,
                name: 'column_id',
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
                data:  @json(treeCategories('front_column', 1)),
                initValue: {{ empty($show->column_id) ? json_encode([]) : json_encode([$show->column_id])  }},
                on: function (data) {
                    var arr = data.arr;
                    if (arr.length > 0) {
                        request.get('/admin/articles/' + arr[0]['id'] + '/children', {}, function (res) {
                            renderXmSelect('#column2_id', '文章副栏目', 'column2_id', {radio: true}, res.data);
                        })
                    } else {
                        renderXmSelect('#column2_id', '文章副栏目', 'column2_id', {radio: true}, []);
                    }
                }
            });
            @if(empty($show->column_id))
            renderXmSelect('#column2_id', '文章副栏目', 'column2_id', {radio: true}, []);
            @else
            request.get('/admin/articles/' + '{{$show->column_id}}' + '/children', {}, function (res) {
                @php
                    $column2_id = empty($show->column2_id) ?[]:[$show->column2_id];
                @endphp
                renderXmSelect('#column2_id', '文章副栏目', 'column2_id', {radio: true}, res.data, @json($column2_id));
            });
            @endif


            form.on('submit', function (obj) {
                obj.field.body = tinymce.get('body').getContent();
            });
        });
    </script>

@endpush
