@extends('layouts.front')
@section('css')
@endsection
@section('content')
@include('front.share.leftSidebar')
<div class="M2" style="margin-top:10px; width:928px;">
	@include('front.share.crumb',['name'=>$name])
	<div class="fl-main">
		<div style="width:930px; margin:10px 0 10px 0;">
			<ul class="pay-ul-1">
				<li>
					<a class="left" href="#"><img src="{{asset('front/img/icon_Qzone.png')}}" /></a>
					<div class="left">
						<span>QQ空间</span>
						<div class="info-c"><a class="btn_red" href="#">立刻分享</a></div>
					</div>
				</li>
				<li>
					<a class="left" href="#"><img src="{{asset('front/img/social-wechat.png')}}" /></a>
					<span>微信好友</span>
					<div class="info-c"><a class="btn_red" href="#">立刻分享</a></div>
				</li>
				<li>
					<a class="left" href="#"><img src="{{asset('front/img/social-pengyou.png')}}" /></a>
					<span>微信朋友圈</span>
					<div class="info-c"><a class="btn_red" href="#">立刻分享</a></div>
				</li>
				<li>
					<a class="left" href="#"><img src="{{asset('front/img/social-qq.png')}}" /></a>
					<span>QQ好友</span>
					<div class="info-c"><a class="btn_red" href="#">立刻分享</a></div>
				</li>
				<li>
					<a class="left" href="#"><img src="{{asset('front/img/social-weibo.png')}}" /></a>
					<span>新浪微博</span>
					<div class="info-c"><a class="btn_red" href="#">立刻分享</a></div>
				</li>
				<li>
					<a class="left" href="#"><img src="{{asset('front/img/more.png')}}" /></a>
					<span>更多</span>
					<div class="info-c"><a class="btn_red" href="#">立刻分享</a></div>
				</li>
			</ul>
			<div class="clear"></div>
		</div>
	</div>
	<div class="clear"></div>
</div>
<div class="clear"></div>
@endsection
@section('js')
@endsection
