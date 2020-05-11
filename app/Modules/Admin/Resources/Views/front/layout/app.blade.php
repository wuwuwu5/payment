<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <meta name="renderer" content="webkit">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <title>优设网 - UISDC - 设计师交流学习平台 - 看设计文章，学软件教程，找灵感素材，尽在优设网！</title>
    <meta
        content="优设,优设网,优秀网页设计联盟,网页设计教程,PS教程,AI教程,设计文章,设计讲座,学设计,设计网站,设计平台,你丫才美工,獠麝鸡,网站模板,WebUI,GUI,ICON,PSD,笔刷,模板,字体设计,UISDC,SDC"
        name="keywords"/>
    <meta content="优设网-优秀设计联盟(SDC)，是国内优秀的设计师学习平台，拥有海量优质设计文章，包含了PS教程，AI教程，UI设计，网页设计，排版教程等。学设计，上优设！" name="description"/>
    <meta content='优设网' name='Author'/>
    @include("admin::front.layout.style")
    @stack('styles')
    <!--[if lt IE 9]>
    <script type="text/javascript">
        location.href = "https://www.uisdc.com/ie8/?re=https%3A%2F%2Fwww.uisdc.com%2F";
    </script>
    <![endif]-->
    <script type="text/javascript">
        var userAgent = navigator.userAgent; //取得浏览器的userAgent字符串
        var isIE = userAgent.indexOf("compatible") > -1 && userAgent.indexOf("MSIE") > -1; //判断是否IE<11浏览器
        var isIE11 = userAgent.indexOf('Trident') > -1 && userAgent.indexOf("rv:11.0") > -1;
        if (isIE) {
            document.write('<link rel="stylesheet" href="https://www.uisdc.com/wp-content/themes/U/ui/css/ie9.css?v=2.3.8" type="text/css" media="all" />');
        }
    </script>
    <script>
        var _hmt = _hmt || [];
        (function () {
            var hm = document.createElement("script");
            hm.src = "//hm.baidu.com/hm.js?7aeefdb15fe9aede961eee611c7e48a5";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
</head>
<body class="home blog">
@include("admin::front.layout.header")
@yield("content")
@include("admin::front.layout.footer")
@include("admin::front.layout.script")
@stack('scripts')
</body>
</html>
