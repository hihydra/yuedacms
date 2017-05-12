@extends('layouts.front')
@section('title'){{$name}}-@endsection
@inject('ApiPresenter','App\Presenters\Front\ApiPresenter')
@section('content')
<div class="M1" style="margin-top:10px;">
	<div class="titleNav">
		<p>当前所在位置：
			<a href="{{url('/')}}">首页</a>
			<span class="sep">></span>
			{{$name}}
		</p>
	</div>
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
				<div class="range-item"><p>{{$coupon['storeName']}}</p></div>
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
				@else
				@if($coupon['amount']>$coupon['getCount'])
				<a class="get-coupon coupon_{{$coupon['id']}}" href="javascript:obtain({{$coupon['id']}});">
					<b class="semi-circle"></b>
					<span>立即领取</span></a>
					@else
					<a class="get-coupon coupon_{{$coupon['id']}}" href="javascript:void(0);">
						<b class="semi-circle"></b>
						<span>卷领光了</span></a>
						@endif
						@endif
					</div>
				</div>
				@endforeach
			</div>
			<!--分页-->
			<div class="pages">
				<a class="prev  icon-disable1" href="#"><b></b>上一页</a><strong>1</strong><a href="#">2</a><a href="#">3</a><a href="#">4</a>
				<i>...</i><a class="last" href="#">212</a><a class="next" href="#">下一页<b></b></a>
				<span class="go_page">去第<input id="go_page_input" class="input_02 g_ipt" name="" type="text">页 <input name="" class="p_go" value="GO" id="go_page_btn" type="button"></span>
			</div>

		</div>
		<div class="clear"></div>


		{!!$ApiPresenter->getShowcaseList()!!}
		@endsection
		@section('js')
		<script type="text/javascript">
			function obtain(id){
				$.post("{{url('coupon/ajaxObtain')}}/"+id,function(result){
					layer.msg(result.message);
					if(result.result == 1){
						$('.coupon_'+id+' span').text('已领取');
						$('.coupon_'+id).attr('href','javascript:void(0);');
					}
				});
			}
		</script>
		@endsection