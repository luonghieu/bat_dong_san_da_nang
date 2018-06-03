<!DOCTYPE html>

<html lang="vi-vn">

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Bất động sản Đà Nẵng</title>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="expires" content="0" />
	<meta name="resource-type" content="document" />
	<meta name="distribution" content="global" />
	<meta name="robots" content="index, follow" />
	<meta name="revisit-after" content="1 days" />
	<meta name="rating" content="general" />

	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
	<meta content="telephone=no" name="format-detection" />
	<meta name="google-site-verification" content="UaloeFcscXLZGXaWwUYRmqf614u1jszs2zufPLE8NTE" />

	<meta property="og:locale" content="vi_VN" />
	<meta property="og:type" content="article" />
	<meta property="og:site_name" content="Bất động sản Phố Son" />
	<meta property="article:tag" content="Bất động sản Phố Son" />   

	<link rel="shortcut icon" href="{!! asset('public_asset/images/logo2.png') !!}" type="image/x-icon"/>
	<link href="{!! asset('public_asset/css/owl.carousel.css') !!}" rel="stylesheet" type="text/css" />
	<link href="{!! asset('public_asset/font_awesome/css/font-awesome.css') !!}" rel="stylesheet" type="text/css" />
	<link href="{!! asset('public_asset/css/bootstrap.min.css') !!}" rel="stylesheet" type="text/css" />
	<link href="{!! asset('public_asset/css/nivo-slider.css') !!}" rel="stylesheet" type="text/css" />
	<link href="{!! asset('public_asset/css/phan_trang.css') !!}" rel="stylesheet" type="text/css" />
	<link href="{!! asset('public_asset/css/animation.css') !!}" rel="stylesheet" type="text/css" />
	<link href="{!! asset('public_asset/css/reset.css') !!}" rel="stylesheet" type="text/css" />

	<!-- css -->
	<link type="text/css" rel="stylesheet" href="{!! asset('public_asset/menureponsive/jquery.mmenu.all.css') !!}" />
	<link type="text/css" rel="stylesheet" href="{!! asset('public_asset/menureponsive/demo.css') !!}" />

	<link href="{!! asset('public_asset/css/common.css') !!}" rel="stylesheet" type="text/css" />
	<link href="{!! asset('public_asset/css/theme.min.css') !!}" rel="stylesheet" type="text/css" />
	<link href="{!! asset('public_asset/css/fix.min.css') !!}" rel="stylesheet" type="text/css" />
	
	<link href="{!! asset('public_asset/css/jquery-ui.min.css') !!}" rel="stylesheet" type="text/css" />
	<link href="{!! asset('public_asset/css/jquery.selectbox.css') !!}" rel="stylesheet" type="text/css" />

	<link href="{!! asset('public_asset/css/dataTables.bootstrap.min.css') !!}" rel="stylesheet" type="text/css" />
	
	<script src="{!! asset('public_asset/js/jquery.min.js') !!}"></script>
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-81113632-1', 'auto');
		ga('send', 'pageview');

	</script>
</head>	
<body>
	@include('public.inc.header')
	@include('public.inc.rightbar')
	@yield('slider')
	@yield('content')
	@include('public.inc.footer')