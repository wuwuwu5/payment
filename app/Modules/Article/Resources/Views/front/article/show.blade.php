@extends('article::front.layout.app')
@section('content')
    <div class="crumbs container hide_sm" style="padding-top: 60px;">
        <ol class="breadcrumb">
            <li><a href="/" title="优设网 &#8211; UISDC">首页</a></li>
            @php
                $columns = getArticleColumns($article->id);
                $current = $columns[count($columns) - 1]??[];
            @endphp
            @foreach($columns as $column)
                <li>
                    <a href="{{route('articles.column.show' ,['type' => $column['name']])}}">{{$column['nickname']}}</a>
                </li>
            @endforeach
            <li>正文</li>
        </ol>
    </div>
   @include("article::front.article.top_cats", compact('columns'))
    <div class="post-header">
        <div class="container">
            <h1 class="post-title">{{$article->title}}</h1>
            <h4 class="post-meta">
                <span class="editor">
                    <a href="" target="_blank">
                        <i class="thumb"
                           style="background-image:url('{{render_cover($article->creator->avatar ?? '', 'avatar')}}')"></i>
                    </a>
                    编辑：
                    <a href="" target="_blank">{{ $article->creator->nickname ?? '' }}</a>
                </span>
                <span class="original_author">
                    <a href="" target="_blank">作者：{{ $article->creator->nickname ?? '' }}</a>
                </span>
                <span class="time"
                      title="{{ $article->published_at }}"> {{ \Carbon\Carbon::parse($article['published_at'])->diffForHumans() }} </span>
{{--                <span class="zan"> 点赞 {{ $article->give_count ?? 0 }} </span>--}}
{{--                <span class="comment">--}}
{{--                    <a href="#post_comment">评论区</a>--}}
{{--                </span>--}}
            </h4>
        </div>
    </div>
    <div class="content container post-content">
        <div class="main">
            <div class="article-main">
                <div class="article">
                    {!! $article->add->body ?? '' !!}

                </div>

{{--                <div class="article-zan-fav">--}}
{{--                    <div class="zan-div">--}}
{{--                    <span class="zan btn btn-orange" data-component="zan" data-pid="{{$article->hash_id}}"--}}
{{--                          data-count="{{$article->give_count}}">--}}
{{--                        <i class="icon-1-like"></i>--}}
{{--                        <span class="txt">点赞</span>--}}
{{--                        <em class="count">{{$article->give_count}}</em>--}}
{{--                        </span>--}}
{{--                    </div>--}}
{{--                    <div class="fav-div">--}}
{{--                <span class="fav btn btn-orange-border"--}}
{{--                      data-component="fav"--}}
{{--                      data-id="{{$article->hash_id}}"--}}
{{--                      data-original-count="{{$article->collection_count}}"--}}
{{--                      data-count="{{$article->collection_count}}"> <i class="icon-1-heart-border"></i>--}}
{{--                    <span class="txt">收藏</span>--}}
{{--                    <em>{{$article->collection_count}}</em>--}}
{{--                </span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="article-info">--}}
{{--                    <p>--}}
{{--                        <a href="text-layout.html" class="btn btn-orange-border copy-link">--}}
{{--                            <i class="icon-link"></i>--}}
{{--                            复制本文链接--}}
{{--                            <input type="text" name="copy"--}}
{{--                                   value="{{route('articles.show', ['article' => $article['hash_id']])}}"--}}
{{--                                   class="copy-content">--}}
{{--                        </a>--}}
{{--                        文章为作者独立观点不代表优设网立场，<span>未经允许不得转载。</span>--}}
{{--                    </p>--}}
{{--                </div>--}}
                <div class="article-tag">
                    <h4>继续阅读与本文标签相同的文章</h4>
                    @include("article::front.article.tag_item", ['article' => $article])
                </div>
            </div>
            <div class="article-paged">
                <div class="previous prev_next">
                    <a href="{{route('articles.column.show', ['type' =>'all'])}}" target="_blank"
                       class="flex paged-item">
                        <div class="paged-thumb">
                            <i class="thumb "
                               style="background-image:url(https://image.uisdc.com/wp-content/uploads/2019/10/uisdc-bg-article-trans.png)">
                            </i>
                        </div>
                        <div class="paged-main">
                            <h5>返回目录</h5>
                            <h3>每天看文章 掌握行业新动向</h3>
                        </div>
                    </a>
                </div>
                @if(!empty($next_article))
                    <div class="next prev_next">
                        <a href="{{route('articles.show', ['article' => $next_article->hash_id])}}" target="_blank"
                           class="flex paged-item">
                            <div class="paged-thumb h-scale">
                                <i class="thumb "
                                   style="background-image:url(https://image.uisdc.com/wp-content/uploads/2020/05/uisdc-banner-20200507-5.jpg)"></i>
                            </div>
                            <div class="paged-main">
                                <h5>下一篇 <i class="icon-right"></i></h5>
                                <h3>{{$next_article->title}}</h3>
                            </div>
                        </a>
                    </div>
                @endif
            </div>
            @php
                $data = getColumnArticles($current['id'] ?? 0, 'rand', 4, $article->id);
            @endphp
            @if(!$data->isEmpty())
                <section class="article-related">
                    <div class="section-title">继续阅读相关文章</div>
                    <div class="section-content">
                        <div class="flex">

                            <div class="wrap wrap-first">
                                <div class="item">
                                    <a href="{{route('articles.show', ['article' => data_get($data, '0.hash_id')])}}"
                                       target="_blank">
                                        <div class="item-thumb h-scale">
                                            <i class="thumb "
                                               style="background-image:url(
                                                   '{{render_cover(data_get($data, '0.cover'))}}'
                                                   )"></i>
                                        </div>
                                        <div class="item-main">
                                            <h2>{{data_get($data, '0.title')}}</h2>
                                            <h5>{{getArticleInfoOnCache(data_get($data, '0.id'), 'view_count')}} 人阅读</h5></div>
                                    </a>
                                </div>
                            </div>

                            @if($data->count() > 1)
                                <div class="wrap wrap-items">
                                    @foreach($data as $k => $v)
                                        @if($k > 0)

                                            <div class="item">
                                                <a href="{{route('articles.show', ['article' => $v['hash_id']])}}"
                                                   target="_blank">
                                                    <div class="item-thumb h-scale">
                                                        <i class="thumb " style="background-image:url(
                                                            '{{render_cover($v['cover'])}}'
                                                            )"></i>
                                                    </div>
                                                    <div class="item-main">
                                                        <h2>{{$v['title']}}</h2>
                                                        <h5>{{getArticleInfoOnCache($v['id'], 'view_count')}}
                                                            人阅读</h5>
                                                    </div>
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </section>
            @endif
{{--            <div class="comment-div" id="post_comment">--}}
{{--                <h3 class="section-title">发表评论--}}
{{--                    <span class="sub">已发布 <i class="clr_orange comment_count">1</i> 条</span>--}}
{{--                </h3>--}}
{{--                <div class="comment-write">--}}
{{--                    <form class="comment-write-form" action="index.html" method="post">--}}
{{--                        <input type="hidden" name="pid" value="370902">--}}
{{--                        <input type="hidden" name="parent" value="0">--}}
{{--                        <div class="form-item">--}}
{{--                            <div class="item-title">--}}
{{--                        <span class="user-avatar"><i class="thumb "--}}
{{--                                                     style="background-image:url(https://image.uisdc.com/wp-content/uploads/2018/06/avatar-uisdc-chat.png)"></i></span>--}}
{{--                            </div>--}}
{{--                            <div class="item-content"><span class="user-name"> <input type="text" name="user-name"--}}
{{--                                                                                      data-placeholder="欢迎来到优设，试试别填名字..."--}}
{{--                                                                                      class="txt txt_user_name"> </span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-item">--}}
{{--                            <div class="item-title"><label for="comment_word">评论</label></div>--}}
{{--                            <div class="item-content">--}}
{{--                        <textarea name="comment" rows="1" id="comment_word" class="comment-word txt lineLen"--}}
{{--                                  data-placeholder="您的评论会经编辑或作者筛选后显示，全站可见，请文明发言。" data-total=800></textarea>--}}
{{--                                <span class="rest"> 还可以输入 <em>800</em> 个字 </span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-item form-yzm hidden">--}}
{{--                            <div class="item-title"><label for="yzm"> 验证码 </label></div>--}}
{{--                            <div class="item-content">--}}
{{--                                <input type="text" name="yzm" id="yzm" class="txt yzm comment-yzm"--}}
{{--                                       data-placeholder="请输入验证码">--}}
{{--                                <img src="" alt="yzm">--}}
{{--                                <input type="hidden" name="prefix" class="yzm_prefix">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="error-box hide form-item">--}}
{{--                            <div class="item-title"> &nbsp;</div>--}}
{{--                            <div class="item-content"></div>--}}
{{--                        </div>--}}
{{--                        <div class="form-item">--}}
{{--                            <div class="item-title"> &nbsp;</div>--}}
{{--                            <div class="item-content">--}}
{{--                                <button type="submit" class="btn btn-orange btn-submit">提交评论</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                    <span class="btn-reply-close"> <i class="icon-close"></i> </span>--}}
{{--                </div>--}}
{{--                <div class="comment-list" id="comment_list" data-paged="1" data-pid="370902"></div>--}}
{{--                <div class="content-loading" data-component="loading">--}}
{{--                    <i class="loading-icon"></i> 载入中....--}}
{{--                </div>--}}
{{--                <div class="comment-more hidden">--}}
{{--                    <span class="btn btn-orange btn-more-comments">加载更多评论</span>--}}
{{--                </div>--}}
{{--                <div class="comment-nomore hidden">--}}
{{--                    没有更多评论了--}}
{{--                </div>--}}
{{--                <div class="comment-footer">--}}
{{--                    <div class="comment-footer-main">--}}
{{--                        <div class="item">--}}
{{--                            <span class="hide_sm">评论就这些咯，让大家也知道你的独特见解</span>--}}
{{--                            <a href="#post_comment" class="btn btn-orange-border">立即评论</a>--}}
{{--                        </div>--}}
{{--                        <div class="item">--}}
{{--                            以上留言仅代表用户个人观点，不代表本站立场--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <i class="ji2-icon" data-bubble="yes"></i>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="post-recommend">--}}
{{--                <div class="recommend-titles">--}}
{{--                    <a href="{{route('articles.column.show', ['type' =>'all', 'order' => 'now'])}}" class="current"--}}
{{--                       target="_blank" data-component="tab" data-event="hover"--}}
{{--                       data-tab-wrap=".recommend-list" data-tab-menus=".post-recommend .recommend-titles a"--}}
{{--                       data-tab-target=".recommend-new" data-tab-action="new_posts" data-tab-type="list-default"--}}
{{--                       data-ppp="5">最新文章</a>--}}
{{--                    <a href="{{route('articles.column.show', ['type' =>'all', 'order' => 'hot'])}}" target="_blank"--}}
{{--                       data-component="tab" data-event="hover"--}}
{{--                       data-tab-wrap=".recommend-list" data-tab-menus=".post-recommend .recommend-titles a"--}}
{{--                       data-tab-target=".recommend-hot" data-tab-action="hot_posts" data-tab-type="list-post"--}}
{{--                       data-ppp="5">最热文章</a>--}}
{{--                </div>--}}
{{--                <div class="recommends">--}}
{{--                    <div class="recommend-list">--}}
{{--                        <ul class="recommend-new">--}}
{{--                            @foreach(getColumnArticles($current['id'] ?? 0, 'now', 5, $article->id) as $article)--}}
{{--                                @include('article::front.article.show_item',  compact('article'))--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                        <ul class="recommend-hot">--}}
{{--                            @foreach(getColumnArticles($current['id'] ?? 0, 'hot', 5, $article->id) as $article)--}}
{{--                                @include('article::front.article.show_item',  compact('article'))--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="article-toolkit" data-component="autofixed" data-start=".post-content" data-end=".post-content"
                 data-top="70">
{{--                <a class="toolkit comment" href="#post_comment">--}}
{{--                    <i class="icon-comm"></i>--}}
{{--                    <em>{{$article->post_count}}</em>--}}
{{--                </a>--}}
{{--                <span class="toolkit fav"--}}
{{--                      data-component="fav"--}}
{{--                      data-id="{{$article->hash_id}}"--}}
{{--                      data-original-count="{{$article->collection_count}}"--}}
{{--                      data-count="{{$article->collection_count}}">--}}
{{--                    <i class="icon-1-heart-border"></i>--}}
{{--                    <span>收藏</span>--}}
{{--                </span>--}}
                <span class="toolkit share">
                    <i class="icon-share"></i>
                    <em>分享</em>
                 <div class="hidden-sm hidden-xs share-div">
                <h3> </h3>
                     <ul class="share_ul">
     <li> </li>
                         <li class="wechat-li">
                             <a href="#" class="share wechat_qr modal-open"
                                data-modal-id="qr"
                                data-url="https://www.uisdc.com/text-layout" target="_blank" title="分享到微信">
                                 <i class="icon-wechat-1"></i>
                             </a>
                         </li>
    <li class="sina-li"><a
            href="http://service.weibo.com/share/share.php?appkey=1934882415&amp;url=https%3A%2F%2Fwww.uisdc.com%2Ftext-layout&amp;title=%E5%A5%BD%E6%96%87%EF%BC%81%E5%88%9B%E6%84%8F%E5%B9%BF%E5%91%8A%E4%B8%AD%E6%96%87%E5%AD%97%E6%98%AF%E5%A6%82%E4%BD%95%E8%BF%90%E7%94%A8%E7%9A%84%EF%BC%9F%E6%9D%A5%E7%9C%8B%E5%B9%B3%E9%9D%A2%E9%AB%98%E6%89%8B%E7%9A%84%E8%B6%85%E5%A4%9A%E6%A1%88%E4%BE%8B%E6%BC%94%E7%A4%BA%EF%BC%81+%E5%8E%9F%E6%96%87%E6%88%B3%E2%86%92&amp;content=utf-8&amp;pic=https%3A%2F%2Fimage.uisdc.com%2Fwp-content%2Fuploads%2F2020%2F05%2Fuisdc-banner-20200507-2.jpg"
            class="share" target="_blank" title="分享到微博"><i class="icon-sina-1"></i></a></li>
    <li class="qq-li"><a
            href="http://connect.qq.com/widget/shareqq/index.html?url=https%3A%2F%2Fwww.uisdc.com%2Ftext-layout&amp;title=%E5%A5%BD%E6%96%87%EF%BC%81%E5%88%9B%E6%84%8F%E5%B9%BF%E5%91%8A%E4%B8%AD%E6%96%87%E5%AD%97%E6%98%AF%E5%A6%82%E4%BD%95%E8%BF%90%E7%94%A8%E7%9A%84%EF%BC%9F%E6%9D%A5%E7%9C%8B%E5%B9%B3%E9%9D%A2%E9%AB%98%E6%89%8B%E7%9A%84%E8%B6%85%E5%A4%9A%E6%A1%88%E4%BE%8B%E6%BC%94%E7%A4%BA%EF%BC%81+%E5%8E%9F%E6%96%87%E6%88%B3%E2%86%92&amp;summary=&amp;site=baidu&amp;pics=https%3A%2F%2Fimage.uisdc.com%2Fwp-content%2Fuploads%2F2020%2F05%2Fuisdc-banner-20200507-2.jpg"
            class="share" target="_blank" title="分享到QQ"><i class="icon-QQ"></i></a></li>
    <li class="qzone-li"><a
            href="https://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=https%3A%2F%2Fwww.uisdc.com%2Ftext-layout&amp;title=%E5%88%9B%E6%84%8F%E5%B9%BF%E5%91%8A%E4%B8%AD%E6%96%87%E5%AD%97%E6%98%AF%E5%A6%82%E4%BD%95%E8%BF%90%E7%94%A8%E7%9A%84%EF%BC%9F%E6%9D%A5%E7%9C%8B%E5%B9%B3%E9%9D%A2%E9%AB%98%E6%89%8B%E7%9A%84%E8%B6%85%E5%A4%9A%E6%A1%88%E4%BE%8B%E6%BC%94%E7%A4%BA%EF%BC%81&amp;desc=%E5%88%9B%E6%84%8F%E5%B9%BF%E5%91%8A%E4%B8%AD%E6%96%87%E5%AD%97%E6%98%AF%E5%A6%82%E4%BD%95%E8%BF%90%E7%94%A8%E7%9A%84%EF%BC%9F%E6%9D%A5%E7%9C%8B%E5%B9%B3%E9%9D%A2%E9%AB%98%E6%89%8B%E7%9A%84%E8%B6%85%E5%A4%9A%E6%A1%88%E4%BE%8B%E6%BC%94%E7%A4%BA%EF%BC%81&amp;summary=%E5%A5%BD%E6%96%87%EF%BC%81%E5%88%9B%E6%84%8F%E5%B9%BF%E5%91%8A%E4%B8%AD%E6%96%87%E5%AD%97%E6%98%AF%E5%A6%82%E4%BD%95%E8%BF%90%E7%94%A8%E7%9A%84%EF%BC%9F%E6%9D%A5%E7%9C%8B%E5%B9%B3%E9%9D%A2%E9%AB%98%E6%89%8B%E7%9A%84%E8%B6%85%E5%A4%9A%E6%A1%88%E4%BE%8B%E6%BC%94%E7%A4%BA%EF%BC%81+%E5%8E%9F%E6%96%87%E6%88%B3%E2%86%92&amp;site=UiiiUiii&amp;pics=https%3A%2F%2Fimage.uisdc.com%2Fwp-content%2Fuploads%2F2020%2F05%2Fuisdc-banner-20200507-2.jpg"
            class="share" target="_blank" title="分享到QQ空间"><i class="icon-qzone"></i></a></li>
    <li class="huaban-li"><a
            href="http://huaban.com/bookmarklet/?url=https%3A%2F%2Fwww.uisdc.com%2Ftext-layout&amp;title=%E5%A5%BD%E6%96%87%EF%BC%81%E5%88%9B%E6%84%8F%E5%B9%BF%E5%91%8A%E4%B8%AD%E6%96%87%E5%AD%97%E6%98%AF%E5%A6%82%E4%BD%95%E8%BF%90%E7%94%A8%E7%9A%84%EF%BC%9F%E6%9D%A5%E7%9C%8B%E5%B9%B3%E9%9D%A2%E9%AB%98%E6%89%8B%E7%9A%84%E8%B6%85%E5%A4%9A%E6%A1%88%E4%BE%8B%E6%BC%94%E7%A4%BA%EF%BC%81+%E5%8E%9F%E6%96%87%E6%88%B3%E2%86%92&amp;media=https%3A%2F%2Fimage.uisdc.com%2Fwp-content%2Fuploads%2F2020%2F05%2Fuisdc-banner-20200507-2.jpg"
            class="share" target="_blank" title="分享到花瓣"><i class="icon-huaban"></i></a></li>
    <li class="close-li"><span class="close"><i class="icon-close"></i><em class="txt hidden">取消</em></span></li>
  </ul>
</div>
  </span>
            </div>
        </div>
        <div class="sidebar" data-component="sidebar-autofixed" data-autofixed=".widget-show,.widget-article-menu">
            <section class="widget widget-post-related hide_sm">
                <h2 class="section-title"> 相关文章 </h2>
                <div class="section-content">
                    @foreach(getColumnArticles($current['id'] ?? 0, 'rand', 5, $article->id) as $k => $article)
                        <div class="item">
                            <a href="{{route('articles.show', ['article' => $article['hash_id']])}}" target="_blank">
                                <div class="num"><i class="btn btn-default-border">{{$k+1}}</i></div>
                                <h2>{{$article->title}}</h2>
                                <div class="item-thumb h-scale">
                                    <i class="thumb"
                                       style="background-image:url('{{render_cover($article->cover)   }}')"></i>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
            <section class="widget widget-article-menu hidden" id="article_menu"></section>
            <div class="sidebar-fixed-start"></div>
            <div class="sidebar-fixed" data-component="autofixed" data-start=".sidebar-fixed-start"
                 data-end=".post-content"
                 data-top="70"></div>
        </div>
    </div>
@stop
