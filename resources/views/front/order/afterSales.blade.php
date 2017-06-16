@extends('layouts.front')
@section('title'){{$name}}-@endsection
@inject('ApiPresenter','App\Presenters\Front\ApiPresenter')
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
			<table class="perTable" cellspacing="0" cellpadding="0">
				<tbody><tr>
					<th width="180">门店</th>
					<th>商品</th>
					<th width="80">交易金额</th>
					<th width="80">退款金额</th>
					<th width="80">订单状态</th>
					<th width="80">操作</th>
				</tr>
				@foreach($orders['datas'] as $order)
				<tr style="height:70px;">
					<td>{{$order['storeName']}}</td>
					<td class="book">
						@foreach($order['items'] as $key=>$item)
						<p @if($key>0)style="display:none;"@endif><a href="{{url('goods/'.$order['id'])}}">{{$item['name']}}</a><br></p>
						@endforeach
						@if(count($order['items'])>1)
						<p style="padding-top: 8px;color: #999;" class="seeAll">查看所有>></p>
						@endif
					</td>
					<td>￥{{$order['payMoney']}}</td>
					<td>￥{{$order['refundMoney']}}</td>
					<td>{{orderStatus($order['status'])}}</td>
					<td class="operation">
						<a class=" btn_red_01" target="_blank" href="{{url('order/afterSalesDetail/'.$order['id'])}}">钱款去向</a>
					</td>
				</tr>
				@endforeach
			</tbody></table>
		</div>
	</div>
 @include('layouts.partials.pagination')

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