@extends('layouts.front')
@section('title'){{$name}}-@endsection
@inject('ApiPresenter','App\Presenters\Front\ApiPresenter')
@section('content')
<div class="M1" style="margin-top:10px;">
	@include('front.share.crumb',['name'=>$name])
	<h1>我的购物车</h1>
	@if(!empty($carts))
	<form method="post" action="{{url('goods/buy')}}" id="buyCart">
		<div id="div_display" class="gwc_box gb_tal">
			<table class="g_table" cellspacing="0" cellpadding="0" border="0" >
				<tbody><tr class="tbg">
					<td class="cl01"><div class="g_chkbx">
						<input class="checkAll" onclick="javascript:checkAll(this,'div_display');" type="checkbox">
						<label>全选</label>
					</div></td>
					<td>购买信息</td>
					<td class="cl03">单价</td>
					<td class="cl03">折扣价</td>
					<td class="cl04">数量</td>
					<td class="cl03">小计</td>
					<td class="cl05">操作</td>
				</tr>
			</tbody>
			@foreach($carts as $cart)
			<tbody id="div_store_{{$cart['id']}}">
				<tr><td class="cl01">
					<div class="g_chkbx">
						<input id="div_input_{{$cart['id']}}" name="store_checkAll" class="getItemId" value="{{$cart['id']}}" type="checkbox" onclick="javascript:checkAll(this,'div_store_{{$cart['id']}}');">
					</div>
				</td>
				<td colspan=6><i><img src="{{asset('front/img/dianpu.png')}}" width="15px;"></i>  {{$cart['name']}}</td>
			</tr>
			@foreach($cart['items'] as $item)
			<tr id="div_store_{{$cart['id']}}_{{$item['id']}}">
				<td class="cl01">
					<div class="g_chkbx">
						<input name="cartIds[]" class="getItemId" value="{{$item['id']}}" onclick="javascript:clickCheckItem(this,'div_input_{{$cart['id']}}','div_store_{{$cart['id']}}');" type="checkbox">
					</div>
				</td>
				<td>
					<div class="bif">
						<a href="{{url('goods/'.$item['id'])}}" class="img"><img src="{{$item['image']}}"></a>
						<div class="info">
							<h4><a href="{{url('goods/'.$item['id'])}}">{{$item['name']}}</a></h4>
						</div>
					</div>
				</td>
				<td class="cl03">￥{{$item['mktprice']}}</td>
				<td class="cl03">￥{{$item['price']}}</td>
				<input id="ipt_price_{{$item['id']}}" type="hidden" value="{{$item['price']}}" disabled="true"/>
				<td class="cl04" style="">
					<div id="num" class="quantity_form Numinput">
						<a href="javascript:updateCartNum('{{$item['id']}}',-1,{{$item['price']}});" class="numadjust decrement decrease">-</a>
						<input id="ipt_num_{{$item['id']}}" class="quantity_text" size="5" name="num" autocomplete="off" readonly="readonly" value="{{$item['num']}}" type="text">
						<a href="javascript:updateCartNum('{{$item['id']}}',1,{{$item['price']}});" class="numadjust increment increase">+</a>
					</div>
				</td>
				<td class="itemTotal cl03" id="itemTotal_price_{{$item['id']}}">￥{{$item['price']*$item['num'] }}</td>
				<td class="cl05" data_type="cartDel"><a href="javascript:delCart({{$cart['id']}},{{$item['id']}});" class="delete del">删除</a></td>
			</tr>
			@endforeach
			<tr>
				<td></td>
				<td colspan=6><i><img src="{{asset('front/img/yunfeitishi.png')}}" width="15px;"/></i>  {{trans('front/system.freeShipping')}}</td>
			</tr>
		</tbody>
		@endforeach

	</table>
	<div class="g_tbox">
		<div class="g_chkbx left" style="margin:0;">
			<input class="checkAll" onclick="javascript:checkAll(this,'div_display');" type="checkbox">
			<label>全选</label>
			<!--<a href="#">删除选中图书</a> --></div>
			<div class="right total">
				共<label id="total_num">0</label>本，总计
				<i class="price"><label id="total_price">￥0.00</label></i>
				&nbsp;&nbsp;&nbsp;不含运费
			</div>
		</div>
		<div class="nextStep">
			<div class="js right"><a href="javascript:void(0);" onclick="buyCart_submit()" class="btn_red_n right" id="total_pay">去结算</a></div>
		</div>

	</div>
</form>
@else
<div class="g_tbox">
	<div class="g_chkbx" style="text-align: center;">
		购物车空空如也,来挑几本好书吧！
	</div>
</div>
@endif
</div>
<div class="clear"></div>

{!!$ApiPresenter->getShowcaseList('cart')!!}
@endsection
@section('js')
<script type="text/javascript">
	function checkAll(obj,formId){
		$("#"+formId).find("input[name='cartIds[]']").prop("checked",obj.checked);
		$("#"+formId).find("input[name='store_checkAll']").prop("checked",obj.checked);
		refreshGlobalChecked();
	}
	function clickCheckItem(obj,checkAllId,formId){
		var total = $("#"+formId).find("input[name='cartIds[]']").length;
		var count = $("#"+formId).find("input[name='cartIds[]']:checked").length;
		$("#"+checkAllId).prop("checked",count==total);
		refreshGlobalChecked();
	}
	function refreshGlobalChecked(){
		var total = $("#div_display").find("input[name='cartIds[]']").length;
		var count = $("#div_display").find("input[name='cartIds[]']:checked").length;
		$(".checkAll").prop("checked",count==total);
		refreshTotalPrice();
	}
	function refreshTotalPrice(){
		var cartIds = $("#div_display").find("input[name='cartIds[]']:checked");
		var num = 0;
		var price = 0;
		for(var i=0;i<cartIds.length;i++){
			num = $("#ipt_num_"+cartIds[i].value).val()-1+1+num;
			price = price+$("#ipt_price_"+cartIds[i].value).val()*$("#ipt_num_"+cartIds[i].value).val();
		}
		$("#total_num").html(num);
		$("#total_price").html("￥"+convertMoney(price));
		if(num>0){
			$("#total_pay").attr("class","right btn_red_l");

		}else{
			$("#total_pay").attr("class","right btn_red_n");
		}
	}
	function updateCartNum(cartId,num,price){
		num = $("#ipt_num_"+cartId).val()-1+1+num;
		if(num<=0){
			return ;
		}
		$.post("{{url('cart/ajaxCartUpdateNum')}}/"+cartId,{'num':num},function(result){
			if(result.result == 1){
				$("#ipt_num_"+cartId).val(num);
				$('#itemTotal_price_'+cartId).html("￥"+convertMoney(price*num));
				refreshTotalPrice();
			}else{
				layer.msg(result.message);
			}
		});
	}
	function delCart(storeId,cartId){
		$.post("{{url('cart/ajaxCartDelete')}}",{'cartIds[]':cartId},function(result){
			if(result.result == 1){
				$("#div_store_"+storeId+"_"+cartId).remove();
				if($("#div_store_"+storeId).find("[data_type='cartDel']").length<1){
					$("#div_store_"+storeId).remove();
				}
				refreshGlobalChecked();
			}else{
				layer.msg(result.message);
			}
		});
	}
	function buyCart_submit(){
		var cartIds = $("#div_display").find("input[name='cartIds[]']:checked");
		if(cartIds.length==0){
			layer.msg("{{trans('front/system.buyCart_error')}}");return;
		}
		$('#buyCart').submit();
	}
</script>
@endsection