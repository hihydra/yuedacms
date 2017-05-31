@extends('layouts.front')
@section('title'){{$name}}-@endsection
@section('css')
<style type="text/css">
.example {
    width: 307px;
    height: 488px;
    background: url("//c1.mifile.cn/f/i/16/pay/weinxin-pay.png") no-repeat;
    position: absolute;
    top: 120px;
    left: 353px;
}
.modal-bd {
    padding: 0 40px;
    position: relative;
    text-align: center;
}
.msg span {
    color: #ff6700;
    cursor: pointer;
}
</style>
@endsection
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
				请选择以下支付方式<i>（目前只支持支付宝和微信支付）</i>
			</h4>
			<ul class="pay-ul">
				<li>
					<a target="_blank" href="{{$paylink['alipay']}}"><img src="{{asset('front/img/zfb.jpg')}}" /></a>
				</li>
				<li>
					<a onclick="weixinpay()"><img src="{{asset('front/img/wx.jpg')}}" /></a>
				</li>
			</ul>
		</div>
	</div>
	<div class="clear"></div>
</div>
{!!$ApiPresenter->getShowcaseList('cart')!!}
@endsection
@section('js')
<script type="text/javascript">
function weixinpay(){
	layer.open({
		type: 1,
  		skin: 'layui-layer-rim', //加上边框
  		area: ['420px', '360px'], //宽高
  		content: '<div class="modal-bd" id="J_showWeixinPayExample"><div class="code" id="J_weixinPayCode"><img src=""></div><div class="msg">请使用 <span>微信</span> 扫一扫<br>二维码完成支付</div></div>',
  		title: '微信支付'
	});
}
</script>
@endsection