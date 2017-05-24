<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>@yield('title'){{$settings['title']}}</title>
  <meta name="keywords" content="{{$settings['keywords']}}" />
  <meta name="description" content="{{$settings['description']}}">
  <meta name="author" content="{{$settings['author']}}">
  <link href="{{asset('front/css/css.css') }}" rel="stylesheet" type="text/css"/>
  <link href="{{asset('front/css/style.css') }}" rel="stylesheet" type="text/css"/>
  <script type="text/javascript" src="{{asset('vendors/jquery/jquery-2.1.1.js')}}"></script>
  @yield('css')
</head>
@php
$storeId = getStoreId();
@endphp
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
          <li><a href="{{url('/')}}">首页</a></li>
          <li><a href="{{url('category')}}">分类</a></li>
          <li><a href="{{url('topical')}}">主题广场</a></li>
          <li><a href="{{url('coupon')}}">福利中心</a></li>
        </ul>
      </div>
      <!--搜索框-->
      <div class="search">
        <form action="{{url('category')}}" method="get">
        <div class="s-bg">
          <div class="s-btn right">
            <input class="s-seek"  type="button" />
          </div>
          <div class="s-input left">
            <input type="text" placeholder="请输入搜索内容" name="keyword" value=""/>
          </div>
        </div>
        </form>
      </div>
      <!--登录注册、门店、下载-->
      <div class="use">
        <div class="s-a s-store">
          <span>&nbsp;</span>
          <a href="{{url('store')}}">{{getStoreName()}}</a>
        </div>
        <div class="s-a s-dwon">
          <span>&nbsp;</span>
          <a href="#">下载APP</a>
        </div>
        @if($userInfo)
        <div class="inlogin">
          <div class="top-menu">
            <a href="#">
              <p>{{{$userInfo['nickname'] or ''}}}</p>
              <b class="t"></b>
            </a>
          </div>
          <div class="cnt" style="display: none;">
            <ul class="cnt-ul">
              <li>
                <a href="{{url('order')}}">我的书店</a>
              </li>
              <li><a href="{{url('user/collection')}}">我的收藏</a></li>
              <li><a href="{{url('user/myCoupons')}}">我的礼券</a></li>
              <li><a href="{{url('user')}}">个人设置</a></li>
              <li><a href="{{url('user/address')}}">收货地址</a></li>
              <li><a href="{{url('user/share')}}">分享应用</a></li>
              <li><a href="{{url('user/suggest')}}">意见反馈</a></li>
              <li><a href="#">关于</a></li>
              <li><a href="{{url('login_out')}}">退出</a></li>
            </ul>
          </div>
        </div>
        @else
        <div class="unlogin">
          <a href="{{url('login')}}">登录</a>|<a href="{{url('register')}}">注册</a>
        </div>
        @endif
        <div class="s-a s-buy">
          <span>&nbsp;</span>
          <a href="{{url('cart')}}">购物车<lable>{{$userInfo['cartCount']}}</label></a>
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
  <script type="text/javascript" src="{{asset('vendors/layer/layer.js')}}"></script>
  <script type="text/javascript" src="{{asset('front/js/utils.js') }}"></script>
  <script type="text/javascript">
    @php
    $cate = app('request')->segment(1);
    @endphp
    $(document).ready(function(){
      var urlstr =  "{{$cate}}";
      var urlstatus = false;
      $(".nav a").each(function () {
        if ($(this).attr('href').indexOf(urlstr) > -1 && urlstr !='' ) {
          $(this).parent().addClass('hover'); urlstatus = true;
        }
      })
      if (!urlstatus) {$(".nav a").eq(0).parent().addClass('hover'); }

      $(".inlogin").mouseover(function () {
          $(".cnt").show("fast");
      });
      $(".inlogin").mouseleave(function () {
          $(".cnt").hide("fast");
      });
    });
  </script>
  @yield('js')
</body>
</html>
