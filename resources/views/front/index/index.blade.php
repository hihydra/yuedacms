@extends('layouts.front')
@section('content')
<!--bannar-->
<div class="bannar">
	<div class="bannar-img"><img src="{{asset('front/img/bannar.jpg')}}" /></div>
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
			<div class="discount-list sliderT">
				<a class="dis-l sliderBtn prev"><img src="{{asset('front/img/l_btn.png')}}" /></a>
				<a class="dis-r sliderBtn next"><img src="{{asset('front/img/r_btn.png')}}" /></a>
				<div class="sliderPicWrap">
					<ul class='sliderPic'>
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
<script type="text/javascript">
	function sliderT(selector){
		$(selector).each(function(){
			var slider = $(this),
			ul = slider.find('.sliderPic'),
			li = ul.children(),
			prev = slider.find('.sliderBtn.prev'),
			next = slider.find('.sliderBtn.next'),
			w = li.outerWidth(true),
			len = li.size(),
			index = 0,
			tag = true,
			timer = null;
			ul.width(w*len);
			var wrap = slider.find('.sliderPicWrap');
			w = wrap.width();
			len = Math.ceil(ul.width()/wrap.width());
			if(len<=1){
				slider.find('.sliderBtn').hide();
				return;
			};
			prev.bind('click',function(){
				slide('prev');
			});
			next.bind('click',function(){
				slide('next');
			});
			timer = setInterval(function(){slide('next');},5000);
			slider.hover(function(){
				clearInterval(timer);
			},function(){
				timer = setInterval(function(){slide('next');},5000);
			});
			function slide(dir){
				if(tag == true){
					tag = false;
					if(dir == "prev"){
						index--;
					}else if(dir == "next"){
						index++;
					};
					if(index<0){
						index = len-1;
					}else if(index>len-1){
						index = 0;
					};
					ul.animate({left:-index*w},400,function(){tag = true;});
				};
			}
		});
	};
	sliderT('.sliderT');
</script>
@endsection
