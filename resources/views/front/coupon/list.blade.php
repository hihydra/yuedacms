@extends('layouts.front')
@section('title'){{$name}}-@endsection
@inject('ApiPresenter','App\Presenters\Front\ApiPresenter')
@section('content')
<div class="M1" style="margin-top:10px;">
	@include('front.share.crumb',['name'=>$name])
	<div class="quan-list">
		@foreach($coupons['datas'] as $coupon)
		<div class="quan-item
		@if($coupon['amount']<=$coupon['getCount'])
		quan-gray-item
		@endif">
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
						<span class="ftx">@if($coupon['hasMinimumCharge'])满{{$coupon['minimumCharge']}}元可用@else{{trans('front/system.noThreshold')}}@endif</span>
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
				<div class="range-item"><p>限量{{$coupon['amount']}}张</p></div>
				<div class="range-item"><p>{{$coupon['beginTimeStr']}}-{{$coupon['endTimeStr']}}</p></div>
			</div>
		</div>
		<div class="q-opbtns">
			@if($coupon['hasGet'])
			<a class="get-coupon coupon_{{$coupon['id']}}" href="javascript:void(0);">
				<b class="semi-circle"></b>
				<span>已领取</span></a>
				<div class="q-state"><div class="btn-state btn-finish">已领取</div></div>
				@else
				@if($coupon['amount']>$coupon['getCount'])
				<a class="get-coupon coupon_{{$coupon['id']}}" href="javascript:obtain({{$coupon['id']}});">
					<b class="semi-circle"></b>
					<span>立即领取</span></a>
					@else
					<a class="get-coupon coupon_{{$coupon['id']}}" href="javascript:void(0);">
						<b class="semi-circle"></b>
						<span>卷领光了</span></a>
						<div class="q-state"><div class="btn-state btn-getend">已抢完</div></div>
						@endif
						@endif
					</div>
				</div>
			@endforeach
		</div>
 @include('layouts.partials.pagination')
	</div>
<div class="clear"></div>

{!!$ApiPresenter->getShowcaseList()!!}
@endsection
@section('js')
<script type="text/javascript">
	function obtain(id){
		var params = {};
		params.url = "{{url('coupon/ajaxObtain')}}/"+id;
		params.postType = "post";
		params.mustCallBack = true;// 是否必须回调
		params.callBack = function(json) {
			$('.coupon_'+id+' span').text('已领取');
			$('.coupon_'+id).attr('href','javascript:void(0);');
			$('.coupon_'+id).append('<div class="q-state"><div class="btn-state btn-finish">已领取</div></div>');
		};
		ajaxJSON(params);
	}
</script>
@endsection