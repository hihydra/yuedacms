@extends('layouts.front')
@section('title'){{$name}}-@endsection
@inject('ApiPresenter','App\Presenters\Front\ApiPresenter')
@section('css')
<style type="text/css">
	.perTable{border-bottom:1px solid #eee;}
	.perTable tr td{border-bottom:none;}
	.perTable .parameter{border-left:1px solid #eee;}
	.perTable .goods{border-bottom:1px solid #eee;}
</style>
@endsection
@section('content')
<div class="M1" style="margin-top:10px;">
	@include('front.share.crumb',['name'=>$name])
	<div class="second-menu">
		<ul>
			<li><a href="{{url('order')}}">所有订单@if($counts['total']>0) ({{$counts['total']}})@endif</a></li>
			<li><a href="{{URL::route('order',['status'=>'STATUS_NOT_PAY'])}}">待付款@if($counts['STATUS_NOT_PAY']>0) ({{$counts['STATUS_NOT_PAY']}})@endif</a></li>
			<li><a href="{{URL::route('order',['status'=>'STATUS_WAIT_SHIP'])}}">待发货@if($counts['STATUS_WAIT_SHIP']>0) ({{$counts['STATUS_WAIT_SHIP']}})@endif</a></li>
			<li><a href="{{URL::route('order',['status'=>'STATUS_SHIPPING'])}}">待收货@if($counts['STATUS_SHIPPING']>0) ({{$counts['STATUS_SHIPPING']}})@endif</a></li>
			<li><a href="{{URL::route('order',['status'=>'STATUS_COMPLETE'])}}">待评价@if($counts['STATUS_COMPLETE']>0) ({{$counts['STATUS_COMPLETE']}})@endif</a></li>
			<li><a href="{{URL::route('order',['status'=>'STATUS_AFTERSALES'])}}">退款/售后</a></li>
		</ul>
		<div class="clear"></div>
	</div>
	<div class="TabContent">
		<div id="myTab0_Content0">
			@foreach($orders['datas'] as $order)
			<table class="perTable" cellspacing="0" cellpadding="0">
				<tbody><tr>
					<th width="600"><i><img src="{{asset('front/img/dianpu.png')}}" width="15px;"></i>  {{$order['storeName']}}</th>
					<th>商品</th>
					<th width="80">交易金额</th>
					<th width="80">退款金额</th>
					<th width="80">订单状态</th>
					<th width="80">操作</th>
				</tr>
				@foreach($order['items'] as $key=>$item)
				<tr style="height:70px;">
					<td class="goods bif">
						<a class="img"><img src="{{$item['image']}}"></a>
						<div class="info">
							<h4><a>{{$item['name']}}</a><br></h4>
							<p class="left">x{{$item['num']}}</p>
						</div>
					</td>
					<td class="goods price">￥{{$item['price']}}</td>
					@if($key == 0)
					@php $num =  count($order['items']); @endphp
					@php $goodnum=0; foreach($order['items'] as $v){$goodnum += $v['num'];}@endphp
					<td class="parameter" rowspan="{{$num}}">￥{{$order['payMoney']}}<br>共{{$goodnum}}件商品</td>
					<td class="parameter" rowspan="{{$num}}">{{$order['refundMoney']}}</td>
					<td class="parameter" rowspan="{{$num}}">{{orderStatus($order['status'])}}</td>
					<td class="parameter" rowspan="{{$num}}" class="operation">
						<a class="btn_red_01" href="{{url('order/afterSalesDetail/'.$order['id'])}}">钱款去向</a>
					</td>
					@endif
				</tr>
				@endforeach
			</tbody>
		</table>
		@endforeach
	</div>
</div>
 @include('layouts.partials.pagination',['totalPages'=>$orders['totalPages']])

</div>
<div class="clear"></div>
{!!$ApiPresenter->getShowcaseList()!!}
@endsection
@section('js')
<script type="text/javascript">
	$(document).ready(function(){
		@php
		$status = app('request')->input('status');
		@endphp
		var status = '{{$status}}';
		var urlstatus = false;
		$(".second-menu ul li a").each(function () {
			if ($(this).attr('href').indexOf(status) > -1 && status !='' ) {
				$(this).addClass('hover'); urlstatus = true;
			}
		})
		if (!urlstatus) {$(".second-menu ul li a").eq(0).addClass('hover'); }
		$(".seeAll").click(function(){
			$(this).parent().find('p').show();
			$(this).hide();
		})
	});
</script>
@endsection