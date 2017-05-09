<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
@section('meta')
<title>{{$settings['title']}}</title>
<meta name="keywords" content="{{$settings['keywords']}}" />
<meta name="description" content="{{$settings['description']}}">
<meta name="author" content="{{$settings['author']}}">
@show
<link href="{{asset('front/css/css.css') }}" rel="stylesheet" type="text/css"/>
@yield('css')
</head>

<body>
<!--   top开始   -->
<div class="top">
  <div class="top-center">
    <!--logo-->
    <div class="logo">
      <a href="{{url('/')}}"><img src="{{$settings['logo']}}" /></a>
    </div>
    <!--导航-->
    <div class="nav">
      <ul>
        <li class="hover"><a href="{{url('/')}}">首页</a></li>
        <li><a href="{{url('category')}}">分类</a></li>
        <li><a href="{{url('topical')}}">主题广场</a></li>
        <li><a href="#">福利中心</a></li>
      </ul>
    </div>
    <!--搜索框-->
    <div class="search">
      <div class="s-bg">
        <div class="s-btn right">
          <input class="s-seek" value="" type="button" />
        </div>
        <div class="s-input left">
          <input type="text" placeholder="请输入搜索内容" />
        </div>
      </div>
    </div>
    <!--登录注册、门店、下载-->
    <div class="use">
      <div class="s-a s-store">
        <span>&nbsp;</span>
        <a href="#">选择门店</a>
      </div>
      <div class="s-a s-dwon">
        <span>&nbsp;</span>
        <a href="#">下载APP</a>
      </div>
      <div class="unlogin">
        <a href="#">登录</a>|<a href="#">注册</a>
      </div>
      <div class="s-a s-buy">
        <span>&nbsp;</span>
        <a href="#">购物车<lable>0</label></a>
      </div>
    </div>
  </div>
</div>
<!--   top结束   -->
<div class="Full-screen">
<div class="clear" style="height:80px;"></div>
<!--   main开始   -->
<div class="main">
@yield('content')
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
<div class="foot Full-screen">
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
<!--   main结束   -->
<script type="text/javascript" src="http://edu.fezo.com.cn:8105/front/default/js/jquery.js"></script>
@yield('js')
</body>
</html>
