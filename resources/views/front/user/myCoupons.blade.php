@extends('layouts.front')
@section('css')
<style type="text/css">
.quan-item{width: 320px;margin: 2px 12px 15px 40px;}
</style>
@endsection
@section('content')
@include('front.share.leftSidebar')
<div class="M2" style="margin-top:10px; width:928px;">
	@include('front.share.crumb',['name'=>$name])
	<div class="fl-main">
		<div class="book-select" style="margin-top:0;">
			<div class="bs-info">
				<ul class="bs-ul" style="margin-top:0;">
					<li>
					<a href="{{url('user/myCoupons')}}" class="smooth">{{trans('front/system.myCoupons')}}</a>
						<b></b>
					</li>
					<li>
						<a href="{{URL::route('user.myCoupons',['status'=>'STATUS_EXPIRE'])}}" class="smooth">{{trans('front/system.expireCoupons')}}</a>
						<b></b>
					</li>
					<div class="clear"></div>
				</ul>
			</div>
		</div>
		<div style="width:930px; margin:10px 0 10px 0;">
			<div class="quan-list
				@if($status =='STATUS_EXPIRE')
				quan-gray-item
				@endif">
				@foreach($coupons['datas'] as $coupon)
				<div class="quan-item">
					<div class="q-type">
						<div class="q-price">
							@if($coupon['type'] == 'TYPE_CASH')
							<em>￥</em><strong>{{$coupon['money']}}</strong>
							@elseif($coupon['type'] == 'TYPE_POSTAGE')
							<strong>包邮</strong>
							@elseif($coupon['type'] == 'TYPE_DISCOUNT')
							<strong>{{$coupon['money']}}折</strong>
							@endif
							<div class="txt">
								<div class="limit">
									<span class="ftx">{{$coupon['name']}}&nbsp;</span><br />
								</div>
							</div>
							<div class="clear"></div>
						</div>
						<div class="q-range">
							@if($coupon['isSingleStore'])
							<div class="range-item"><p>限{{$coupon['storeName']}}</p></div>
							@else
							<div class="range-item"><p>全场通用</p></div>
							@endif
							<div class="range-item"><p>{{$coupon['beginTimeStr']}}-{{$coupon['endTimeStr']}}</p></div>
						</div>
						<div class="q-opbtns">
							<a class="get-coupon" href="#">
								<b class="semi-circle"></b>
								<span>@if($coupon['hasMinimumCharge'])满{{$coupon['minimumCharge']}}元可用@else{{trans('front/system.noThreshold')}}@endif</span>
							</a>
						</div>
					</div>
				</div>
				@endforeach
			</div>
			<div class="clear"></div>
		</div>
	</div>
	 @include('layouts.partials.pagination')
	{{--@include('layouts.partials.pagination',['totalPages'=>$coupons['totalPages']])--}}
	<div class="clear"></div>
</div>
<div class="clear"></div>
@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function(){
      var urlstr =  "{{$status}}";
      var urlstatus = false;
      $(".bs-ul li a").each(function () {
        if ($(this).attr('href').indexOf(urlstr) > -1 && urlstr !='' ) {
          $(this).parent().addClass('on'); urlstatus = true;
        }
      })
      if (!urlstatus) {$(".bs-ul li a").eq(0).parent().addClass('on'); }
   });
</script>
@endsection