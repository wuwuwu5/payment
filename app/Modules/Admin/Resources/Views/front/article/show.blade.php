@extends('admin::front.layout.app')
@section('content')
    <div class="crumbs container hide_sm" style="padding-top: 60px;">
        <ol class="breadcrumb">
            <li><a href="/" title="优设网 &#8211; UISDC">首页</a></li>
            @php
                $columns = getArticleColumns($article->id);
            @endphp
            @foreach($columns as $column)
                <li>
                    <a href="{{route('articles.column.show' ,['type' => $column['name']])}}">{{$column['nickname']}}</a>
                </li>
            @endforeach
            <li>正文</li>
        </ol>
    </div>
    <div class="top-cats hide_sm">
        <div class="container">
            <div class="items">
                <ul>
                    <li class="item">
                        <a class="" href="{{route('articles.column.show', ['type' => 'all'])}}" target="_blank">
                            <i class="icon icon-allposts"></i>
                            全部
                        </a>
                    </li>
                    @php
                        $parent = $columns[0]??[];
                        $current = $columns[count($columns) - 1]??[];
                        if (empty($parent)) {
                            $children = [];
                        } else {
                            $children = getFrontChildrenColumns($parent['id']);
                        }
                    @endphp
                    @foreach($children as $child)
                        <li class="item">
                            <a class="{{($current['id'] ?? '') == ($child['id'] ?? -1) ? 'current' : ''}}"
                               href="{{route('articles.column.show', ['type' => $child['mark_name']])}}"
                               target="_blank">
                                <i class="icon icon-allposts"></i>
                                {{$child['name']}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
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
                <span class="zan"> 点赞 {{ $article->give_count ?? 0 }} </span>
                <span class="comment">
                    <a href="#post_comment">评论区</a>
                </span>
            </h4>
        </div>
    </div>
    <div class="content container post-content">
        <div class="main">
            <div class="article-main">
                <div class="article">
                    {!! $article->add->body ?? '' !!}

                </div>

                <div class="article-zan-fav">
                    <div class="zan-div">
                    <span class="zan btn btn-orange" data-component="zan" data-pid="{{$article->hash_id}}"
                          data-count="{{$article->give_count}}">
                        <i class="icon-1-like"></i>
                        <span class="txt">点赞</span>
                        <em class="count">{{$article->give_count}}</em>
                        </span>
                    </div>
                    <div class="fav-div">
                <span class="fav btn btn-orange-border"
                      data-component="fav"
                      data-id="{{$article->hash_id}}"
                      data-original-count="{{$article->collection_count}}"
                      data-count="{{$article->collection_count}}"> <i class="icon-1-heart-border"></i>
                    <span class="txt">收藏</span>
                    <em>{{$article->collection_count}}</em>
                </span>
                    </div>
                </div>
                <div class="article-info">
                    <p>
                        <a href="text-layout.html" class="btn btn-orange-border copy-link"> <i class="icon-link"></i>
                            复制本文链接
                            <input type="text" name="copy" value="https://www.uisdc.com/text-layout"
                                   class="copy-content"> </a>
                        文章为作者独立观点不代表优设网立场，<span>未经允许不得转载。</span>
                    </p>
                </div>
                <div class="article-tag">
                    <h4>继续阅读与本文标签相同的文章</h4>
                    <div class="tags">
                        <a href="tag/%E5%88%9B%E6%84%8F%E5%B9%BF%E5%91%8A.html" rel="tag">创意广告</a><a
                            href="tag/%E5%AD%97%E4%BD%93%E9%80%89%E6%8B%A9.html" rel="tag">字体选择</a><a
                            href="tag/%E5%B9%B3%E9%9D%A2%E8%AE%BE%E8%AE%A1.html" rel="tag">平面设计</a><a
                            href="tag/%E6%8E%92%E7%89%88%E6%8A%80%E5%B7%A7.html" rel="tag">排版技巧</a><a
                            href="tag/%E6%96%87%E5%AD%97%E6%8E%92%E7%89%88.html" rel="tag">文字排版</a><a
                            href="tag/%E6%B5%B7%E6%8A%A5%E8%AE%BE%E8%AE%A1.html" rel="tag">海报设计</a><a
                            href="tag/%E7%A0%94%E4%B9%A0%E8%AE%BE.html" rel="tag">研习设</a></div>
                </div>
            </div>
            <div class="article-paged">
                <div class="previous prev_next"><a href="archives.html" target="_blank" class="flex paged-item">
                        <div class="paged-thumb"><i class="thumb "
                                                    style="background-image:url(https://image.uisdc.com/wp-content/uploads/2019/10/uisdc-bg-article-trans.png)"></i>
                        </div>
                        <div class="paged-main"><h5>返回目录</h5>
                            <h3>每天优设看文章 掌握设计新动向</h3></div>
                    </a></div>
                <div class="next prev_next"><a href="b-end-button-design-guide.html" target="_blank"
                                               class="flex paged-item">
                        <div class="paged-thumb h-scale"><i class="thumb "
                                                            style="background-image:url(https://image.uisdc.com/wp-content/uploads/2020/05/uisdc-banner-20200507-5.jpg)"></i>
                        </div>
                        <div class="paged-main"><h5>下一篇 <i class="icon-right"></i></h5>
                            <h3>上万字干货！超全面的B端按钮设计指南</h3></div>
                    </a></div>
            </div>
            <section class="article-related">
                <div class="section-title"> 继续阅读相关文章</div>
                <div class="section-content">
                    <div class="flex">
                        <div class="wrap wrap-first">
                            <div class="item"><a href="photo-design-poster-15.html" target="_blank">
                                    <div class="item-thumb h-scale"><i class="thumb "
                                                                       style="background-image:url(https://image.uisdc.com/wp-content/uploads/2020/04/uisdc-banner-20200421-1.jpg)"></i>
                                    </div>
                                    <div class="item-main"><h2>如何处理好文案和图片之间的层级关系，看这篇文章就够啦！</h2><h5>18860 人阅读</h5></div>
                                </a></div>
                        </div>
                        <div class="wrap wrap-items">
                            <div class="item"><a href="layout-page.html" target="_blank">
                                    <div class="item-thumb h-scale"><i class="thumb "
                                                                       style="background-image:url(https://image.uisdc.com/wp-content/uploads/2020/03/uisdc-banner-20200326-1.jpg)"></i>
                                    </div>
                                    <div class="item-main"><h2>文案信息较多时，该如何编排版面才会好看？</h2><h5>56504 人阅读</h5></div>
                                </a></div>
                            <div class="item"><a href="make-design-more-meaningful.html" target="_blank">
                                    <div class="item-thumb h-scale"><i class="thumb "
                                                                       style="background-image:url(https://image.uisdc.com/wp-content/uploads/2020/04/uisdc-banner-20200416-3.jpg)"></i>
                                    </div>
                                    <div class="item-main"><h2>平面高手出品！如何让你的设计变的更有内涵？</h2><h5>16969 人阅读</h5></div>
                                </a></div>
                            <div class="item"><a href="launch-composition.html" target="_blank">
                                    <div class="item-thumb h-scale"><i class="thumb "
                                                                       style="background-image:url(https://image.uisdc.com/wp-content/uploads/2020/05/uisdc-banner-20200504-3.jpg)"></i>
                                    </div>
                                    <div class="item-main"><h2>这种构成方法，让你的画面更吸睛！</h2><h5>13590 人阅读</h5></div>
                                </a></div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="comment-div" id="post_comment">
                <h3 class="section-title">发表评论
                    <span class="sub">已发布 <i class="clr_orange comment_count">1</i> 条</span>
                </h3>
                <div class="comment-write">
                    <form class="comment-write-form" action="index.html" method="post">
                        <input type="hidden" name="pid" value="370902">
                        <input type="hidden" name="parent" value="0">
                        <div class="form-item">
                            <div class="item-title">
                        <span class="user-avatar"><i class="thumb "
                                                     style="background-image:url(https://image.uisdc.com/wp-content/uploads/2018/06/avatar-uisdc-chat.png)"></i></span>
                            </div>
                            <div class="item-content"><span class="user-name"> <input type="text" name="user-name"
                                                                                      data-placeholder="欢迎来到优设，试试别填名字..."
                                                                                      class="txt txt_user_name"> </span>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="item-title"><label for="comment_word">评论</label></div>
                            <div class="item-content">
                        <textarea name="comment" rows="1" id="comment_word" class="comment-word txt lineLen"
                                  data-placeholder="您的评论会经编辑或作者筛选后显示，全站可见，请文明发言。" data-total=800></textarea>
                                <span class="rest"> 还可以输入 <em>800</em> 个字 </span>
                            </div>
                        </div>
                        <div class="form-item form-yzm hidden">
                            <div class="item-title"><label for="yzm"> 验证码 </label></div>
                            <div class="item-content">
                                <input type="text" name="yzm" id="yzm" class="txt yzm comment-yzm"
                                       data-placeholder="请输入验证码">
                                <img src="" alt="yzm">
                                <input type="hidden" name="prefix" class="yzm_prefix">
                            </div>
                        </div>
                        <div class="error-box hide form-item">
                            <div class="item-title"> &nbsp;</div>
                            <div class="item-content"></div>
                        </div>
                        <div class="form-item">
                            <div class="item-title"> &nbsp;</div>
                            <div class="item-content">
                                <button type="submit" class="btn btn-orange btn-submit">提交评论</button>
                            </div>
                        </div>
                    </form>
                    <span class="btn-reply-close"> <i class="icon-close"></i> </span>
                </div>
                <div class="comment-list" id="comment_list" data-paged="1" data-pid="370902"></div>
                <div class="content-loading" data-component="loading">
                    <i class="loading-icon"></i> 载入中....
                </div>
                <div class="comment-more hidden">
                    <span class="btn btn-orange btn-more-comments">加载更多评论</span>
                </div>
                <div class="comment-nomore hidden">
                    没有更多评论了
                </div>
                <div class="comment-footer">
                    <div class="comment-footer-main">
                        <div class="item">
                            <span class="hide_sm">评论就这些咯，让大家也知道你的独特见解</span>
                            <a href="#post_comment" class="btn btn-orange-border">立即评论</a>
                        </div>
                        <div class="item">
                            以上留言仅代表用户个人观点，不代表优设立场
                        </div>
                    </div>
                    <i class="ji2-icon" data-bubble="yes"></i>
                </div>
            </div>
            <div class="article-show">
                <div class="kind">
                    <div class="spark_rm">
                <span class="hidden"><a target="_blank" href="https://xue.uisdc.com/draw2/" class="has_border"><img
                            src="https://image.uisdc.com/wp-content/uploads/2020/05/dkt-draw-banner20200507.jpg"/></a></span>
                        <span class="hidden"><a target="_blank" href="https://uiiiuiii.com/" class="has_border"><img
                                    src="https://image.uisdc.com/wp-content/uploads/2020/04/uisdc-uu-banner-top2004.jpg"/></a></span>
                    </div>
                </div>
            </div>
            <div class="post-recommend">
                <div class="recommend-titles">
                    <a href="archives.html" class="current" target="_blank" data-component="tab" data-event="hover"
                       data-tab-wrap=".recommend-list" data-tab-menus=".post-recommend .recommend-titles a"
                       data-tab-target=".recommend-new" data-tab-action="new_posts" data-tab-type="list-default"
                       data-ppp="5">最新文章</a>
                    <a href="archives.html" target="_blank" data-component="tab" data-event="hover"
                       data-tab-wrap=".recommend-list" data-tab-menus=".post-recommend .recommend-titles a"
                       data-tab-target=".recommend-hot" data-tab-action="hot_posts" data-tab-type="list-post"
                       data-ppp="5">最热文章</a>
                </div>
                <div class="recommends">
                    <div class="recommend-list">
                        <ul class="recommend-new">
                            @foreach(getColumnArticles($current['id'] ?? 0, 'now', 5) as $article)
                                @include('admin::front.article.show_item',  compact('article'))
                            @endforeach
                        </ul>
                        <ul class="recommend-hot"></ul>
                        <div class="more">
                            <a href="archives.html" class="btn btn-default">查看更多</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="article-toolkit" data-component="autofixed" data-start=".post-content" data-end=".post-content"
                 data-top="70">
                <a class="toolkit comment" href="#post_comment">
                    <i class="icon-comm"></i>
                    <em>{{$article->post_count}}</em>
                </a>
                <span class="toolkit fav"
                      data-component="fav"
                      data-id="{{$article->hash_id}}"
                      data-original-count="{{$article->collection_count}}"
                      data-count="{{$article->collection_count}}">
                    <i class="icon-1-heart-border"></i>
                    <span>收藏</span>
                </span>
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
                    <div class="item"><a href="photo-design-poster-15.html" target="_blank">
                            <div class="num"><i class="btn btn-default-border">1</i></div>
                            <h2>如何处理好文案和图片之间的层级关系，看这篇文章就够啦！</h2>
                            <div class="item-thumb h-scale"><i class="thumb "
                                                               style="background-image:url(https://image.uisdc.com/wp-content/uploads/2020/04/uisdc-banner-20200421-1.jpg)"></i>
                            </div>
                        </a></div>
                    <div class="item"><a href="layout-page.html" target="_blank">
                            <div class="num"><i class="btn btn-default-border">2</i></div>
                            <h2>文案信息较多时，该如何编排版面才会好看？</h2>
                            <div class="item-thumb h-scale"><i class="thumb "
                                                               style="background-image:url(https://image.uisdc.com/wp-content/uploads/2020/03/uisdc-banner-20200326-1.jpg)"></i>
                            </div>
                        </a></div>
                    <div class="item"><a href="make-design-more-meaningful.html" target="_blank">
                            <div class="num"><i class="btn btn-default-border">3</i></div>
                            <h2>平面高手出品！如何让你的设计变的更有内涵？</h2>
                            <div class="item-thumb h-scale"><i class="thumb "
                                                               style="background-image:url(https://image.uisdc.com/wp-content/uploads/2020/04/uisdc-banner-20200416-3.jpg)"></i>
                            </div>
                        </a></div>
                    <div class="item"><a href="launch-composition.html" target="_blank">
                            <div class="num"><i class="btn btn-default-border">4</i></div>
                            <h2>这种构成方法，让你的画面更吸睛！</h2>
                            <div class="item-thumb h-scale"><i class="thumb "
                                                               style="background-image:url(https://image.uisdc.com/wp-content/uploads/2020/05/uisdc-banner-20200504-3.jpg)"></i>
                            </div>
                        </a></div>
                </div>
            </section>
            <section class="widget widget-show">
                <div class="kind">
                    <div class="spark_rm">
                    <span class="hidden"><a href="https://xue.uisdc.com/draw2/" target="_blank" class="has_border"><img
                                alt="优设"
                                src="https://image.uisdc.com/wp-content/uploads/2020/03/2020-draw2-banner-0301.jpg"></a></span>
                    </div>
                </div>
            </section>
            <section class="widget widget-article-menu hidden" id="article_menu"></section>
            <div class="sidebar-fixed-start"></div>
            <div class="sidebar-fixed" data-component="autofixed" data-start=".sidebar-fixed-start"
                 data-end=".post-content"
                 data-top="70"></div>
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
