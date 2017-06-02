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
					<th width="130">订单号</th>
					<th>商品</th>
					<th>金额</th>
					<th>门店</th>
					<th width="80">付款类型</th>
					<th width="80">订单状态</th>
					<th width="80">操作</th>
				</tr>
				@foreach($orders['datas'] as $order)
				<tr id="div_order_{{$order['sn']}}" style="height:70px;">
					<td>{{$order['sn']}}</td>
					<td class="book">
						@php $item = array_first($order['items']); @endphp
						<p><a href="{{url('goods/'.$order['id'])}}">{{$item['name']}}</a><br></p>
						@if(count($order['items'])>1)
						<p style="padding-top: 8px;color: #999;">查看所有>></p>
						@endif
					</td>
					<td>￥{{$order['needPayMoney']}}</td>
					<td class="date">{{$order['storeName']}}</td>
					<td>{{paymentType($order['paymentType'])}}</td>
					<td>{{orderStatus($order['status'])}}</td>
					<td class="operation">
						@if($order['status'] == 'STATUS_NOT_PAY')
						<a class=" btn_red_01" target="_blank" href="{{URL::route('order.pay',['snLs[]'=>$order['sn']])}}">付款</a>
						<a class="btn_cancel slink" href="javascript:orderCancel('{{$order['sn']}}');">取消订单</a>
						@elseif($order['status'] == 'STATUS_SHIPPING')
						<a class=" btn_red_01" href="javascript:rogConfirm('{{$order['sn']}}');">确认收货</a>
						@elseif($order['status'] == 'STATUS_COMPLETE' || $order['status'] == 'STATUS_CANCEL')
						@if($order['commented'] == 0 )
						<a class=" btn_red_01" target="_blank" href="#">评价</a>
						@endif
						<a class="btn_cancel slink" href="javascript:orderDelete('{{$order['sn']}}');">删除订单</a>
						@endif
						<a href="{{url('order/'.$order['sn'])}}">查看</a>
					</td>
				</tr>
				@endforeach
			</tbody></table>
		</div>
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
    });
	function orderCancel(sn){
		layer.confirm("确认取消订单?", function()
		{
			var params = {};
			params.url = "{{url('order/ajaxCancel')}}/"+sn;
			params.postType = "post";
			params.mustCallBack = true;// 是否必须回调
			params.callBack = function(json) {
				window.location.reload();
			};
			ajaxJSON(params);
		});
	}
	function orderDelete(sn){
		layer.confirm("确认删除订单?", function()
		{
			var params = {};
			params.url = "{{url('order/ajaxDelete')}}/"+sn;
			params.postType = "post";
			params.mustCallBack = true;// 是否必须回调
			params.callBack = function(json) {
				$("#div_order_"+sn).remove();
			};
			ajaxJSON(params);
		});
	}
	function rogConfirm(sn){
		layer.confirm("请在收到商品后,确认收货！", function()
		{
			var params = {};
			params.url = "{{url('order/rogConfirm')}}/"+sn;
			params.postType = "post";
			params.mustCallBack = true;// 是否必须回调
			params.callBack = function(json) {
				window.location.reload();
			};
			ajaxJSON(params);
		});
	}
</script>
@endsection