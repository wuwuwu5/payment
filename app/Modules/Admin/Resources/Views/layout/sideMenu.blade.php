<!-- 侧边菜单 -->
<div class="layui-side layui-side-menu">
    <div class="layui-side-scroll">
        <div class="layui-logo">
{{--            <img width="120px" height="60px" src="//bjjackie.oss-cn-beijing.aliyuncs.com/file/1582186486346-38198-1721582185404_.pic.png" alt="">--}}
            <span>
                @if(!empty(cms_config('site')['name']))
                    {{cms_config('site')['name']}}
                    @else
                    @cms('system_name')
                    @endif
            </span>
        </div>
        <ul class="layui-nav layui-nav-tree" lay-shrink="all" id="LAY-system-side-menu" lay-filter="layadmin-system-side-menu">
            @php
                $menu = category('menu');
                $user = admin();
            @endphp

            @foreach($menu as $ik=>$item)

                @if($item['status']!=0)
                        <li data-name="{{ $item['nickname'] }}" class="layui-nav-item ">
                            @if(!empty($item['value']['router']))
                                <a lay-href="{{ $item['value']['router']?nroute($item['value']['router'],isset($item['param'])?$item['param']:[]):'javascript:void(0)' }}"
                                   lay-tips="{{ $item['nickname'] }}" lay-direction="2">
                                    <i class="layui-side-icon {{ $item['image']}}"></i>
                                    <cite>{{ $item['nickname'] }}</cite>
                                </a>
                            @else
                                <a href="javascript:void(0)"
                                   lay-tips="{{ $item['nickname'] }}" lay-direction="2">
                                    <i class="layui-side-icon {{ $item['image']}}"></i>
                                    <cite>{{ $item['nickname'] }}</cite>
                                </a>
                            @endif

                            @if(!empty($item['sub_menus']) && count($item['sub_menus'])>0)
                                <dl class="layui-nav-child">
                                    @foreach($item['sub_menus'] as $sub_v)
{{--                                        @if(show_hide_menu_auth(array_get($sub_v,'value.router')))--}}
                                            @if($sub_v['status'] == 1)
                                                <dd data-name="{{ $sub_v['nickname'] }}">
                                                    @if(userHasMenu($user, $sub_v['name']))
                                                    <a lay-href="{{ nroute(array_get($sub_v,'value.router')).array_get($sub_v,'value.param','') }}">
{{--                                                        <i class="layui-side-icon {{ $sub_v['image'] }}"></i>--}}
                                                        {{ $sub_v['nickname'] }}</a>
                                                    @endif
                                                </dd>
                                            @endif
{{--                                        @endif--}}
                                    @endforeach
                                </dl>
                            @endif
                        </li>
                    @endif

            @endforeach
        </ul>
    </div>
</div>
