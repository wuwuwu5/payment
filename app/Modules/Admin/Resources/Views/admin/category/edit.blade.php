@extends('admin::layout.app')
@section('content')
    <div class="layui-form " id="layuiadmin-form" style="background-color: #fff">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="layui-form-item">
            <label for="" class="layui-form-label"><strong class="item-required">*</strong>父级</label>
            <div class="layui-input-block">
                <div class="col-lg-4">
                    <div id="parent" style="width:100%" title="父级"></div>
                </div>
            </div>
        </div>
        @php
            $category_group = $category->categoryGroup;
        @endphp
        <input type="hidden" name="category_group_id" value="{{$category_group->id}}">
        <input type="hidden" name="type" value="{{$category_group->name}}">
        {{   Form::LayText([
                'name'=>'nickname',
                'title'=>'名称',
                'tips'=>'',
                'rq'=>'rq',
                'value'=>$category->nickname,
             ])
        }}

        {{   Form::LayText([
                'name'=>'name',
                'title'=>'别称',
                'tips'=>'',
                'value'=>$category->name,
                'rq'=>'rq',
             ])
        }}

        @if($category_group->name == \App\Modules\Admin\Models\CategoryGroup::MENU)
            {{   Form::LayText([
                    'name'=>'value[router]',
                    'title'=>'路由',
                    'tips'=>'',
                    'value'=>data_get($category, 'value.router')
                 ])
            }}

            {{   Form::LayText([
                    'name'=>'value[param]',
                    'title'=>'附带参数',
                    'tips'=>'?limit=10',
                    'value'=>data_get($category, 'value.params')
                 ])
            }}

            {{   Form::LayIcon([
                     'name'=>'image',
                     'title'=>'图标',
                     'value'=>$category->image
                ])
            }}

        @endif

        @if($category_group->name == \App\Modules\Admin\Models\CategoryGroup::SLIDES)
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


        @endif
        {{   Form::LaySubmit()}}
    </div>
@endsection
@push('scripts')
    <script>
        var firstData = {id: 0, pid: 0, name: '顶级分类', category_group_id:{{$category_group->id}}, value: 0};

        var datas = @json(treeCategories($category_group->name, true));

        datas.unshift(firstData);

        layui.use(['index', 'renderXmSelect', 'custorm', 'request'], function () {
            var renderXmSelect = layui.renderXmSelect;
            var request = layui.request;
            var pid = {{$category->pid}};
            // 父级
            renderXmSelect.render('#parent', '选择父级', 'pid', {
                initValue: [pid],
                radio: true
            }, datas);

                @php
                    $column_id = data_get($category, 'value.column_id', null);
                    $column2_id = data_get($category, 'value.column2_id', null);
                @endphp

                @if($category_group->name == \App\Modules\Admin\Models\CategoryGroup::SLIDES)
            var initValue = @json( empty($column_id) ? [] : [$column_id]);
            renderXmSelect.render('#column_id', '文章主栏目', 'value[column_id]', {
                radio: true,
                initValue: initValue,
                on: function (data) {
                    var arr = data.arr;
                    if (arr.length > 0) {
                        request.get('/admin/articles/' + arr[0]['id'] + '/children', {}, function (res) {
                            renderXmSelect.render('#column2_id', '文章副栏目', 'value[column2_id]', {radio: true}, res.data);
                        })
                    } else {
                        renderXmSelect.render('#column2_id', '文章副栏目', 'value[column2_id]', {radio: true}, []);
                    }
                }
            }, @json(treeCategories('front_column', true,1)));

            @if(empty($column2_id))
            renderXmSelect.render('#column2_id', '文章副栏目', 'value[column2_id]', {radio: true}, []);
            @else
            @if (!empty($column_id))
            request.get('/admin/articles/' + '{{$column_id}}' + '/children', {}, function (res) {
                var initValue2 = @json( empty($column2_id) ? [] : [$column2_id]);
                renderXmSelect.render('#column2_id', '文章副栏目', 'value[column2_id]', {
                    radio: true,
                    initValue: initValue2
                }, res.data);
            });
            @else
            renderXmSelect.render('#column2_id', '文章副栏目', 'value[column2_id]', {radio: true}, []);
            @endif
            @endif
            @endif
        });
    </script>

@endpush
