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
                    'name'=>'value[params]',
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
        {{   Form::LaySubmit()}}
    </div>
@endsection
@push('scripts')
    <script>
        var firstData = {id: 0, pid: 0, name: '顶级分类', category_group_id:{{$category_group->id}}, value: 0};

        var datas = @json(treeCategories($category_group->name));

        datas.unshift(firstData);

        layui.use(['index', 'xmSelect', 'custorm'], function () {
            layui.xmSelect.render({
                el: '#parent',
                tips: '选择父级',
                radio: true,
                max: 2,
                height: '300px',
                clickClose: true,
                filterable: true,
                name: 'pid',
                theme: {
                    color: '#1E9FFF',
                },
                tree: {
                    show: true,
                    strict: false,
                    showFolderIcon: true,
                },
                data: datas,
                initValue: [firstData],
            });
        });
    </script>

@endpush