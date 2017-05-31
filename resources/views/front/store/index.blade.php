@extends('layouts.front')
@section('title'){{$name}}-@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('front/css/slide.css')}}">
<style type="text/css">
/* 选项卡 */
body {
	font: 12px/20px Open Sans,微软雅黑, Helvetica, Arial, sans-serif;
	background:#F9F9F9;
	margin:0;
	padding:0;
	color:#555555;
	min-width:1000px
}
a {
	color:#111111;
	text-decoration:none;
	-webkit-transition:color 0.2s linear;
	-moz-transition:color 0.2s linear;
	-o-transition:color 0.2s linear;
	transition:color 0.2s linear
}
a:focus , a:link, a:active { outline:none}
a:hover { color:#F30}
ol, ul, li{	list-style: none}
*{margin:0;padding:0}
html,body { margin:0; padding:0; height:100%}
.table_card { width:100%; margin:0 auto;margin-top: 20px}
.table_card .tab { height:37px; font-size:14px; border-bottom:1px #e1e1e1 solid}
.table_card .tab li { float:left; height:36px; line-height:36px; padding:0 13px; margin-right:6px; background:#f0f0f0; border-top:1px #e1e1e1 solid; border-left:1px #e1e1e1 solid; border-right:1px #e1e1e1 solid;}
.table_card .tab li:last-child{margin-left: 5px;}
.table_card .tab li:hover { height:37px; background:#fff; color:#333; cursor:pointer}
.table_card .activ { height:37px !important; background:#fff !important; color:#333}
.table_card .tabCon { background:#fff; padding:15px; border-bottom:1px #e1e1e1 solid; border-left:1px #e1e1e1 solid; border-right:1px #e1e1e1 solid;}
.table_card .tabCon div { display:none}
.table_card .tabCon .on { display:block}

.newslist { font-size:14px; }
.newslist li { line-height:36px;}
.newslist .hover a{color:#F30;}
.newslist li .ding { color:#F30; margin-left:5px}
.newslist li .time { float:right; font-size:12px; color:#888}
</style>
@endsection
@section('content')
<div class="Modular">
	<div class="M1" style="margin-top:10px;">
		@include('front.share.crumb',['name'=>$name])
		<div class="warpbox">
			<!--# 选项卡 -->
			<div class="table_card">
				<ul class="tab">
					@foreach($storeList as $key=>$value)
					<li>{{$key}}</li>
					@endforeach
				</ul>
				<div class="tabCon">
					@foreach($storeList as $key =>$stores)
						<div>
							<ul class="newslist" data-id="{{$key}}">
								@foreach($stores as $store)
								<li><a href="{{url('store/'.$store['id'].'/'.$store['name'])}}" class="store_{{$store['id']}}"><span>【{{$store['name']}}】</span>{{$store['address']}}</a></li>
								@endforeach
							</ul>
						</div>
					@endforeach
				</div>
			</div>
			<!--#@ 选项卡 -->
		</div>
	</div>
	<div class="right">
		<!--优惠券-->
		<div class="special-book M1">
			<div class="hot-h2">
				<h2>
					<p>优惠券</p>
					<div class="more"><a href="{{url('coupon')}}">更多</a></div>
				</h2>
			</div>
			<div class="Coupon"><a href="{{url('coupon')}}"><img src="{{asset('front/img/4.png')}}" /></a></div>
		</div>
	</div>
	<div class="left">
		<!--折扣专区-->
		<div class="discount-book M1">
			<div class="hot-h2">
				<h2>
					<p>{{trans('front/system.sales')}}</p>
					<div class="more"><a href="{{URL::route('showcase',['type'=>'sales'])}}">更多</a></div>
				</h2>
			</div>
			<div class="productshow">
				<a class="dis-l abtn aleft" href="#left"><img src="{{asset('front/img/l_btn.png')}}" /></a>
				<a class="dis-r abtn aright" href="#right"><img src="{{asset('front/img/r_btn.png')}}" /></a>
				<div class="discount-list scrollcontainer">
					<ul>
						@foreach($sales['datas'] as $sale)
						<li>
							<div class="book">
								<i><img src="{{asset('front/img/sale.png')}}" /></i>
								<a href="{{url('goods/'.$sale['id'])}}"><img src="{{$sale['thumbUrl']}}" /></a>
								<a href="{{url('goods/'.$sale['id'])}}" class="tittle">{{$sale['name']}}</a>
							</div>
							<div class="info">
								<p class="price">￥{{$sale['price']}}<span>￥{{$sale['marketPrice']}}</span></p>
							</div>
						</li>
						@endforeach
						<div class="clear"></div>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="clear"></div>
@endsection
@section('js')
<script type="text/javascript" src="{{asset('vendors/Xslider/Xslider.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function(e) {
		$(".productshow").Xslider({
			unitdisplayed:3,
			numtoMove:1,
			autoscroll:2000,
			unitlen:180,
		});
		$(".tab li").click(function(){
			$(".tab li").eq($(this).index()).addClass("activ").siblings().removeClass("activ");
			$(".tabCon div").hide().eq($(this).index()).show();
		})
		$('.store_{{$storeId}}').parent().parent().parent().addClass('on');
		$('.store_{{$storeId}}').parent().addClass('hover');
		var area = $('.store_{{$storeId}}').parent().parent().attr('data-id');
		$(".tab li").each(function () {
	        if ($(this).text().indexOf(area) > -1) {
	          $(this).addClass('activ');
	        }
      	})
	});
</script>
@endsection