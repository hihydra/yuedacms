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
					<a class="left"><img src="{{asset('front/img/icon_Qzone.png')}}" /></a>
					<div class="left">
						<span>QQ空间</span>
						<div class="info-c"><a class="btn_red" target="_blank" href="https://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url={{url('/')}}&title={{$settings['title']}}">立刻分享</a></div>
					</div>
				</li>
				<li>
					<a class="left"><img src="{{asset('front/img/social-qq.png')}}" /></a>
					<span>QQ好友</span>
					<div class="info-c"><a class="btn_red" target="_blank" href="http://connect.qq.com/widget/shareqq/index.html?url={{url('/')}}&title={{$settings['title']}}">立刻分享</a></div>
				</li>
				<li>
					<a class="left"><img src="{{asset('front/img/social-weibo.png')}}" /></a>
					<span>新浪微博</span>
					<div class="info-c"><a class="btn_red" target="_blank" href="http://service.weibo.com/share/share.php?url={{url('/')}}&title={{$settings['title']}}">立刻分享</a></div>
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
