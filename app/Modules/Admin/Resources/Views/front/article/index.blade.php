@extends('admin::front.layout.app')

@push('styles')
    <style>
        @media (min-width: 768px) {
            .nav-pages .nav li {
                margin: 0 0;
            }
        }
    </style>
@endpush

@section('content')
    <div class="crumbs container hide_sm" style="padding-top: 60px;">
        <ol class="breadcrumb">
            <li><a href="/" title="优设网 &#8211; UISDC">首页</a></li>
            @php
                $type = request()->route()->parameter('type');
            @endphp
            @if($type == 'all')
                <li>
                    <a href="javaScript:">全部文章</a>
                </li>
            @else
                @php
                    $columns = getColumnPath($current_column);
                @endphp
                @foreach($columns as $column)
                    <li>
                        <a href="{{route('articles.column.show' ,['type' => $column['mark_name']])}}">{{$column['name']}}</a>
                    </li>
                @endforeach
            @endif
        </ol>
    </div>

    @if($type != 'all')
        @include("admin::front.article.top_cats", compact('columns'))

        <div class="archive-header">
            <div class="container">
                <h2 class="listH2">
                    <i class="{{$current_column['image']}}" style="font-size: 30px;"></i>
                    {{$current_column->nickname}}
                    <small>已发布文章{{$articles->total()}}篇</small>
                </h2>
            </div>
        </div>
    @endif
    <div class="content container archive-content">
        <div class="main">
            <div class="nav-pages-top">
                <div class="nptshow hide_sm">
                    <div class="kind spark_rm">
                        <div class="item hidden">
                        </div>
                    </div>
                </div>

                <form action="/{{request()->path()}}" method="get" class="nav-pages-top-form">
                    <div>{{$articles->currentPage()}} / {{$articles->lastPage()}}
                        <span class="goto hide_sm">到第
                            <em class="go_em">
                                <input type="text" class="txt" name="page" value="{{$articles->currentPage()}}">
                                <button type="submit">Go</button>
                            </em>
                        </span>页
                    </div>


                    <div class="fy">
                        @if (!$articles->onFirstPage())
                            <span>
                                <a href="{{ $articles->previousPageUrl() }}">
                                    <i class="icon-left"></i>
                                </a>
                            </span>
                        @endif
                        @if ($articles->hasMorePages())
                            <span>
                                <a href="{{$articles->nextPageUrl()}}">
                                    <i class="icon-right"></i>
                                </a>
                            </span>
                        @endif
                    </div>
                </form>
            </div>
            @foreach($articles as $article)
                @include("admin::front.article.item", compact('article'))
            @endforeach
            {{ $articles->links('admin::front.article.paginator') }}
        </div>
        <div class="sidebar" data-component="sidebar-autofixed" data-autofixed=".widget-show">
            <section class="widget widget-post-tabs hide_sm" data-component="tabs" data-action="widget_post_tabs"
                     data-fb="widget_post_tabs">
                <div class="tabs-title">
                    <a href="../archives.html" class="current title-item" target="_blank" data-component="tab"
                       data-event="hover" data-tab-wrap=".widget-post-tabs .tab-div"
                       data-tab-menus=".widget-post-tabs .tabs-title a" data-tab-target=".widget-post-tabs .post-list"
                       data-tab-action="new_posts" data-tab-type="list-simple" data-ppp="6">最热文章</a>
                    <a href="../tag/%E5%A3%B9%E5%91%A8%E9%80%9F%E8%AF%BB.html" class="title-item" target="_blank"
                       data-component="tab" data-event="hover" data-tab-wrap=".widget-post-tabs .tab-div"
                       data-tab-menus=".widget-post-tabs .tabs-title a" data-tab-target=".widget-post-tabs .week-list"
                       data-tab-action="quick_read" data-tab-type="list-simple" data-ppp="6">一周速读</a>
                    <a href="../zt.html" class="title-item" target="_blank" data-component="tab" data-event="hover"
                       data-tab-wrap=".widget-post-tabs .tab-div" data-tab-menus=".widget-post-tabs .tabs-title a"
                       data-tab-target=".widget-post-tabs .zt-list" data-tab-action="widget_zt"
                       data-tab-type="list-simple" data-ppp="6">专题文章</a>
                </div>
                <div class="tabs-content">
                    <div class="tab-div">
                        <ul class="post-list">
                            <li class="list-item-txt">
                                <h2 class="title"><a href="../glow-sans.html" target="_blank"> <span
                                            class="num">1</span> 免费商用字体「未来荧黑」开放下载！5种字宽+9种字重超好用！ </a></h2>
                            </li>
                            <li class="list-item-txt">
                                <h2 class="title"><a href="../2020-ui-design-trends.html" target="_blank"> <span
                                            class="num">2</span> 腾讯干货！深度分析2020 UI设计流行趋势 </a></h2>
                            </li>
                            <li class="list-item-txt">
                                <h2 class="title"><a href="../layout-page.html" target="_blank"> <span
                                            class="num">3</span> 文案信息较多时，该如何编排版面才会好看？ </a></h2>
                            </li>
                            <li class="list-item-txt">
                                <h2 class="title"><a href="../alipay-logo-design.html" target="_blank"> <span
                                            class="num">4</span> 为什么支付宝要换 Logo 颜色？分析下目前 Logo 的主色趋势 </a></h2>
                            </li>
                            <li class="list-item-txt">
                                <h2 class="title"><a href="../jf-open-font.html" target="_blank"> <span
                                            class="num">5</span> 又一款免费可商用的中文字体！Open 粉圆字体火热下载中 </a></h2>
                            </li>
                            <li class="list-item-txt">
                                <h2 class="title"><a href="../animal-friendship-society.html" target="_blank"> <span
                                            class="num">6</span> 最近超火的《动物森友会》，被网友玩出了这么多脑洞设计！ </a></h2>
                            </li>
                        </ul>
                        <ul class="week-list"></ul>
                        <ul class="zt-list"></ul>
                    </div>
                </div>
            </section>
            <div class="sidebar-fixed-start"></div>
            <div class="sidebar-fixed" data-component="autofixed" data-start=".sidebar-fixed-start"
                 data-end=".archive-content" data-top="70"></div>
        </div>
    </div>

    <div class="fixed-right">
        <div class="menus">
            <span class="item hide_sm"> <a
                    href="https://wpa.qq.com/msgrd?v=3&amp;uin=2650232288&amp;site=qq&amp;menu=yes" target="_blank"> <i
                        class="icon-comme"></i> </a> </span>
            <span class="item ewm hide_sm"> <i class="icon-ewm"></i>
      <div class="code-div">
        <div class="ewmDiv">
          <div class="ewm-item ewm-wechat">
            <div class="code-wrap">
              <div class="code"
                   style="background-image:url(https://image.uisdc.com/wp-content/uploads/2019/01/wechat.png);"></div>
            </div>
            <div class="ewm-main">
              <p>每天官微五分钟<br>一年萌新变大神</p>
              <h5> <i class="icon-wechat"></i> 扫码关注 </h5>
            </div>
          </div>
          <div class="ewm-item ewm-weibo">
            <a href="https://weibo.com/uidesign" target="_blank">
              <div class="code-wrap">
                <div class="code"
                     style="background-image:url(https://image.uisdc.com/wp-content/uploads/2019/01/weibo.png);"></div>
              </div>
              <div class="ewm-main">
                <p>每天10篇设计干货<br>300万设计师关注！</p>
                <h5>  <i class="icon-sina"></i> 访问官方微博 </h5>
              </div>
            </a>
          </div>
        </div>
      </div>
    </span>
        </div>
        <div class="gotop">
            <a href="#" class="go_top item"> <i class="icon-top2"></i> </a>
        </div>
    </div>
@stop
