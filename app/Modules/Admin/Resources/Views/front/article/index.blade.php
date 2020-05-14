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
                    <a href="{{route('articles.column.show', ['type' =>'all', 'order' => 'hot'])}}"
                       class="current title-item" target="_blank" data-component="tab"
                       data-event="hover" data-tab-wrap=".widget-post-tabs .tab-div"
                       data-tab-menus=".widget-post-tabs .tabs-title a"
                       data-tab-target=".widget-post-tabs .post-list"
                       data-tab-action="new_posts" data-tab-type="list-simple" data-ppp="6">
                        最新文章
                    </a>
                    <a href="{{route('articles.column.show', ['type' =>'all', 'order' => 'now'])}}"
                       class="title-item" target="_blank" data-component="tab"
                       data-event="hover" data-tab-wrap=".widget-post-tabs .tab-div"
                       data-tab-menus=".widget-post-tabs .tabs-title a"
                       data-tab-target=".widget-post-tabs .hot-post-list"
                       data-tab-action="hot_posts" data-tab-type="list-simple" data-ppp="6">
                        最热文章
                    </a>
                </div>
                <div class="tabs-content">
                    <div class="tab-div">
                        <ul class="post-list">
                            @foreach(getColumnArticles($current_column['id'] ?? 0, 'now', 5, null, $current_column['level']) as $key=> $article)
                                <li class="list-item-txt">
                                    <h2 class="title">
                                        <a href="{{route('articles.show', ['article' => $article['hash_id']])}}"
                                           target="_blank">
                                            <span class="num">{{$key+1}}</span>
                                            {{$article['title']}}
                                        </a>
                                    </h2>
                                </li>
                            @endforeach
                        </ul>
                        <ul class="hot-post-list hidden">
                            @foreach(getColumnArticles($current_column['id'] ?? 0, 'hot', 5, null, $current_column['level']) as $key=> $article)
                                <li class="list-item-txt">
                                    <h2 class="title">
                                        <a href="{{route('articles.show', ['article' => $article['hash_id']])}}"
                                           target="_blank">
                                            <span class="num">{{$key+1}}</span>
                                            {{$article['title']}}
                                        </a>
                                    </h2>
                                </li>
                            @endforeach
                        </ul>
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
