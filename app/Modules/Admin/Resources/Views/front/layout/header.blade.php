<div class="header">
    <div class="container clearfix">
        <h1 class="logo fl">
      <span class="h-navi modal-open" data-modal-id="modal_menu">
        菜单 <i class="ico-navi"></i>
      </span>
            <a href="index.html" class="a-glass"> <i class="logo-icon thumb"></i> <span>优设网 - UISDC</span> </a>
        </h1>
        <div class="site-menu fl">
            <ul id="primary_menu" class="menu-primary">
                <li id="menu-item-31935" class="item-0 current-menu-item">
                    <a href="index.html" class="link-0"><span>首页</span></a>
                </li>
                <li id="menu-item-250995" class="item-0 ">
                    @foreach(getFrontColumns() as $key => $item)
                        <a href="/articles/{{$item['mark_name']}}" class="link-0"
                           data-component="dropdown"
                           data-target="dropdown_{{md5($item['id'])}}"><span>{{$item['name']}}</span>
                        </a>
                    @endforeach
                </li>
            </ul>
        </div>
        <div class="header-login-search fr">
            <div class="header-search fl"><a href="https://www.uisdc.com?s=" data-component="dropdown-click"
                                             data-target="search_dropdown"> <i class="icon-search"></i> 搜索 </a></div>
            <div class="login-panel fr">
                <ul>
                    <li id="login"><a href="#" class="avatar_a modal-open" data-modal-id="modal_login"> <i
                                class="avatar thumb"></i> </a></li>
                </ul>
            </div>
        </div>
    </div>
</div>


@foreach(getFrontColumns() as $key => $item)
    @if(isset($item['children']) && count($item['children']) > 0)
        <div class="part-dropdown" id="dropdown_{{md5($item['id'])}}">
            <div class="container">
                <div class="dropdown-content">
                    <div class="main">
                        <section class="dropdown-section dropdown-allposts">
                            <div class="section-content">
                                @php
                                    $sum = collect($item['children'])->sum('column2_articles_count');
                                    $sum2 = collect($item['children'])->sum('column_articles_count');
                                    $sum = $sum + $sum2 + $item['column_articles_count'];
                                @endphp
                                <div class="item">
                                    <a href="{{route('articles.column.show', ['type' => 'all'])}}" target="_blank">
                                        <i class="icon-allposts"></i>
                                        <h3>全部文章</h3>
                                        <h5>{{$sum}}篇</h5>
                                    </a>
                                </div>
                                <div class="item">
                                    <a href="{{route('articles.column.show', ['type' => $item['mark_name']])}}"
                                       target="_blank">
                                        <i class="icon-allposts"></i>
                                        <h3>{{$item['name']}}</h3>
                                        <h5>{{$item['column_articles_count']}}篇</h5>
                                    </a>
                                </div>
                                @foreach($item['children'] as $k => $val)
                                    <div class="item">
                                        <a href="{{route('articles.column.show', ['type' => $item['mark_name']])}}" target="_blank">
                                            @if(!empty($val['image']))
                                                <i class="{{ $val['image'] }}"></i>
                                            @endif
                                            <h3>{{$val['name']}}</h3>
                                            <h5>{{$val['column2_articles_count']}}篇</h5>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach

<div class="modal-menu" id="modal_menu">
    <div class="modal-content"></div>
</div>
