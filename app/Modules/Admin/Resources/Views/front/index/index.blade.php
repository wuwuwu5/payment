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
                            <li><a href="{{ route('articles.column.show', ['type' => $column['mark_name']]) }}"
                                   target="_blank">{{ $column['name'] }}</a>
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
                <a href="{{ route('articles.column.show', ['type' => 'all']) }}" class="btn btn-orange">查看全部文章</a>
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
        </div>
    </div>

    <div class="footer-post-sets hide_sm">
        <div class="container">
            <section class="post-sets">
                <div class="section-title">
                    热门文章集合
                </div>
                <div class="section-content">
                    @foreach($tags as $k => $tag)
                        <div class="item">
                            <a href="{{route('tags.show', ['tag' => $tag['tag']['hash_id'] ?? ''])}}" target="_blank">
                                @if($k <= 3)
                                    <i class="num btn btn-default-border">{{$k+1}}</i>
                                @endif
                                <strong>{{$tag['tag']['nickname'] ?? ''}}</strong> <i class="hot-icon"></i>
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
@stop
