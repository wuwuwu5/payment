@extends('admin::layout.app')
@section('content')
    <div class="layui-form " id="layuiadmin-form" style="background-color: #fff">
        {{ csrf_field() }}
        <div class="layui-form-item">
            <label for="" class="layui-form-label"><strong class="item-required">*</strong>父级</label>
            <div class="layui-input-block">
                <div class="col-lg-4">
                    <div id="parent" style="width:100%" title="父级"></div>
                </div>
            </div>
        </div>
        <input type="hidden" name="category_group_id" value="{{$category_group->id}}">
        <input type="hidden" name="type" value="{{$category_group->name}}">
        {{   Form::LayText([
                'name'=>'nickname',
                'title'=>'名称',
                'tips'=>'',
                'rq'=>'rq',
                'value'=>''
             ])
        }}

        {{   Form::LayText([
                'name'=>'name',
                'title'=>'别称',
                'tips'=>'',
                'value'=>'',
                'rq'=>'rq',
             ])
        }}

        @if($category_group->name == \App\Modules\Admin\Models\CategoryGroup::MENU)
            {{   Form::LayText([
                    'name'=>'value[router]',
                    'title'=>'路由',
                    'tips'=>'',
                    'value'=>''
                 ])
            }}

            {{   Form::LayText([
                    'name'=>'value[param]',
                    'title'=>'附带参数',
                    'tips'=>'?limit=10',
                    'value'=>''
                 ])
            }}

            {{   Form::LayIcon([
                     'name'=>'image',
                     'title'=>'图标'
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

        var datas = @json(treeCategories($category_group->name,true));

        datas.unshift(firstData);

        layui.use(['index', 'request', 'custorm', 'renderXmSelect'], function () {
            var request = layui.request;
            var renderXmSelect = layui.renderXmSelect;

            // 父级
            renderXmSelect.render('#parent', '选择父级', 'pid', {
                initValue: [firstData],
                radio: true
            }, datas);

            @if($category_group->name == \App\Modules\Admin\Models\CategoryGroup::SLIDES)

            renderXmSelect.render('#column_id', '文章主栏目', 'value[column_id]', {
                radio: true,
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

            renderXmSelect.render('#column2_id', '文章副栏目', 'value[column2_id]', {radio: true}, []);
            @endif
        });
    </script>

@endpush
