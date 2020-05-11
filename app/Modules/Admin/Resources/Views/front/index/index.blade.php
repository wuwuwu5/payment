@extends('admin::front.layout.app')
@section('content')
    <div class="home-first">
        <div class="container">
            <div class="row">
                <div class="col-3-4">
                    <div class="vitara_slide_in" id="spark_slide_homepage_new" data-img-width="970"
                         data-img-height="370"
                         data-content-width="970" data-animate="" data-speed="3000" data-event="click">
                        <div class="slide_loading"
                             style="height:370px;background-image:url(https://image.uisdc.com/wp-content/uploads/2020/05/our-new-world-banner.jpg);">
                            <img src="https://image.uisdc.com/wp-content/uploads/2020/05/our-new-world-banner.jpg"
                                 alt="slide"></div>
                        <div class="vitara_slide">
                            <ul>
                                @foreach(getSlides('home') as $slide)
                                    <li>
                                        <a href="{{ empty($slide['redirect']) ?'javaScript::' :$slide['redirect'] }}"
                                           target="_blank"><img
                                                src="{{$slide['img_url']}}"
                                                alt="slide" data-title="">
                                            <h3>
                                                {{ $slide['name'] }}
                                            </h3>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-1-4 h-images">
                    @foreach(getSlides('home_advertisement', 2) as $slide)
                        <div class="item-tuwen">
                            <a href="{{ empty($slide['redirect']) ?'javaScript::' :$slide['redirect'] }}"
                               target="_blank"
                               class="h-mark">
                                <i class="thumb" style="background-image:url('{{$slide['img_url']}}')"></i>
                                <strong>{{$slide['name']}}</strong>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="content container">
        <div class="main">
            <div class="article-menus flex">
                <ul class="menu nav-inline hide_sm">
                    <li class="menu-item">
                        <a target="_blank" class="current" href="javaScript:" data-component="tab"
                           data-tab-wrap=".articles" data-tab-menus=".article-menus .menu a"
                           data-tab-target=".articles-new" data-tab-action="last_posts"
                           data-tab-type="list-default" data-ppp="16">
                            最新<span class="hide_sm">文章</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a target="_blank" href="javaScript:" data-component="tab"
                           data-tab-wrap=".articles" data-tab-menus=".article-menus .menu a"
                           data-tab-target=".articles-hot" data-tab-action="hot_posts"
                           data-tab-type="list-default" data-ppp="16">
                            <span class="hide_sm">近期</span>热门
                        </a>
                    </li>
                </ul>
                <div class="menu-r nav-inline auto-scroll-menu">
                    <ul>
                        @foreach(getFrontChildrenColumns(55, true) as $column)
                            <li><a href="/articles/{{$column['mark_name']}}" target="_blank">{{ $column['name'] }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="articles">
                <div class="articles-new">
                    @foreach($articles as $article)
                        @include('admin::front.article.item', compact('article'))
                    @endforeach
                </div>
                <div class="articles-hot"></div>
                <div class="articles-week"></div>
            </div>
            <div class="seeAll">
                <a href="/article/all?page=2&limit=20" class="btn btn-orange">查看全部文章</a>
            </div>
            <section class="kingba hide_sm">
                <div class="section-title">
                    金主爸爸 <small> <a href="about.html" target="_blank">联系优设</a> </small>
                </div>
                <div class="section-content">
                    <div class="kind">
                        <div class="spark_rm">
                        <span class="hidden"><a target="_blank" href="https://xue.uisdc.com/draw2/"
                                                class="has_border"><img
                                    src="https://image.uisdc.com/wp-content/uploads/2020/05/dkt-draw-banner20200507.jpg"/></a></span>
                            <span class="hidden"><a target="_blank" href="https://uiiiuiii.com/" class="has_border"><img
                                        src="https://image.uisdc.com/wp-content/uploads/2020/04/uisdc-uu-banner-top2004.jpg"/></a></span>
                        </div>
                    </div>
                </div>
            </section>
            <div class="part-zt-archive">
                <h2 class="section-title">优设专题
                    <a href="zt.html" class="more" target="_blank">查看全部</a>
                </h2>
                <div class="section-content">
                    <div class="zt-item">
                        <a href="zt/redesign.html" target="_blank">
                            <div class="item-thumb">
                                <i class="thumb "
                                   style="background-image:url(https://image.uisdc.com/wp-content/uploads/2019/03/gb-zt-banner19329.jpg)"></i>
                                <h5>
                                    <span class="l">638626人看过</span>
                                    <span class="r">26篇文章</span>
                                </h5>
                            </div>
                            <h2>改版设计</h2>
                            <h4>大公司的改版方法和实战案例都在这了！</h4>
                            <div class="entry">
                                本专题包括4篇改版设计方法和技巧，还有超过10个大公司的产品改版设计实战案例。想做改版设计之前记得来看一遍，绝对是收获满满！
                            </div>
                            <div class="btns">
                                <span class="btn">查看专题</span>
                            </div>
                        </a>
                    </div>
                    <div class="zt-item">
                        <a href="zt/design-films.html" target="_blank">
                            <div class="item-thumb">
                                <i class="thumb "
                                   style="background-image:url(https://image.uisdc.com/wp-content/uploads/2018/08/uisdc-zt-180820.jpg)"></i>
                                <h5>
                                    <span class="l">261111人看过</span>
                                    <span class="r">12篇文章</span>
                                </h5>
                            </div>
                            <h2>设计影片</h2>
                            <h4>看完能涨姿势的设计相关影片</h4>
                            <div class="entry">
                                本专题收录了适合设计师观看的 TED
                                演讲、电影、纪录片等，既有帮你学习艺术史的，也有让你提高审美的，还有很多关于顶尖设计师专访的，几乎每一部推荐都是大牌出品，质量有口皆碑。收藏起来，作为下饭菜是最好的！
                            </div>
                            <div class="btns">
                                <span class="btn">查看专题</span>
                            </div>
                        </a>
                    </div>
                    <div class="zt-item">
                        <a href="zt/design-guideline.html" target="_blank">
                            <div class="item-thumb">
                                <i class="thumb "
                                   style="background-image:url(https://image.uisdc.com/wp-content/uploads/2018/07/zt-sjgf-0709.jpg)"></i>
                                <h5>
                                    <span class="l">502464人看过</span>
                                    <span class="r">14篇文章</span>
                                </h5>
                            </div>
                            <h2>设计规范</h2>
                            <h4>那些条条框框您真得懂？</h4>
                            <div class="entry">
                                说出来你可能不信，我去了几家公司，每个公司里都让我制作设计规范，说是为了便于公司规划流程化管理，当时我可是费了老大劲...
                            </div>
                            <div class="btns">
                                <span class="btn">查看专题</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="part-hot-cats">
                <h2 class="section-title">热门频道</h2>
                <section class="hot-cats-section">
                    <div class="section-content">
                        <div class="item"><a href="zt.html" target="_blank"><i class="icon-subject"></i>
                                <h3>设计专题</h3><h4>热门设计知识精挑细选</h4></a></div>
                        <div class="item"><a href="hunters.html" target="_blank"><i class="icon-hunter"></i>
                                <h3>细节猎人</h3><h4>1分钟小短文揣摩设计真谛</h4></a></div>
                        <div class="item"><a href="news.html" target="_blank"><i class="icon-newspaper"></i>
                                <h3>优设读报</h3><h4>行业资讯一站知晓</h4></a></div>
                        <div class="item"><a href="talk.html" target="_blank"><i class="icon-topic"></i>
                                <h3>设计话题</h3><h4>高手大咖在线答疑解惑</h4></a></div>
                        <div class="item"><a href="category/hangye.html" target="_blank"><i class="icon-toppost"></i>
                                <h3>行业新闻</h3><h4>行业大事小事全知道</h4></a></div>
                        <div class="item"><a href="https://event.uisdc.com/" target="_blank"><i class="icon-event"></i>
                                <h3>设计大赛</h3><h4>专业承办设计赛事活动</h4></a></div>
                    </div>
                </section>
            </div>
        </div>
        <div class="sidebar">
            <section class="widget widget-talk-hot hide_sm">
                <div class="section-title"><a href="talk.html" target="_blank"> 热门话题 </a></div>
                <div class="section-content">
                    <div class="item"><a href="talk/121207370363.html" target="_blank"><h5><span class="user_avatar"><i
                                        class="thumb "
                                        style="background-image:url(https://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83erDHPX6UanEwvxfdiaZHpcqMYWfSavNMEJlh94zX0eibm2fYMhSxHZ6dcV34FiaxGI54hlRy0t2H9t2w/132)"></i></span>
                                👣call me袁坚强😄 邀请你来回答 </h5>
                            <h3 class="cont">网站的网页栅格化设计有什么技巧？ </h3><h4>462位设计师围观了该问题 <span
                                    class="btn btn-orange-border">我来回答</span>
                            </h4></a></div>
                    <div class="item"><a href="talk/121207369955.html" target="_blank"><h5><span class="user_avatar"><i
                                        class="thumb "
                                        style="background-image:url(https://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTK9Libibkcu8icV0MtRNbdWUF4eTDoXB2K3cVMicBjDdlTEs8poudibALtB2nWicL6Bgl6IeYogpEo2DwhA/132)"></i></span>
                                LEO 邀请你来回答 </h5>
                            <h3 class="cont">疫情影响，现在UI找工作还找得到吗？ </h3><h4>883位设计师围观了该问题 <span
                                    class="btn btn-orange-border">我来回答</span>
                            </h4></a></div>
                    <div class="item"><a href="talk/121207367697.html" target="_blank"><h5><span class="user_avatar"><i
                                        class="thumb "
                                        style="background-image:url(https://thirdwx.qlogo.cn/mmopen/vi_32/GkztvZGR0wWMZeXjhrL7ibsvCmen52bTWE08ibpbjz1pficS5hvcKh4OvouJN7fVKpD1YwtPuSr1Z6v5K3PNg9ic6w/132)"></i></span>
                                每天都想魂穿心空 邀请你来回答 </h5>
                            <h3 class="cont">新闻专业想往文娱传媒发展，但是对接下来该怎么努力有点迷茫。 </h3><h4>1092位设计师围观了该问题 <span
                                    class="btn btn-orange-border">我来回答</span></h4></a></div>
                </div>
                <div class="viewAll">
                    <a href="talk.html" target="_blank" class="btn btn-default"> 全部话题 <i class="icon-right"></i> </a>
                </div>
            </section>

            <section class="widget widget-zt-hot hide_sm">
                <div class="section-title"><a href="zt.html" target="_blank"> 设计专题 </a></div>
                <div class="section-content">
                    <div class="item item_1"><a href="zt/user-study.html" target="_blank"><span class="num"> 1 </span>
                            <div class="item_thumb h-scale"><i class="thumb "
                                                               style="background-image:url(https://image.uisdc.com/wp-content/uploads/2019/06/uisdc-zt-banner-user.jpg)"></i>
                            </div>
                            <h2>用户研究方法</h2>
                            <h3>8个最常见的用研方法合辑</h3><span class="btn btn-orange-border">查看专题</span></a></div>
                    <div class="item item_2"><a href="zt/career-planning.html" target="_blank"><span
                                class="num"> 2 </span>
                            <div class="item_thumb h-scale"><i class="thumb "
                                                               style="background-image:url(https://image.uisdc.com/wp-content/uploads/2018/07/yszt-0715-zc.jpg)"></i>
                            </div>
                            <h2>职场规划</h2>
                            <h3>帮迷茫的设计师找到职场方向</h3><span class="btn btn-orange-border">查看专题</span></a></div>
                    <div class="item item_3"><a href="zt/hand-drawn-self-study.html" target="_blank"><span
                                class="num"> 3 </span>
                            <div class="item_thumb h-scale"><i class="thumb "
                                                               style="background-image:url(https://image.uisdc.com/wp-content/uploads/2018/07/uisdc-zt-girl0712.jpg)"></i>
                            </div>
                            <h2>自学手绘</h2>
                            <h3>消除你学手绘的疑虑</h3><span class="btn btn-orange-border">查看专题</span></a></div>
                    <div class="item item_4"><a href="zt/design-trends.html" target="_blank"><span
                                class="num"> 4 </span>
                            <h2>设计趋势</h2>
                            <h3>流行设计一目了然</h3></a></div>
                    <div class="item item_5"><a href="zt/brand-design.html" target="_blank"><span class="num"> 5 </span>
                            <h2>品牌设计</h2>
                            <h3>完整的品牌设计过程</h3></a></div>
                    <div class="item item_6"><a href="zt/inspiration.html" target="_blank"><span class="num"> 6 </span>
                            <h2>灵感专题</h2>
                            <h3>让创意如万斛泉源，不择地皆可出</h3></a></div>
                    <div class="item item_7"><a href="zt/free-photo.html" target="_blank"><span class="num"> 7 </span>
                            <h2>免费图库</h2>
                            <h3>高质量的免费可商用图片都在这儿了！</h3></a></div>
                    <div class="item item_8"><a href="zt/uisdc-round-table.html" target="_blank"><span
                                class="num"> 8 </span>
                            <h2>优设圆桌</h2>
                            <h3>专属于设计师的围炉夜话</h3></a></div>
                </div>
                <div class="viewAll">
                    <a href="zt.html" target="_blank" class="btn btn-default"> 全部专题 <i class="icon-right"></i> </a>
                </div>
            </section>
            <section class="widget widget-comment-hot hide_sm">
                <div class="section-title"> 文章热评</div>
                <div class="section-content">
                    <div class="item">
                        <div class="meta">
                            <div class="meta-item"><span class="comment-avatar"><i class="thumb "
                                                                                   style="background-image:url(https://thirdwx.qlogo.cn/mmopen/vi_32/W1cXa9sVfHXuoT4IOzvVcOs7IDypB4gexhibUSdliaBW59mjy6fqhlic7rOc8ic0dHChWWOJMtG6LRygbNaaiccJMZw/132)"></i></span>
                                弹谭糖
                            </div>
                            <span class="views">7914 人阅读</span></div>
                        <div class="comment-content"><p><a href="4-super-experience-design.html#post_comment"
                                                           target="_blank">精彩的文章，甚是精彩</a></p></div>
                        <h2><a href="4-super-experience-design.html" target="_blank"> <i class="icon-article"></i>
                                用4个经典的重量级产品案例，告诉你什么是标杆式体验设计</a></h2></div>
                    <div class="item">
                        <div class="meta">
                            <div class="meta-item"><span class="comment-avatar"><i class="thumb "
                                                                                   style="background-image:url(https://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIV4uaeIxKhnD4SwWurSicq1OSNsaYF2QLfpQBPXfcoRibKSwgEHXAvcN2qskYgxleKbrMhibvfgmiahg/132)"></i></span>
                                秦刻风
                            </div>
                            <span class="views">13638 人阅读</span></div>
                        <div class="comment-content"><p><a href="focus-color.html#post_comment" target="_blank">分析得太全面了，值得反复阅读并实践</a>
                            </p></div>
                        <h2><a href="focus-color.html" target="_blank"> <i class="icon-article"></i>
                                用一篇超强干货，帮你学会高手都在用的焦点配色法</a>
                        </h2></div>
                    <div class="item">
                        <div class="meta">
                            <div class="meta-item"><span class="comment-avatar"><i class="thumb "
                                                                                   style="background-image:url(https://image.uisdc.com/wp-content/uploads/2018/06/avatar-uisdc-chat.png)"></i></span>
                                蝙蝠侠
                            </div>
                            <span class="views">9252 人阅读</span></div>
                        <div class="comment-content"><p><a href="taobao-workplace-embarrassment.html#post_comment"
                                                           target="_blank">抖腿那个好魔性啊哈哈哈哈哈</a></p></div>
                        <h2><a href="taobao-workplace-embarrassment.html" target="_blank"> <i class="icon-article"></i>
                                有些职场尴尬瞬间，投胎都忘不掉</a></h2></div>
                    <div class="item">
                        <div class="meta">
                            <div class="meta-item"><span class="comment-avatar"><i class="thumb "
                                                                                   style="background-image:url(https://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83erVG2WAKibAFAg4587bKhiaYHyZqia1x8wibMLvY5kXGjnZvicUq4ZqbS89jibpsC7L6l2dp8ZkNbjnxsRA/132)"></i></span>
                                A0王鹏
                            </div>
                            <span class="views">22088 人阅读</span></div>
                        <div class="comment-content"><p><a href="lianhua-football-field.html#post_comment"
                                                           target="_blank">「中国改变了他，让他知道了文化如何融于建筑，如何更好地满足客户的欲望。」
                                    是真的会说话，哈哈哈……论如何评论甲方爸爸的审...</a></p></div>
                        <h2><a href="lianhua-football-field.html" target="_blank"> <i class="icon-article"></i>
                                引发热议的莲花足球场，竟然是知名设计团队的作品！</a></h2></div>
                    <div class="item">
                        <div class="meta">
                            <div class="meta-item"><span class="comment-avatar"><i class="thumb "
                                                                                   style="background-image:url(https://image.uisdc.com/wp-content/uploads/2018/06/avatar-uisdc-chat.png)"></i></span>
                                星爵 彼得 · 奎尔
                            </div>
                            <span class="views">16917 人阅读</span></div>
                        <div class="comment-content"><p><a href="make-design-more-meaningful.html#post_comment"
                                                           target="_blank">献上津津的膝盖，日常膜拜大神🤩</a></p></div>
                        <h2><a href="make-design-more-meaningful.html" target="_blank"> <i class="icon-article"></i>
                                平面高手出品！如何让你的设计变的更有内涵？</a></h2></div>
                </div>
            </section>
            <section class="widget widget-authors-hot hide_sm">
                <h2 class="section-title"> 专栏作者 <a href="uisdc-submit-specifications.html" target="_blank"
                                                   class="more">文章投稿</a>
                </h2>
                <div class="section-cont">
                    <ul class="authors-hot">
                        <li>
                            <div class="item">
                                <div class="author-avatar"><a href="author/sstt.html" target="_blank">
                                        <div class="avatar"
                                             style="background-image:url(https://image.uisdc.com/wp-content/uploads/2019/08/tuboshu-pic-2019.jpg);"></div>
                                    </a></div>
                                <div class="item-main"><h2><a href="author/sstt.html" target="_blank">土拨鼠</a></h2><h4><a
                                            href="author/sstt.html" target="_blank">文章 801 <i>|</i> 人气 13158048</a></h4>
                                    <h3><a href="text-layout.html" target="_blank"> <i class="icon-article"></i>
                                            创意广告中文字是如何运用的？来看平面高手的超多案例演示！ </a></h3></div>
                            </div>
                        </li>
                        <li>
                            <div class="item">
                                <div class="author-avatar"><a href="author/chenzimu7.html" target="_blank">
                                        <div class="avatar"
                                             style="background-image:url(https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTL5cyRVutbpBU3TnwnV3utlQfb2LhyDsAvsibM9jltdicnM65JrrLLrcflXLrYsKDapfdUTa1K0a7FA/132);"></div>
                                    </a></div>
                                <div class="item-main"><h2><a href="author/chenzimu7.html" target="_blank">陈子木 <i
                                                class="icon-medal-1" title="专栏作者"></i></a></h2><h4><a
                                            href="author/chenzimu7.html" target="_blank">文章 1186 <i>|</i> 人气
                                            25100935</a>
                                    </h4>
                                    <h3><a href="when-they-were-young.html" target="_blank"> <i
                                                class="icon-article"></i>
                                            25岁，当设计大师们还只是「后浪」的时候 </a></h3></div>
                            </div>
                        </li>
                        <li>
                            <div class="item">
                                <div class="author-avatar"><a href="author/soleildu.html" target="_blank">
                                        <div class="avatar"
                                             style="background-image:url(https://image.uisdc.com/wp-content/uploads/2020/04/xb-tx.jpg);"></div>
                                    </a></div>
                                <div class="item-main"><h2><a href="author/soleildu.html" target="_blank">soleildu <i
                                                class="icon-medal-1" title="专栏作者"></i></a></h2><h4><a
                                            href="author/soleildu.html" target="_blank">文章 28 <i>|</i> 人气 4326194</a>
                                    </h4>
                                    <h3><a href="top-fashion-magazine-fonts.html" target="_blank"> <i
                                                class="icon-article"></i> 你知道被《GQ》《VOGUE》等顶级时尚杂志所青睐的字体是什么吗？ </a></h3>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </section>
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
                                        <a href="/article/all" target="_blank">
                                            <i class="icon-allposts"></i>
                                            <h3>全部文章</h3>
                                            <h5>{{$sum}}篇</h5>
                                        </a>
                                    </div>
                                    <div class="item">
                                        <a href="/article/{{$item['mark_name']}}" target="_blank">
                                            <i class="icon-allposts"></i>
                                            <h3>{{$item['name']}}</h3>
                                            <h5>{{$item['column_articles_count']}}篇</h5>
                                        </a>
                                    </div>
                                    @foreach($item['children'] as $k => $val)
                                        <div class="item">
                                            <a href="/article/{{$val['mark_name']}}" target="_blank">
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
@stop
