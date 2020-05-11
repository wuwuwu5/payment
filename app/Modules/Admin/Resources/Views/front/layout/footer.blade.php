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
                        <li><a href="/articles/{{$column['mark_name']}}" target="_blank">{{ $column['name'] }}</a></li>
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
                        <h3 class="cont">网站的网页栅格化设计有什么技巧？ </h3><h4>462位设计师围观了该问题 <span class="btn btn-orange-border">我来回答</span>
                        </h4></a></div>
                <div class="item"><a href="talk/121207369955.html" target="_blank"><h5><span class="user_avatar"><i
                                    class="thumb "
                                    style="background-image:url(https://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTK9Libibkcu8icV0MtRNbdWUF4eTDoXB2K3cVMicBjDdlTEs8poudibALtB2nWicL6Bgl6IeYogpEo2DwhA/132)"></i></span>
                            LEO 邀请你来回答 </h5>
                        <h3 class="cont">疫情影响，现在UI找工作还找得到吗？ </h3><h4>883位设计师围观了该问题 <span class="btn btn-orange-border">我来回答</span>
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
                <div class="item item_2"><a href="zt/career-planning.html" target="_blank"><span class="num"> 2 </span>
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
                <div class="item item_4"><a href="zt/design-trends.html" target="_blank"><span class="num"> 4 </span>
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
                    <h2><a href="focus-color.html" target="_blank"> <i class="icon-article"></i> 用一篇超强干货，帮你学会高手都在用的焦点配色法</a>
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
                    <div class="comment-content"><p><a href="lianhua-football-field.html#post_comment" target="_blank">「中国改变了他，让他知道了文化如何融于建筑，如何更好地满足客户的欲望。」
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
                                        href="author/chenzimu7.html" target="_blank">文章 1186 <i>|</i> 人气 25100935</a>
                                </h4>
                                <h3><a href="when-they-were-young.html" target="_blank"> <i class="icon-article"></i>
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
                                        href="author/soleildu.html" target="_blank">文章 28 <i>|</i> 人气 4326194</a></h4>
                                <h3><a href="top-fashion-magazine-fonts.html" target="_blank"> <i
                                            class="icon-article"></i> 你知道被《GQ》《VOGUE》等顶级时尚杂志所青睐的字体是什么吗？ </a></h3></div>
                        </div>
                    </li>
                </ul>
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
                <div class="item"><a href="zt.html" target="_blank"> <i class="num btn btn-default-border">1</i>
                        <strong>干货集合</strong> <i class="hot-icon"></i> </a></div>
                <div class="item"><a href="tag/%E7%BB%8F%E9%AA%8C%E5%88%86%E4%BA%AB.html" target="_blank"> <i
                            class="num btn btn-default-border">2</i> <strong>经验分享</strong> <span>4875篇</span> </a></div>
                <div class="item"><a href="tag/%E7%BD%91%E9%A1%B5%E8%AE%BE%E8%AE%A1.html" target="_blank"> <i
                            class="num btn btn-default-border">3</i> <strong>网页设计</strong> <span>922篇</span> </a></div>
                <div class="item"><a href="tag/ps%E6%95%99%E7%A8%8B.html" target="_blank"> <i
                            class="num btn btn-default-border">4</i> <strong>PS教程</strong> <span>773篇</span> </a></div>
                <div class="item"><a href="tag/%E7%94%A8%E6%88%B7%E4%BD%93%E9%AA%8C.html" target="_blank"> <i
                            class="num btn btn-default-border">5</i> <strong>用户体验</strong> <span>723篇</span> </a></div>
                <div class="item"><a href="tag/%E9%85%B7%E7%AB%99.html" target="_blank"> <i
                            class="num btn btn-default-border">6</i> <strong>酷站</strong> <span>647篇</span> </a></div>
                <div class="item"><a href="tag/ps%E6%8A%80%E5%B7%A7.html" target="_blank"> <i
                            class="num btn btn-default-border">7</i> <strong>ps技巧</strong> <span>636篇</span> </a></div>
                <div class="item"><a href="tag/%E8%AE%BE%E8%AE%A1%E5%B8%88%E8%81%8C%E5%9C%BA.html" target="_blank"> <i
                            class="num btn btn-default-border">8</i> <strong>设计师职场</strong> <span>611篇</span> </a></div>
                <div class="item"><a href="tag/ui%E8%AE%BE%E8%AE%A1.html" target="_blank"> <i
                            class="num btn btn-default-border">9</i> <strong>ui设计</strong> <span>594篇</span> </a></div>
                <div class="item"><a href="tag/%E4%BC%98%E7%A7%80%E7%BD%91%E9%A1%B5%E8%AE%BE%E8%AE%A1.html"
                                     target="_blank"> <i class="num btn btn-default-border">10</i>
                        <strong>优秀网页设计</strong> <span>585篇</span> </a></div>
                <div class="item"><a href="tag/%E4%BA%A4%E4%BA%92%E8%AE%BE%E8%AE%A1.html" target="_blank"> <i
                            class="num btn btn-default-border">11</i> <strong>交互设计</strong> <span>494篇</span> </a></div>
                <div class="item"><a href="tag/%E9%85%B7%E7%AB%99%E6%8E%A8%E8%8D%90.html" target="_blank"> <i
                            class="num btn btn-default-border">12</i> <strong>酷站推荐</strong> <span>332篇</span> </a></div>
                <div class="item"><a href="tag/%E8%81%8C%E5%9C%BA%E8%A7%84%E5%88%92.html" target="_blank"> <i
                            class="num btn btn-default-border">13</i> <strong>职场规划</strong> <span>322篇</span> </a></div>
                <div class="item"><a href="tag/%E5%AD%97%E4%BD%93%E8%AE%BE%E8%AE%A1.html" target="_blank"> <i
                            class="num btn btn-default-border">14</i> <strong>字体设计</strong> <span>298篇</span> </a></div>
                <div class="item"><a href="tag/app%E8%AE%BE%E8%AE%A1.html" target="_blank"> <i
                            class="num btn btn-default-border">15</i> <strong>App设计</strong> <span>260篇</span> </a>
                </div>
                <div class="item"><a href="tag/%E4%BA%A7%E5%93%81%E8%AE%BE%E8%AE%A1.html" target="_blank"> <i
                            class="num btn btn-default-border">16</i> <strong>产品设计</strong> <span>251篇</span> </a></div>
                <div class="item"><a href="tag/%E7%A5%9E%E5%99%A8%E6%8E%A8%E8%8D%90.html" target="_blank"> <i
                            class="num btn btn-default-border">17</i> <strong>神器推荐</strong> <span>241篇</span> </a></div>
                <div class="item"><a href="tag/%E5%B9%B3%E9%9D%A2%E8%AE%BE%E8%AE%A1.html" target="_blank"> <i
                            class="num btn btn-default-border">18</i> <strong>平面设计</strong> <span>218篇</span> </a></div>
                <div class="item"><a href="tag/icon.html" target="_blank"> <i class="num btn btn-default-border">19</i>
                        <strong>ICON</strong> <span>202篇</span> </a></div>
                <div class="item"><a href="tag/%E5%9B%BE%E6%A0%87%E8%AE%BE%E8%AE%A1.html" target="_blank"> <i
                            class="num btn btn-default-border">20</i> <strong>图标设计</strong> <span>183篇</span> </a></div>
                <div class="item"><a href="tag/%E7%94%A8%E6%88%B7%E4%BD%93%E9%AA%8C%E8%AE%BE%E8%AE%A1.html"
                                     target="_blank"> <i class="num btn btn-default-border">21</i>
                        <strong>用户体验设计</strong> <span>176篇</span> </a></div>
                <div class="item"><a href="tag/%E6%B5%B7%E6%8A%A5%E8%AE%BE%E8%AE%A1.html" target="_blank"> <i
                            class="num btn btn-default-border">22</i> <strong>海报设计</strong> <span>172篇</span> </a></div>
                <div class="item"><a href="tag/logo%E8%AE%BE%E8%AE%A1.html" target="_blank"> <i
                            class="num btn btn-default-border">23</i> <strong>logo设计</strong> <span>171篇</span> </a>
                </div>
                <div class="item"><a href="tag/%E5%8A%A8%E6%95%88%E8%AE%BE%E8%AE%A1.html" target="_blank"> <i
                            class="num btn btn-default-border">24</i> <strong>动效设计</strong> <span>164篇</span> </a></div>
            </div>
        </section>
    </div>
</div>
<div class="footer-fav">
    <div class="container">
        <div class="fl site-info">
            <h2><a href="about.html" target="_blank"> 优设网 uisdc.com </a></h2>
            <div class="site-p">
                <a href="about.html" target="_blank">
                    <p>2012年成立至今，是国内极具人气的设计师交流学习平台</p>
                    <p>看设计文章，学软件教程，找灵感素材，尽在优设网</p>
                </a>
            </div>
        </div>
        <div class="fr site-fav">
            <a href="#" class="btn btn-fav btn-orange"> <i class="icon-1-heart-border"></i> 按Ctrl+D收藏本站 </a></div>
        <div class="site-girl">
            <a href="https://uiiiuiii.com" target="_blank">
                <div class="girl fl"><i class="thumb "
                                        style="background-image:url(https://image.uisdc.com/wp-content/uploads/2019/10/ling.png)"></i>
                </div>
                <div class="girl-info hide_md">
                    <h4> 优设基础训练营 </h4>
                    <h4> @林雅诺 </h4>
                </div>
            </a>
        </div>
    </div>
</div>
<div class="footer-navi">
    <div class="container">
        <div class="about widget fl">
            <h2 class="title">关于我们</h2>
            <p>优设是国内极具人气的设计师平台，2012 年成立至今，一直专注于设计师的学习成长交流。
                我们通过优设网、优优教程网沉淀优质设计知识的同时，更率先试水新媒体领域。目前旗下媒体矩阵包括：微博@优秀网页设计、微信公众号@优秀网页设计、抖音号@优设PS大神、@优设AI大神等，全网粉丝量过千万。</p>
        </div>
        <div class="navis fl hide_sm">
            <div class="navi">
                <h2 class="title">热门频道</h2>
                <ul>
                    <li><a href="zt.html" target="_blank">文章专题</a></li>
                    <li><a href="talk.html" target="_blank">热门话题</a></li>
                    <li><a href="https://event.uisdc.com" target="_blank">设计大赛</a></li>
                    <li><a href="https://uiiiuiii.com" target="_blank">免费教程</a></li>
                    <li><a href="https://hao.uisdc.com" target="_blank">设计导航</a></li>
                    <li><a href="https://xue.uisdc.com" target="_blank">设计课程</a></li>
                </ul>
            </div>
            <div class="navi">
                <h2 class="title">设计灵感</h2>
                <ul>
                    <li><a href="https://uiiiuiii.com/inspirations/featured" target="_blank">主编推荐</a></li>
                    <li><a href="https://uiiiuiii.com/inspirations/banner" target="_blank">Banner设计</a></li>
                    <li><a href="https://uiiiuiii.com/inspirations/poster" target="_blank">海报设计</a></li>
                    <li><a href="https://uiiiuiii.com/inspirations/logo" target="_blank">Logo设计</a></li>
                    <li><a href="https://uiiiuiii.com/inspirations/illustrations" target="_blank">插画绘画</a></li>
                    <li><a href="https://uiiiuiii.com/inspirations/fontdesign" target="_blank">字体设计</a></li>
                </ul>
            </div>
            <div class="navi">
                <h2 class="title">支持与服务</h2>
                <ul>
                    <li><a href="contact.html" target="_blank">联系我们</a></li>
                    <li><a href="about.html" target="_blank">广告投放</a></li>
                    <li><a href="about.html" target="_blank">入驻优创</a></li>
                    <li><a href="uisdc-submit-specifications.html" target="_blank">作者投稿</a></li>
                    <li><a href="friendlink.html" target="_blank">友链申请</a></li>
                    <li><a href="https://wpa.qq.com/msgrd?v=3&amp;uin=2650232288&amp;site=qq&amp;menu=yes"
                           target="_blank">意见反馈</a></li>
                </ul>
            </div>
        </div>
        <div class="ewms widget fr hide_sm">
            <ul class="clearfix">
                <li>
                    <div class="ico">
                        <i class="icon-sina"></i>
                        <h4>优设微博</h4>
                    </div>
                    <div class="ewm-content hide ewm-weibo">
                        <div class="ewm-main clearfix">
                            <div class="items">
                                <div class="item"><a href="https://weibo.com/uidesign" target="_blank"><span
                                            class="item-ico">@</span>
                                        <h2>优秀网页设计</h2><h4>380W粉丝！每日更新设计干货</h4></a></div>
                                <div class="item"><a href="https://weibo.com/uisdc2012" target="_blank"><span
                                            class="item-ico">@</span>
                                        <h2>优设</h2><h4>强烈推荐！优设官方品牌微博</h4></a></div>
                                <div class="item"><a href="https://weibo.com/uiiiuiii" target="_blank"><span
                                            class="item-ico">@</span>
                                        <h2>优优教程网 </h2><h4>官方微博，海量教程看不完</h4></a></div>
                                <div class="item"><a href="https://weibo.com/uisdcjichuying" target="_blank"><span
                                            class="item-ico">@</span>
                                        <h2>优设基础训练营</h2><h4>零基础入门，带你成为软件高手</h4></a></div>
                            </div>
                        </div>
                </li>
                <li>
                    <div class="ico">
                        <i class="icon-douyin"></i>
                        <h4>优设抖音</h4>
                    </div>
                    <div class="ewm-content hide ewm-douyin">
                        <div class="ewm-main clearfix">
                            <div class="ewm-douyin-1 fl">
                                <div class="thumb-div"><i class="thumb"
                                                          style="background-image:url(https://image.uisdc.com/wp-content/uploads/2019/10/douyin_ps.jpg);"></i>
                                </div>
                                <h4>优设PS大神</h4>
                                <h5>抖音号：UISDCPS</h5>
                            </div>
                            <div class="ewm-douyin-2 fr">
                                <div class="thumb-div"><i class="thumb"
                                                          style="background-image:url(https://image.uisdc.com/wp-content/uploads/2019/10/douyin-ai.jpg);"></i>
                                </div>
                                <h4>优设AI大神</h4>
                                <h5>抖音号：UISDCAI</h5>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="ico">
                        <i class="icon-wechat"></i>
                        <h4>优设微信</h4>
                    </div>
                    <div class="ewm-content hide ewm-wechat">
                        <div class="ewm-main clearfix">
                            <div class="thumb-div fl"><i class="thumb"
                                                         style="background-image:url(https://image.uisdc.com/wp-content/uploads/2019/01/wechat.png);"></i>
                            </div>
                            <h4>每天官微五分钟</h4>
                            <h4>一年萌新变大神</h4>
                            <h4><span> <i class="icon-wechat-1"></i> 扫码关注 </span></h4>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="like">
                <strong>1000W</strong>
                <h3>优设新媒体矩阵等你来关注</h3>
            </div>
        </div>
    </div>
    <div class="container container-bq">
        <div class="bands">
            <ul>
                <li><a href="index.html" class="thumb band band-uisdc" target="_blank"> <span class="hidden">优设</span>
                    </a></li>
                <li><a href="https://uiiiuiii.com" class="thumb band band-uiii" target="_blank"> <span class="hidden">优优教程网</span>
                    </a></li>
                <li><a href="https://xue.uisdc.com" class="thumb band band-uisdc-xue" target="_blank"> <span
                            class="hidden">优设大课堂</span> </a></li>
                <li><a href="https://hao.uisdc.com" class="thumb band band-uisdc-hao" target="_blank"> <span
                            class="hidden">设计师导航</span> </a></li>
                <li><a href="hunters.html" class="thumb band band-uisdc-hunter" target="_blank"> <span class="hidden">细节猎人</span>
                    </a></li>
                <li><a href="https://weibo.com/uisdcjichuying" class="thumb band band-uisdc-basic" target="_blank">
                        <span class="hidden">优设训练营</span> </a></li>
            </ul>
        </div>
        <div class="qqgroup fr hide_sm">
            <a href="#"> <i class="icon-QQ"></i> 优设官方QQ群在此 </a>
        </div>
    </div>
</div>
<div class="footer">
    <div class="footer-colors"></div>
    <div class="footer-colors colors-shadow"></div>
    <div class="container">
        <div class="friendlinks hide_sm"><h6>友情链接：</h6>
            <ul class="friendlinks-ul">
                <li><a href="friendlink.html" title="申请优设友链" target="_blank">申请优设友链</a></li>
                <li><a href="http://www.hao123.com/" title="hao123上网导航" target="_blank">hao123上网导航</a></li>
                <li><a href="https://hao.uisdc.com/" title="设计师网址导航为优秀网页设计联盟（SDC）旗下最实用、最专业、最全面、最好用的设计师导航！"
                       target="_blank">设计师网址导航</a></li>
                <li><a href="index.html" rel="nofollow" title="psd素材" target="_blank">psd素材</a></li>
                <li><a href="https://uiiiuiii.com/" title="优优教程" target="_blank">优优教程</a></li>
                <li><a href="http://cdc.tencent.com/" title="腾讯CDC" target="_blank">腾讯CDC</a></li>
                <li><a href="https://hao.uisdc.com/" title="设计导航" target="_blank">设计导航</a></li>
                <li><a href="https://hao.uisdc.com/" title="优设导航" target="_blank">优设导航</a></li>
                <li><a href="https://www.vcg.com/" title="图片素材" target="_blank">图片素材</a></li>
                <li><a href="https://xue.uisdc.com/" title="UI设计培训" target="_blank">UI设计培训</a></li>
                <li><a href="http://www.redocn.com/" title="中国创意设计展示媒体_设计作品_设计大赛_设计招聘_设计资讯！" target="_blank">红动中国设计网</a>
                </li>
                <li><a href="index.html" title="模版" target="_blank">网页模板</a></li>
                <li><a href="http://hao.360.cn/" title="360安全网址导航" target="_blank">360安全网址导航</a></li>
                <li><a href="index.html" title="优设网" target="_blank">优设</a></li>
                <li><a href="https://www.chuangkit.com/" title="创客贴_在线平面设计工具" target="_blank">在线设计</a></li>
                <li><a href="http://www.lizus.com/" title="专业定制Wordpress主题,企业/工作室/个人站点"
                       target="_blank">WordPress主题定制</a></li>
                <li><a href="http://nav80.com/" title="Nav80设计师网址导航" target="_blank">Nav80网址导航</a></li>
                <li><a href="index.html" title="网页设计" target="_blank">网页设计</a></li>
                <li><a href="http://www.visionunion.com/" rel="nofollow" title="视觉同盟" target="_blank">视觉同盟</a></li>
                <li><a href="https://mux.alimama.com/" title="阿里营销用户体验中心" target="_blank">阿里M2UX</a></li>
                <li><a href="http://www.iconfont.cn/" target="_blank">iconfont</a></li>
                <li><a href="http://www.shejidaren.com/" title="谈谈网页设计、用户体验，聊聊前端开发，分享高质量设计资源和灵感，爱设计，爱分享"
                       target="_blank">设计达人</a></li>
                <li><a href="http://tgideas.qq.com/" title="腾讯游戏的专业设计团队" target="_blank">腾讯TGideas</a></li>
                <li><a href="http://pcedu.pconline.com.cn/sj/" target="_blank">PConline创意设计</a></li>
                <li><a href="https://uiiiuiii.com/" title="uiiiuiii" target="_blank">uiiiuiii</a></li>
                <li><a href="https://uiiiuiii.com/" title="优优网" target="_blank">优优网</a></li>
                <li><a href="https://uiiiuiii.com/" title="U站" target="_blank">U站</a></li>
                <li><a href="https://uiiiuiii.com/inspiration" title="优优网" target="_blank">灵感网站</a></li>
                <li><a href="https://uiiiuiii.com/software/5103.html" title="ps下载" target="_blank">ps下载</a></li>
                <li><a href="https://www.veer.com/" title="正版图片" target="_blank">正版图片</a></li>
                <li><a href="https://uiiiuiii.com/cinema4d/12121658.html" title="c4d教程" target="_blank">c4d教程</a></li>
                <li><a href="https://uiiiuiii.com/" title="c4d教程" target="_blank">免费软件教程</a></li>
            </ul>
        </div>
        <div class="copyright">
            <p>
                <i class="asline"> Copyright &copy; 2020 <strong> <a class="site-link" href="index.html"
                                                                     title="优设-UISDC"
                                                                     rel="home"><span>优设-UISDC</span></a></strong> </i>
                <i class="asline hide_sm">- 优设网官方微信号：youshege - </i>
                <i class="asline hide_sm"> <a target="_blank" href="http://www.beian.miit.gov.cn">鄂ICP备16005435号-1 </a>
                    <a href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=42018502001134"> 鄂公网安备
                        42018502001134号 </a> </i>
            </p>
        </div>
    </div>
</div>
<div class="fixed-right">
    <div class="menus">
        <span class="item hide_sm"> <a href="https://wpa.qq.com/msgrd?v=3&amp;uin=2650232288&amp;site=qq&amp;menu=yes"
                                       target="_blank"> <i class="icon-comme"></i> </a> </span>
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
