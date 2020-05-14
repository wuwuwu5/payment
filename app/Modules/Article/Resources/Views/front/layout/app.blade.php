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
    <title>{{cms_config_field('front_site', 'title')}}</title>
    <meta content="{{cms_config_field('front_site', 'keywords')}}" name="keywords"/>
    <meta content="{{cms_config_field('front_site', 'description')}}" name="description"/>
    <meta content='{{cms_config_field('front_site', 'author')}}' name='Author'/>
    <link rel="shortcut icon" href="{{render_cover(cms_config_field('front_site', 'icon'))}}" type="image/x-icon"/>
    @include("article::front.layout.style")
    <style>
        .header .logo-icon {
            padding-top: 36px;
            background-image: url('{{render_cover(cms_config_field('front_site', 'logo'))}}') !important;
            background-size: 50%;
        }

        .fixed-right {
            z-index: 9999;
        }
    </style>
    @stack('styles')
    <!--[if lt IE 9]>
    <script type="text/javascript">
        location.href = "/";
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
    {!!  cms_config_field('front_site', 'tongji') !!}
</head>
<body class="home blog">
@include("article::front.layout.header")
@yield("content")
@include("article::front.layout.footer")
@include("article::front.layout.script")
@stack('scripts')
</body>
</html>
