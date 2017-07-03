@extends('layouts.front')
@section('title'){{$name}}-@endsection
@inject('ApiPresenter','App\Presenters\Front\ApiPresenter')
@section('content')
<div class="M1" style="margin-top:10px;">
  @include('front.share.crumb',['name'=>$name])
  <h3>选择收货地址</h3>
  <div id="div_orderList">
    @if($type == 'cart')
    <form action="{{url('order')}}" method="post" id="orderCreate">
      @else
      <form action="{{url('goods/directBuy')}}" method="post" id="orderCreate">
        @endif
        <div class="list">
          @foreach($addressList as $address)
          <div class="address_{{$address['id']}} addr suggest-address
          @if($address['isDefault'])
          addr-cur
          @endif">
          <div class="inner">
            <div class="addr-hd">
              <span>（</span>
              <span class="receiver" data-id='{{$address["id"]}}' data-lng='{{{$address["lng"] or ""}}}' data-lat='{{{$address["lat"] or ""}}}' data-village='{{{$address["village"] or ''}}}'>{{$address['name']}}</span>
              <span> 收）</span>
              <span class="receiverMobile" style="display:inline;">{{$address['mobile']}}</span>
            </div>
            <div class="addr-bd" title="{{$address['address']}}">
              <span class="addr4tip"></span>
              <span class="receiverAddress" data-address="{{$address['address']}}">{{str_limit($address['address'], $limit = 60, $end = '...')}}</span>
              <span class="last">&nbsp;</span>
            </div>
            <div class="addr-toolbar">
              <a title="修改地址" class="modify" onclick="address_model({{$address['id']}});">修改</a>
            </div>
          </div>
          @if($address['isDefault'])
          <div class="curMarker"></div>
          <input type="hidden" name="addressId" value='{{$address["id"]}}'>
          <input type="hidden" name="receiver"  value='{{$address["name"]}}'>
          <input type="hidden" name="receiverMobile" value='{{$address["mobile"]}}'>
          <input type="hidden" name="receiverAddress" value='{{$address["address"]}}'>
          <input type="hidden" name="lng" value='{{{$address["lng"] or ""}}}'>
          <input type="hidden" name="lat" value='{{{$address["lat"] or ""}}}'>
          @endif
        </div>
        @endforeach
      </div>
      <div class="control">
        <a class="manageAddr" target="_blank" href="{{url('user/address')}}">管理收货地址</a>
        <input class="addAddr" onclick="address_model()" type="button" value="使用新地址">
      </div>
      <div class="gwc_box gb_tal" id="div_orderList">
        @foreach($goodList as $good)
        <table class="g_table" cellspacing="0" cellpadding="0" border="0">
          <tbody><tr class="tbg">
            <td class="cl06"></td>
            <td><i><img src="{{asset('front/img/dianpu.png')}}" width="15px;"></i> {{{$good['name'] or '购买信息'}}}</td>
            <td class="cl03">单价</td>
            <td class="cl03">折扣价</td>
            <td class="cl04">数量</td>
            <td class="cl03">小计</td>
          </tr>
          @foreach($good['items'] as $item)
          <tr>
            <td class="cl06">
              <input type="hidden" name="cartIds[]" value="{{$item['id']}}">
              <input type="hidden" name="productId" value="{{$item['productId']}}">
              <input type="hidden" name="num" value="{{$item['num']}}">
            </td>
            <td>
              <div class="bif">
                <a target="_blank" href="{{url('goods/'.$item['id'])}}" class="img"><img src="{{$item['image']}}" width="48px" height="68px"></a>
                <div class="info">
                  <h4>
                    <a target="_blank" href="{{url('goods/'.$item['id'])}}">{{$item['name']}}</a>
                  </h4>
                </div>
              </div>
            </td>
            <td class="cl03">￥{{$item['mktprice']}}</td>
            <td class="cl03">￥{{$item['price']}}</td>
            <td class="num cl04">{{$item['num']}}</td>
            <td class="itemTotal cl03">￥{{$item['num'] * $item['price']}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>

      @if($good['coupons'])
      <div class="coupon-scroll">
        <h3>我的优惠券</h3>
        <div class="coupon-enable" style="height:120px;">
          <ul>
            @foreach($good['coupons'] as $coupon)
            <li class="coupon_{{$good['id']}}_{{$coupon['id']}}" onclick="javascript:buyConfirm_useCoupon({{$good['id']}},{{$coupon['id']}},{{$coupon['discountPrice']}},'{{$coupon['type']}}');">
              <div class="coupon-item">
                <div class="c-detail">
                  <div class="c-msg c-dong">
                    <div class="c-price">
                      @if($coupon['type'] == 'TYPE_POSTAGE')
                      <em>包邮</em>
                      @else
                      <em>￥{{$coupon['discountPrice']}}</em>
                      @endif
                    </div>
                    <div class="c-limit">
                      @if($coupon['hasMinimumCharge'])
                      <span>满{{$coupon['minimumCharge']}}</span>
                      @else
                      <span>无门槛</span>
                      @endif
                    </div>
                    <div class="c-time c-time-dong">
                      <span>有效期至{{$coupon['endTimeStr']}}</span>
                    </div>
                  </div>
                  <div class="c-type c-type-dong">
                    <span class="c-type-l">[限{{$coupon['storeName']}}]</span>
                  </div>
                </div>
              </div>
            </li>
            @endforeach
          </ul>
        </div>
      </div>
      @endif

      <div class="g_tbox">
        <div class="right" style="width:30%;">
          <div class="right total">商品金额总计<i class="price">￥{{$good['goodsPrice']}}</i></div>
          <div class="total clear right">优惠券<i class="price" id="ipt_couponHint_{{$good['id']}}">￥0.00</i><div class="clear"></div></div>
          <div class="total clear right">运费<i class="price" id="ipt_freightHint_{{$good['id']}}">￥{{$good['freight']}}</i><div class="clear"></div></div>
          <div class="total clear right tal_p">应付金额<i class="price" id="ipt_totalPriceHint_{{$good['id']}}">￥{{$good['goodsPrice'] + $good['freight']}}</i><div class="clear"></div></div>
          <input type="hidden" name='storeId' value="{{$good['id']}}">
          <input id="ipt_goodsPrice_{{$good['id']}}" value="{{$good['goodsPrice']}}" type="hidden" />
          <input id="ipt_freight_{{$good['id']}}" value="{{$good['freight']}}" type="hidden" />
          <input id="ipt_totalPrice_{{$good['id']}}" value="{{$good['goodsPrice'] + $good['freight']}}" type="hidden" />
          <input type="hidden" name="otherInfo[{{$good['id']}}][couponId]">
        </div>
        <div class="left" style="width:70%;">
          <div class="item">
            <span class="label">买家留言：</span>
            <div class="left">
              <textarea style="width:490px; height:40px; border:1px solid #ccc; padding:5px;" name="otherInfo[{{$good['id']}}][remark]"></textarea>
            </div>
            <div class="clear"></div>
          </div>
          <div class="item">
            <span class="label"><em>*</em> 配送方式：</span>
            <div class="left" style="height:28px; line-height:28px;padding-top: 6px;">
              <select name="shippingMethod" class="selt selt1">
                <option value="0">请选择：</option>
                <option value="METHOD_DELIVERY" selected = "selected">快递配送</option>
              </select>
            </div>
            <div class="clear"></div>
          </div>
          <div class="item">
            <span class="label"><em>*</em> 支付方式：</span>
            <div class="left" style="height:28px; line-height:28px;padding-top: 6px;">
              <select name="paymentType" class="selt selt1">
                <option value="0">请选择：</option>
                <option value="online" selected = "selected">在线支付</option>
              </select>
            </div>
            <div class="clear"></div>
          </div>
          <div class="item">
            <span class="label"><em>*</em> 发票信息：</span>
            <div class="left" style="height:28px; line-height:30px;">
              <input name="otherInfo[{{$good['id']}}][receiptType]" class="jdradio receiptType" value="0" type="radio" checked="true">
              <label class="mr">不开发票</label>
              <input name="otherInfo[{{$good['id']}}][receiptType]" class="jdradio receiptType" value="1" type="radio">
              <label class="mr">个人发票</label>
              <input name="otherInfo[{{$good['id']}}][receiptType]" class="jdradio receiptType" value="2" type="radio">
              <label class="mr">单位发票</label>
            </div>
            <div class="clear"></div>
            <div class="item receiptTitle" style="display: none;">
              <span class="label"><em>*</em> 发票抬头：</span>
              <div class="left">
                <input style="border:1px solid #ccc; padding:5px;" type="type" name="otherInfo[{{$good['id']}}][receiptTitle]">
              </div>
              <div class="clear"></div>
            </div>
            <div class="item receiptContent"  style="display: none;">
              <span class="label"><em>*</em> 发票内容：</span>
              <div class="left" style="height:28px; line-height:30px;">
                <input name="otherInfo[{{$good['id']}}][receiptContent]" class="jdradio" value="图书" type="radio" checked="true">
                <label class="mr">图书</label>
                <input name="otherInfo[{{$good['id']}}][receiptContent]" class="jdradio" value="音像" type="radio">
                <label class="mr">音像</label>
                <input name="otherInfo[{{$good['id']}}][receiptContent]" class="jdradio" value="教材" type="radio">
                <label class="mr">教材</label>
                <input name="otherInfo[{{$good['id']}}][receiptContent]" class="jdradio" value="资料" type="radio">
                <label class="mr">资料</label>
              </div>
              <div class="clear"></div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
      <div class="nextStep g_tbox">
        <div class="js right">
          <a href="javascript:void(0);" onclick="orderCreate()" class="btn_red_l right">提交订单</a>
          <div class="total" style="font-size: 16px;line-height: 40px;">合计：<i class="price" id="div_buyConfirmTotalPrice"></i></div>
        </div>
      </div>
    </div>
  </form>
</div>
</div>
<div class="clear"></div>
<div style="display:none;" id="editAddress">
  <div class="editAddress" style="padding-top: 20px;">
    <input type="hidden" name="id">
    <div class="item">
      <span class="label"><em>*</em> 收货人：</span>
      <div class="fl">
        <input class="itxt" name="name" maxlength="20" type="text" placeholder="收货人姓名"/>
      </div>
    </div>
    <div class="clear"></div>
    <div class="item">
      <span class="label"><em>*</em> 手机号：</span>
      <div class="fl">
        <input class="itxt" maxlength="20" name="mobile" type="text" placeholder="收货人手机号码"/>
      </div>
    </div>
    <div class="clear"></div>
    <div class="item">
      <span class="label"><em>*</em> 详细地址：</span>
      <div class="fl">
        <textarea style="width:400px; height:70px; border:1px solid #ccc; padding:5px;" placeholder="建议您如实填写详细收货地址，例如街道名称，门牌号码，楼层和房间号等信息" name="address"></textarea>
      </div>
    </div>
    <div class="clear"></div>
    <div class="item">
      <span class="label"><em>*</em> 小区/大厦：</span>
      <div class="fl">
        <div id="distpicker">
          <div class="form-group">
            <div style="position: relative;">
              <input class="itxt" maxlength="20" name="village" type="text" placeholder="收货人所在小区/大厦" />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="clear"></div>
    <div class="item">
      <span class="label">&nbsp;</span>
      <div class="info-c">
        <a class="btn_red subAddress" href="javascript:void(0);">保存</a>
      </div>
    </div>
  </div>
</div>
{!!$ApiPresenter->getShowcaseList()!!}
@endsection
@section('js')
<script type="text/javascript">
  $(document).ready(function(){
    @foreach($goodList as $good)
    @if($good['coupons'])
    buyConfirm_useCoupon({{$good['id']}},{{$good['coupons'][0]['id']}},{{$good['coupons'][0]['discountPrice']}},"{{$good['coupons'][0]['type']}}");
    @endif
    @endforeach
    doRefreshBuyConfirmTotalPrice_calculate();

    $(".suggest-address").click(function(){
      $(".list .addr-cur").removeClass("addr-cur");
      $(".list .curMarker").remove();
      $(this).addClass('addr-cur');
      $(this).append('<div class="curMarker"></div>');
      $("input[name='receiver']").val($.trim($(this).find('.receiver').text()));
      $("input[name='receiverMobile']").val($.trim($(this).find('.receiverMobile').text()));
      $("input[name='receiverAddress']").val($.trim($(this).find('.receiverAddress').attr('data-address')));
      $("input[name='addressId']").val($.trim($(this).find('.receiver').attr('data-id')));
      $("input[name='lng']").val($.trim($(this).find('.receiver').attr('data-lng')));
      $("input[name='lat']").val($.trim($(this).find('.receiver').attr('data-id')));
    });

    $('.receiptType').click(function(){
      if($(this).attr("value")=="1"){
        $(this).parent().parent().find('.receiptTitle').hide();
        $(this).parent().parent().find('.receiptContent').show();
      }else if($(this).attr("value")=="2"){
        $(this).parent().parent().find('.receiptTitle').show();
        $(this).parent().parent().find('.receiptContent').show();
      }else{
        $(this).parent().parent().find('.receiptTitle').hide();
        $(this).parent().parent().find('.receiptContent').hide();
      }
    });
  });
  function buyConfirm_useCoupon(storeId,couponId,discountPrice,type){
    var freight = convertMoney($('#ipt_freight_'+storeId).val());
    if(!$('.coupon_'+storeId+'_'+couponId+' .c-detail').hasClass('item-selected')){
      $('.coupon_'+storeId+'_'+couponId+' .c-detail').parent().parent().parent().find('.item-selected').removeClass("item-selected");
      var couponHint = "-";
      if(type=="TYPE_CASH"){
        couponHint = "-"+discountPrice+"元";
      }else if(type=="TYPE_POSTAGE"){
        couponHint = "包邮";
        $('#ipt_freightHint_'+storeId).html("￥"+convertMoney(0));
      }
      $("input[name=\"otherInfo["+storeId+"][couponId]\"]").val(couponId);
    }else{
      discountPrice = 0;
      couponHint = 0;
      $('#ipt_freightHint_'+storeId).html("￥"+convertMoney(freight));
      $("input[name=\"otherInfo["+storeId+"][couponId]\"]").val('');
    }
    $('.coupon_'+storeId+'_'+couponId+' .c-detail').toggleClass('item-selected');

    $("#ipt_couponHint_"+storeId).html(couponHint);
    var goodsPrice = convertMoney($("#ipt_goodsPrice_"+storeId).val());
    var totalPrice = goodsPrice+freight-discountPrice;
    $('#ipt_totalPrice_'+storeId).val(convertMoney(totalPrice));
    $('#ipt_totalPriceHint_'+storeId).html("￥"+convertMoney(totalPrice));
    doRefreshBuyConfirmTotalPrice_calculate();
  }
  function doRefreshBuyConfirmTotalPrice_calculate(){
    var storeIds = $("#div_orderList").find("input[name='storeId']");
    if(storeIds.length==0){
      return ;
    }
    var buyConfirmTotalPrice = 0;
    for(var i=0;i<storeIds.length;i++){
      var storeId = storeIds[i].value;
      var totalPrice = convertMoney($.trim($('#ipt_totalPrice_'+storeId).val()));
      buyConfirmTotalPrice += totalPrice;
    }
    $("#div_buyConfirmTotalPrice").html("￥"+convertMoney(buyConfirmTotalPrice));
  }
  function orderCreate(){
    var storeIds = $("#div_orderList").find("input[name='storeId']");
    if(storeIds.length==0){
      return ;
    }
    for(var i=0;i<storeIds.length;i++){
      var storeId = storeIds[i].value;
      var receiptType = $.trim($("input[name=\"otherInfo["+storeId+"][receiptType]\"]:checked").val());
      var receiptTitle = $.trim($("input[name=\"otherInfo["+storeId+"][receiptTitle]\"]").val());
      if(receiptType == 2 && receiptTitle==""){
        $("input[name=\"otherInfo["+storeId+"][receiptTitle]\"]").focus();
        layer.msg("{{trans('front/system.receipt_error')}}");return;
      }
    }
    if($("input[name='receiver']").val()==''||$("input[name='receiver']").val()==undefined){
       layer.msg("请选择收货地址");return;
    }
    $('#orderCreate').submit();
  }

  function address_model(addressId = null){
    if (addressId) {
      var title="修改收货地址";
    }else{
      var title="新增收货地址";
    }
    layer.open({
      type: 1,
        skin: 'layui-layer-rim', //加上边框
        area: ['620px', '350px'], //宽高
        content: $('#editAddress').html(),
        title:title
    });
    if (addressId) {
      $(".editAddress input[name='name']").val($.trim($('.address_'+addressId).find('.receiver').text()));
      $(".editAddress input[name='mobile']").val($.trim($('.address_'+addressId).find('.receiverMobile').text()));
      $(".editAddress textarea[name='address']").val($.trim($('.address_'+addressId).find('.receiverAddress').attr('data-address')));
      $(".editAddress input[name='village']").val($.trim($('.address_'+addressId).find('.receiver').attr('data-village')));
      $(".editAddress input[name='id']").val($.trim($('.address_'+addressId).find('.receiver').attr('data-id')));
      $('.editAddress .subAddress').attr('href',"javascript:window.parent.updateAddress("+addressId+");");
    }else{
      $('.editAddress .subAddress').attr('href',"javascript:window.parent.saveAddress();");
    }
  }

  function dataAddress(){
    var name = $(".layui-layer-content input[name='name']").val();
    var mobile = $(".layui-layer-content input[name='mobile']").val();
    var village = $(".layui-layer-content input[name='village']").val();
    var address = $(".layui-layer-content textarea[name='address']").val();
    var params = {'name':name,'mobile':mobile,'village':village,'address':address};
    return params;
  }

  function saveAddress(){
    var params = {};
    params.url = "{{url('user/address')}}";
    params.postData = dataAddress();
    params.postType = "post";
    params.mustCallBack = true;// 是否必须回调
    params.callBack = function(json) {
      window.location.reload();
    };
    ajaxJSON(params);
  }

  function updateAddress(id){
    var params = {};
    params.url = "{{url('user/address')}}/"+id;
    params.postData = dataAddress();
    params.postType = 'PUT';
    params.mustCallBack = true;// 是否必须回调
    params.callBack = function(json) {
      window.location.reload();
    };
    ajaxJSON(params);
  }
</script>
@endsection