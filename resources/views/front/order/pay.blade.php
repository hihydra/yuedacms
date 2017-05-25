@extends('layouts.front')
@section('title'){{$name}}-@endsection
@inject('ApiPresenter','App\Presenters\Front\ApiPresenter')
@section('content')
<div class="M1" style="margin-top:10px;">
	@include('front.share.crumb',['name'=>$name])
	<!--付款方式-->
	<div class="Pay">
		<div class="payconf">
			<div class="coninfo">
				订单提交成功，请您尽快付款！
				<p class="tip1">提示：如订单中有使用优惠券抵减相应金额，必须主动取消订单才能让优惠券重新生效。</p>
			</div>
			<div class="price">
				应付金额：<i>￥{{$total_fee}}</i>
			</div>
		</div>
		<div class="pt1">
			<h4>
				选择在线支付平台<i>（目前只支持支付宝和微信支付）</i>
			</h4>
			<ul class="pay-ul">
				<li>
					<span>
						<input name="payType" value="1" checked="checked" type="radio" />
					</span>
					<a href="#"><img src="{{asset('front/img/zfb.jpg')}}" /></a>
				</li>
				<li>
					<span>
						<input name="payType" value="2" type="radio" />
					</span>
					<a href="#"><img src="{{asset('front/img/wx.jpg')}}" /></a>
				</li>
			</ul>
		</div>
	</div>
	<p class="btnb"><a href="#" class="btn_red_l left">立即付款</a></p>
	<div class="clear"></div>
</div>
{!!$ApiPresenter->getShowcaseList('cart')!!}
@endsection
@section('js')
@endsection