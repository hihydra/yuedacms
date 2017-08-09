@extends('layouts.front')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('front/css/slide.css')}}">
@endsection
@section('content')
<!--bannar-->
<div class="bannar" >
	<div class="bannar-img flexslider">
		<ul class="slides">
			@foreach($adv as $ad)
				@if(!empty($ad['url']))
				<li><a href="{{{$ad['url'] or ''}}}" target="_blade"><img src="{{$ad['thumbUrl']}}"/></a></li>
				@else
				<li><a href="{{url('goods/'.$ad['targetId'])}}" target="_blade"><img src="{{$ad['thumbUrl']}}"/></a></li>
				@endif
			@endforeach
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
					<div class="more"><a href="{{URL::route('showcase',['type'=>'special'])}}">更多</a></div>
				</h2>
			</div>
			<div class="special-list">
				<ul>
					@foreach($special as $key=>$spe)
					@php if($key>2){break;} @endphp
					<li>
						<div class="book">
							<a href="{{URL::route('showcase',['type'=>'specialDetail','specialId'=>$spe['id']])}}"><img src="{{$spe['thumbUrl']}}" /></a>
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
					<div class="more"><a href="{{URL::route('showcase',['type'=>'recommend'])}}">更多</a></div>
				</h2>
			</div>
			<div class="hot-list">
				<ul>
					@foreach($storeRecommend as $key=>$recommend)
					@php if($key>3){break;} @endphp
					<li>
						<div class="book">
							<a href="{{url('goods/'.$recommend['id'])}}"><img src="{{$recommend['thumbUrl']}}" /></a>
						</div>
						<div class="info">
							<div class="wrap">
								<a class="tittle" href="{{url('goods/'.$recommend['id'])}}">{{$recommend['name']}}</a>
								<p class="author">{{$recommend['author']}}</p>
								<p class="desc">{{$recommend['desc']}}</p>
							</div>
							<a class="li-btn" href="{{url('goods/'.$recommend['id'])}}">立即阅读</a>
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
					<div class="more"><a href="{{URL::route('showcase',['type'=>'sales'])}}">更多</a></div>
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
@if(!$links->isEmpty())
<div class="f_link">
    <dl>
        <dt>友情链接</dt>
        @foreach($links as $link)
        <dd><a href="{{$link['url']}}" target="_blank">{{$link['name']}}</a></dd>
        @endforeach
    </dl>
</div>
<div class="clear"></div>
@endif
@endsection
@section('js')
<script type="text/javascript" src="{{asset('vendors/unslider/unslider.min.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/Xslider/Xslider.js')}}"></script>
<script type="text/javascript">
	$(function(){
		$('.bannar-img').unslider({
			dots: true,
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
