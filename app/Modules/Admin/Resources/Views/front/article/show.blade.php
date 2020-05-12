@extends('admin::front.layout.app')
@section('content')
    <div class="crumbs container hide_sm" style="padding-top: 60px;">
        <ol class="breadcrumb">
            <li><a href="/" title="优设网 &#8211; UISDC">首页</a></li>
            @foreach(getArticleColumns($article->id) as $column)
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
                    <li class="item"><a class="" href="archives.html" target="_blank"> <i
                                class="icon icon-allposts"></i> 全部</a></li>
                    <li class="item"><a class="" href="category/uiicon.html" target="_blank"> <i
                                class="icon icon-ui"></i> UI</a></li>
                    <li class="item"><a class="current" href="category/graphic.html" target="_blank"> <i
                                class="icon icon-graphic"></i> 平面</a></li>
                    <li class="item"><a class="" href="category/element-of-web-ui.html" target="_blank"> <i
                                class="icon icon-web"></i> 网页</a></li>
                    <li class="item"><a class="" href="category/draw.html" target="_blank"> <i
                                class="icon icon-painting"></i> 手绘</a></li>
                    <li class="item"><a class="" href="category/e-commerce.html" target="_blank"> <i
                                class="icon icon-e-commerce"></i> 电商</a></li>
                    <li class="item"><a class="" href="category/interaction.html" target="_blank"> <i
                                class="icon icon-interactive"></i> 交互</a></li>
                    <li class="item"><a class="" href="category/product.html" target="_blank"> <i
                                class="icon icon-pm"></i> 产品</a></li>
                    <li class="item"><a class="" href="category/hot-download.html" target="_blank"> <i
                                class="icon icon-download"></i> 下载</a></li>
                    <li class="item"><a class="" href="category/tools-download.html" target="_blank"> <i
                                class="icon icon-site"></i> 神器</a></li>
                    <li class="item"><a class="" href="category/work-blueprint.html" target="_blank"> <i
                                class="icon icon-experience"></i> 职场</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="post-header">
        <div class="container">
            <h1 class="post-title">{{$article->title}}</h1>
            <h4 class="post-meta">
                <span class="remain hide_sm"> <i class="icon-time"></i> 阅读本文需 21 分钟 </span>
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
                    <a href="tag/%E5%A3%B9%E5%91%A8%E9%80%9F%E8%AF%BB.html" class="hide_sm" target="_blank"
                       data-component="tab"
                       data-event="hover" data-tab-wrap=".recommend-list"
                       data-tab-menus=".post-recommend .recommend-titles a"
                       data-tab-target=".recommend-week" data-tab-action="quick_read" data-tab-type="list-post"
                       data-ppp="5">一周速读</a>
                    <a href="zt.html" target="_blank" data-component="tab" data-event="hover"
                       data-tab-wrap=".recommend-list"
                       data-tab-menus=".post-recommend .recommend-titles a" data-tab-target=".recommend-zt"
                       data-tab-action="widget_zt" data-tab-type="list-post" data-ppp="5">专题文章<i
                            class="hot-icon"></i></a>
                </div>
                <div class="recommends">
                    <div class="recommend-list">
                        <ul class="recommend-new">
                            <li class="item"><h2 class="title"><a href="text-layout.html" target="_blank"> <i
                                            class="ico-tag">
                                            最新 </i> 创意广告中文字是如何运用的？来看平面高手的超多案例演示！ </a></h2><h4><i
                                        class="time">12小时前</i><i
                                        class="author">推荐： <a href="" target="_blank"> 研习设 </a> </i><span
                                        class="tags"><a
                                            href="tag/%E5%88%9B%E6%84%8F%E5%B9%BF%E5%91%8A.html"
                                            target="_blank">创意广告</a><a
                                            href="tag/%E5%AD%97%E4%BD%93%E9%80%89%E6%8B%A9.html"
                                            target="_blank">字体选择</a><a
                                            href="tag/%E5%B9%B3%E9%9D%A2%E8%AE%BE%E8%AE%A1.html"
                                            target="_blank">平面设计</a><a
                                            href="tag/%E6%8E%92%E7%89%88%E6%8A%80%E5%B7%A7.html"
                                            target="_blank">排版技巧</a><a
                                            href="tag/%E6%96%87%E5%AD%97%E6%8E%92%E7%89%88.html"
                                            target="_blank">文字排版</a><a
                                            href="tag/%E6%B5%B7%E6%8A%A5%E8%AE%BE%E8%AE%A1.html"
                                            target="_blank">海报设计</a><a
                                            href="tag/%E7%A0%94%E4%B9%A0%E8%AE%BE.html" target="_blank">研习设</a></span>
                                </h4></li>
                            <li class="item"><h2 class="title"><a href="b-end-button-design-guide.html" target="_blank">
                                        <i
                                            class="ico-tag"> 最新 </i> 上万字干货！超全面的B端按钮设计指南 </a></h2><h4><i class="time">13小时前</i><i
                                        class="author">推荐： <a href="" target="_blank"> CE青年 </a> </i><span class="tags"><a
                                            href="tag/b%E7%AB%AF%E8%AE%BE%E8%AE%A1.html" target="_blank">B端设计</a><a
                                            href="tag/%E4%BA%A4%E4%BA%92%E8%AE%BE%E8%AE%A1.html"
                                            target="_blank">交互设计</a><a
                                            href="tag/%E6%8C%89%E9%92%AE%E8%AE%BE%E8%AE%A1.html"
                                            target="_blank">按钮设计</a><a
                                            href="tag/%E7%94%A8%E6%88%B7%E4%BD%93%E9%AA%8C.html"
                                            target="_blank">用户体验</a><a
                                            href="tag/%E8%AE%BE%E8%AE%A1%E6%8C%87%E5%8D%97.html"
                                            target="_blank">设计指南</a></span>
                                </h4></li>
                            <li class="item"><h2 class="title"><a href="15-ui-technical-terms.html" target="_blank"> <i
                                            class="ico-tag"> 最新 </i> 一看就懂！15个交互与UI必懂的技术用语 </a></h2><h4><i class="time">14小时前</i><i
                                        class="author">推荐： <a href="" target="_blank"> 和出此严 </a> </i><span class="tags"><a
                                            href="tag/ui.html" target="_blank">UI</a><a
                                            href="tag/%E4%B8%93%E4%B8%9A%E6%9C%AF%E8%AF%AD.html"
                                            target="_blank">专业术语</a><a
                                            href="tag/%E5%90%8D%E8%AF%8D%E7%A7%91%E6%99%AE.html"
                                            target="_blank">名词科普</a><a
                                            href="tag/%E5%9F%BA%E7%A1%80%E7%9F%A5%E8%AF%86.html"
                                            target="_blank">基础知识</a><a
                                            href="tag/%E5%BC%80%E5%8F%91%E7%9F%A5%E8%AF%86.html"
                                            target="_blank">开发知识</a><a
                                            href="tag/%E6%B2%9F%E9%80%9A.html" target="_blank">沟通</a></span></h4></li>
                            <li class="item"><h2 class="title"><a href="reading-notes-of-design-system.html"
                                                                  target="_blank"> <i
                                            class="ico-tag"> 最新 </i> 想学会系统化设计？为你整理了这份《设计体系》的读书笔记 </a></h2><h4><i
                                        class="time">15小时前</i><i
                                        class="author">推荐： <a href="" target="_blank"> 二楼自习室 </a> </i><span
                                        class="tags"><a
                                            href="tag/%E4%BA%A7%E5%93%81.html" target="_blank">产品</a><a
                                            href="tag/%E5%9B%A2%E9%98%9F%E5%8D%8F%E4%BD%9C.html"
                                            target="_blank">团队协作</a><a
                                            href="tag/%E7%BB%84%E4%BB%B6%E5%BA%93.html" target="_blank">组件库</a><a
                                            href="tag/%E8%AE%BE%E8%AE%A1%E4%BD%93%E7%B3%BB.html"
                                            target="_blank">设计体系</a><a
                                            href="tag/%E8%AE%BE%E8%AE%A1%E8%AF%AD%E8%A8%80.html"
                                            target="_blank">设计语言</a><a
                                            href="tag/%E8%AF%BB%E4%B9%A6%E7%AC%94%E8%AE%B0.html"
                                            target="_blank">读书笔记</a></span>
                                </h4></li>
                            <li class="item"><h2 class="title"><a href="design-value.html" target="_blank"> <i
                                            class="ico-tag">
                                            最新 </i> 用十个案例，聊聊设计的价值在中国意味着什么？ </a></h2><h4><i class="time">15小时前</i><i
                                        class="author">推荐： <a href="" target="_blank"> 卷宗Wallpaper </a> </i><span
                                        class="tags"><a href="tag/%E4%BA%A7%E5%93%81%E8%AE%BE%E8%AE%A1.html"
                                                        target="_blank">产品设计</a><a
                                            href="tag/%E5%88%9B%E6%84%8F%E8%AE%BE%E8%AE%A1.html"
                                            target="_blank">创意设计</a><a
                                            href="tag/%E5%8F%AF%E6%8C%81%E7%BB%AD%E8%AE%BE%E8%AE%A1.html"
                                            target="_blank">可持续设计</a><a
                                            href="tag/%E7%8E%AF%E4%BF%9D%E8%AE%BE%E8%AE%A1.html"
                                            target="_blank">环保设计</a><a
                                            href="tag/%E8%AE%BE%E8%AE%A1%E4%BB%B7%E5%80%BC.html"
                                            target="_blank">设计价值</a></span>
                                </h4></li>
                        </ul>
                        <ul class="recommend-hot"></ul>
                        <ul class="recommend-week"></ul>
                        <ul class="recommend-zt"></ul>
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
            <section class="widget widget-news hide_sm">
                <h2 class="section-title"><a href="news.html" target="_blank"> 优设读报 </a> <span
                        class="sub">2020年5月09日 星期六</span></h2>
                <div class="section-content">
                    <ul>
                        <li><a href="news.html" target="_blank"> <i class="num">01</i> 可口可乐成立 134 周年，定制中文字体「在乎体」开放下载
                            </a>
                        </li>
                        <li><a href="news.html" target="_blank"> <i class="num">02</i> 魅族更新LOGO品牌色，发布全新品牌字体 </a></li>
                        <li><a href="news.html" target="_blank"> <i class="num">03</i> 欧洲设计奖（ED Awards）公布获奖情况 </a></li>
                        <li><a href="news.html" target="_blank"> <i class="num">04</i> 蒙纳公司推出以 19 世纪为灵感的新字体 Macklin </a>
                        </li>
                        <li><a href="news.html" target="_blank"> <i class="num">05</i> MIUI 12 开发版推送：支持 32 款机型 </a></li>
                    </ul>
                    <div class="viewAll">
                        <a href="news.html" target="_blank" class="btn btn-default"> 查看全部 <i class="icon-right"></i>
                        </a>
                    </div>
                </div>
            </section>
            <section class="widget widget-wonderful hide_sm">
                <h2 class="section-title"> 精彩发现 </h2>
                <div class="section-content">
                    <div class="wonderful-part">
                        <h3><i class="icon-hunter"></i> 细节猎人 </h3>
                        <div class="part-content">
                            <a href="topic/%E8%AE%BE%E8%AE%A1%E9%80%BB%E8%BE%91.html" target="_blank">设计逻辑</a><a
                                href="topic/%E6%98%93%E7%94%A8%E6%80%A7.html" target="_blank">易用性</a><a
                                href="topic/%E6%83%85%E5%A2%83%E9%A2%84%E5%88%A4.html" target="_blank">情境预判</a><a
                                href="topic/%E8%B6%A3%E5%91%B3%E6%80%A7.html" target="_blank">趣味性</a><a
                                href="topic/%E4%BA%BA%E6%80%A7%E5%8C%96.html" target="_blank">人性化</a><a
                                href="topic/%E6%83%85%E6%84%9F%E5%8C%96%E8%AE%BE%E8%AE%A1.html"
                                target="_blank">情感化设计</a><a
                                href="topic/%E8%85%BE%E8%AE%AF.html" target="_blank">腾讯</a><a
                                href="topic/%E4%BF%A1%E6%81%AF%E5%91%88%E7%8E%B0.html" target="_blank">信息呈现</a><a
                                href="topic/%E7%A4%BE%E4%BA%A4.html" target="_blank">社交</a><a href="hunters.html"
                                                                                              class="a_all"
                                                                                              target="_blank">全部</a>
                        </div>
                    </div>
                    <div class="wonderful-part">
                        <h3><i class="icon-industry"></i> 设计灵感 </h3>
                        <div class="part-content">
                            <a class="" href="https://uiiiuiii.com/inspiration" target="_blank">灵感首页</a><a class=""
                                                                                                           href="https://uiiiuiii.com/inspirations/banner"
                                                                                                           target="_blank">Banner设计</a><a
                                class="" href="https://uiiiuiii.com/inspirations/poster" target="_blank">海报设计</a><a
                                class=""
                                href="https://uiiiuiii.com/inspirations/logo"
                                target="_blank">Logo设计</a><a
                                class="" href="https://uiiiuiii.com/inspirations/ui" target="_blank">UI设计</a><a class=""
                                                                                                                href="https://uiiiuiii.com/inspirations/illustrations"
                                                                                                                target="_blank">插画绘画</a><a
                                class="" href="https://uiiiuiii.com/inspirations/fontdesign" target="_blank">字体设计</a><a
                                class="" href="https://uiiiuiii.com/inspirations/featured/motto"
                                target="_blank">每日一签</a><a
                                class="a_all" href="https://uiiiuiii.com/inspirations/featured" target="_blank">热门灵感</a>
                        </div>
                    </div>
                    <div class="wonderful-part">
                        <h3><i class="icon-2-inspiration"></i> 软件教程 </h3>
                        <div class="part-content-flex">
                            <div class="item"><a href="https://uiiiuiii.com/photoshop" target="_blank"><i class="thumb "
                                                                                                          style="background-image:url(https://image.uisdc.com/wp-content/uploads/2019/10/sdc-h-ps.png)"></i><span>PS教程</span></a>
                            </div>
                            <div class="item"><a href="https://uiiiuiii.com/illustrator" target="_blank"><i
                                        class="thumb "
                                        style="background-image:url(https://image.uisdc.com/wp-content/uploads/2019/10/sdc-h-ai.png)"></i><span>AI教程</span></a>
                            </div>
                            <div class="item"><a href="https://uiiiuiii.com/aftereffects" target="_blank"><i
                                        class="thumb "
                                        style="background-image:url(https://image.uisdc.com/wp-content/uploads/2019/10/sdc-h-ae.png)"></i><span>AE教程</span></a>
                            </div>
                            <div class="item"><a href="https://uiiiuiii.com/cinema4d/12121653.html" target="_blank"><i
                                        class="thumb "
                                        style="background-image:url(https://image.uisdc.com/wp-content/uploads/2019/10/sdc-h-c4d.png)"></i><span>C4D教程</span></a>
                            </div>
                            <div class="item"><a href="https://uiiiuiii.com/knowledge/121211571.html" target="_blank"><i
                                        class="thumb "
                                        style="background-image:url(https://image.uisdc.com/wp-content/uploads/2019/10/sdc-h-sketch.png)"></i><span>Sketch</span></a>
                            </div>
                            <div class="item"><a href="https://uiiiuiii.com/knowledge/1212122079.html"
                                                 target="_blank"><i
                                        class="thumb "
                                        style="background-image:url(https://image.uisdc.com/wp-content/uploads/2019/10/sdc-h-pr.jpg)"></i><span>视频剪辑</span></a>
                            </div>
                            <div class="item"><a href="https://uiiiuiii.com/knowledge/121212401.html" target="_blank"><i
                                        class="thumb "
                                        style="background-image:url(https://image.uisdc.com/wp-content/uploads/2019/10/sdc-h-lr.jpg)"></i><span>Lr教程</span></a>
                            </div>
                            <div class="item"><a href="https://uiiiuiii.com/draw" target="_blank"><i class="thumb "
                                                                                                     style="background-image:url(https://image.uisdc.com/wp-content/uploads/2019/10/sdc-h-draw.jpg)"></i><span>手绘教程</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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
