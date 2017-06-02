<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>@yield('title'){{$settings['title']}}</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="{{asset('front/css/css.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{asset('front/css/login.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{asset('front/css/style.css') }}" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="{{asset('vendors/jquery/jquery-2.1.1.js')}}"></script>
	<script type="text/javascript" src="{{asset('front/js/utils.js') }}"></script>
	@yield('css')
</head>
<body>
	<div class="dev-header">
		<div class="wrapper">
			<h1 class="dev-logo"><a class="hidspan" href="{{url('/')}}"><img src="{{asset('front/img/logo.png') }}" /></a></h1>
			<div id="_dhn_" class="dh-nav">
				<div class="dhnl-personal-info" style="padding-right:10px; padding-top:3px;">
					<a href="{{url('/')}}"><img src="{{asset('front/img/home.png') }}" /></a>
				</div>
			</div>
		</div>
	</div>

	<div class="Clear" ></div>

	@yield('content')

	<div class="clear"></div>
	<div class="foot Full-screen foot-1">
		<div class="foot-list">
			<div class="foot-ul">
				<a href="#">关于我们</a><span>|</span>
				<a href="#">联系我们</a><span>|</span>
				<a href="#">商务合作</a><span>|</span>
				<a href="#">我的智慧书店</a>
			</div>
			<div class="foot-ul">
				<span>客服电话：{{$settings['contact_us']}}</span>
				<span>客服邮箱：{{$settings['contact_email']}}</span>
			</div>
			<div class="foot-ul">
				<span>{{$settings['copyright']}}</span>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="{{asset('vendors/layer/layer.js')}}"></script>
 @yield('js')
</body>
</html>
