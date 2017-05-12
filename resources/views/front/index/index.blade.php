@extends('layouts.front')
@section('css')
<style type="text/css" src="{{asset('vendors/flexslider/flexslider.css')}}"></style>
<style type="text/css">
	.productshow{
		padding:4px 0;
		margin:10px auto;
		position:relative;
		text-align:center;
		font-family:微软雅黑, 黑体;
	}
	.productshow .discount-list{
		width:710px;
		height:217px;
		overflow:hidden;
		position:relative;
		margin:0 auto;
	}
	.productshow .discount-list ul{
		width:20000px;
		position:absolute;
		left:0px;
		top:0px;
	}
	.productshow .discount-list li{
		float:left;
		text-align:center;
	}
	.productshow .discount-list li.last{
		background:none;
	}
	.productshow .discount-list li div{
		overflow:hidden;
		text-align:center;
	}
	.productshow .discount-list a:hover img{
		filter:alpha(opacity=86);-moz-opacity:0.86;opacity:0.86;
	}
	.productshow .discount-list li p{
		margin:0;
		line-height:32px;
	}
</style>
@endsection
@section('content')
<!--bannar-->
<div class="bannar" >
	<div class="bannar-img flexslider">
		<ul class="slides">
			<li><img src="{{asset('front/img/bannar.jpg')}}" /></li>
			<li><img src="{{asset('front/img/bannar.jpg')}}" /></li>
			<li><img src="{{asset('front/img/bannar.jpg')}}" /></li>
		</ul>
	</div>
</div>
<div class="Modular">
	<div class="right">
		<!--专题-->
		<div class="special-book M1">
			<div class="hot-h2">
				<h2>
					<p>{{trans('front/system.special')}}</p>
					<div class="more"><a href="{{URL::route('showcase',['type'=>'special','storeId'=>$storeId])}}">更多</a></div>
				</h2>
			</div>
			<div class="special-list">
				<ul>
					@foreach($special as $key=>$spe)
					@php if($key>2){break;} @endphp
					<li>
						<div class="book">
							<a href="{{URL::route('showcase',['type'=>'special','storeId'=>$storeId,'specialId'=>$spe['id']])}}"><img src="{{$spe['thumbUrl']}}" /></a>
						</div>
						<div class="info">
							<div class="wrap">
								<p class="desc">{{$spe['name']}}</p>
								<p class="author"><img src="{{asset('front/img/u78.png')}}" />{{$spe['likecount']}}</p>
							</div>
						</div>
					</li>
					@endforeach
				</ul>
				<div class="clear"></div>
			</div>
		</div>
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
		<!--书店推荐-->
		<div class="hot-book M1">
			<div class="hot-h2">
				<h2>
					<p>{{trans('front/system.recommend')}}</p>
					<div class="more"><a href="{{URL::route('showcase',['type'=>'recommend','storeId'=>$storeId])}}">更多</a></div>
				</h2>
			</div>
			<div class="hot-list">
				<ul>
					@foreach($storeRecommend as $key=>$recommend)
					@php if($key>3){break;} @endphp
					<li>
						<div class="book">
							<a href="#"><img src="{{$recommend['thumbUrl']}}" /></a>
						</div>
						<div class="info">
							<div class="wrap">
								<a class="tittle" href="#">{{$recommend['name']}}</a>
								<p class="author">{{$recommend['author']}}</p>
								<p class="desc">{{$recommend['desc']}}</p>
							</div>
							<a class="li-btn" href="#">立即阅读</a>
						</div>
					</li>
					@endforeach
				</ul>
				<div class="clear"></div>
			</div>
		</div>
		<!--折扣专区-->
		<div class="discount-book M1">
			<div class="hot-h2">
				<h2>
					<p>{{trans('front/system.sales')}}</p>
					<div class="more"><a href="{{URL::route('showcase',['type'=>'sales','storeId'=>$storeId])}}">更多</a></div>
				</h2>
			</div>
			<div class="productshow">
				<a class="dis-l abtn aleft" href="#left"><img src="{{asset('front/img/l_btn.png')}}" /></a>
          		<a class="dis-r abtn aright" href="#right"><img src="{{asset('front/img/r_btn.png')}}" /></a>
				<div class="discount-list scrollcontainer">
					<ul>
						@foreach($sales as $sale)
						<li>
							<div class="book">
								<i><img src="{{asset('front/img/sale.png')}}" /></i>
								<a href="#"><img src="{{$sale['thumbUrl']}}" /></a>
								<a href="#" class="tittle">{{$sale['name']}}</a>
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
<script type="text/javascript" src="{{asset('vendors/flexslider/jquery.flexslider-min.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/Xslider/Xslider.js')}}"></script>
<script type="text/javascript">
	$(function(){
		$(".flexslider").flexslider({
		});
		$(".productshow").Xslider({
			unitdisplayed:3,
			numtoMove:1,
			autoscroll:2000,
			unitlen:180,
		});
	});
</script>
@endsection
