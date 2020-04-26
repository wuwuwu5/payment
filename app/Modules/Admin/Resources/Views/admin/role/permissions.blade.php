@php
    $permissions = tree($permissions);
@endphp

@forelse($permissions as $first)
    <dl class="cate-box" style="border: 1px dotted #e2e2e2">
        <dt>
            <div class="cate-first">
                <input id="menu{{$first['id']}}" type="checkbox"
                       name="permissions[]"
                       value="{{$first['id']}}"
                       title="{{$first['cn_name']}}"
                       lay-skin="primary" {{$first['own']??''}}
                       lay-filter="permission"
                       @if(isset($role_has_permissions) && !$role_has_permissions->isEmpty() && $role_has_permissions->has($first['id']))
                       checked
                    @endif
                >
            </div>
        </dt>
        @if(isset($first['_child']))
            @foreach($first['_child'] as $second)
                <dd>
                    <div class="cate-second">
                        <input id="menu{{$first['id']}}-{{$second['id']}}"
                               type="checkbox"
                               name="permissions[]"
                               value="{{$second['id']}}"
                               title="{{$second['cn_name']}}"
                               lay-skin="primary" {{$second['own']??''}}
                               lay-filter="permission"
                               @if(isset($role_has_permissions) && !$role_has_permissions->isEmpty() && $role_has_permissions->has($second['id']))
                               checked
                            @endif
                        ></div>
                    @if(isset($second['_child']))
                        <div class="cate-third">
                            @foreach($second['_child'] as $thild)
                                <input type="checkbox"
                                       id="menu{{$first['id']}}-{{$second['id']}}-{{$thild['id']}}"
                                       name="permissions[]" value="{{$thild['id']}}"
                                       title="{{$thild['cn_name']}}"
                                       lay-skin="primary" {{$thild['own']??''}}
                                       lay-filter="permission"
                                       @if(isset($role_has_permissions) && !$role_has_permissions->isEmpty() && $role_has_permissions->has($thild['id']))
                                       checked
                                    @endif
                                >
                            @endforeach
                        </div>
                    @endif
                </dd>
            @endforeach
        @endif
    </dl>
@empty
    <div style="text-align: center;padding:20px 0;">
        无数据
    </div>
@endforelse
