@extends('layouts.front')
@section('title'){{$name}}-@endsection
@inject('ApiPresenter','App\Presenters\Front\ApiPresenter')
@section('content')
<div class="M1" style="margin-top:10px;">
  @include('front.share.crumb',['name'=>$name])
  <div id="new_cart_wrapper" class="gwc_box gb_tal">
    <table class="g_table" cellspacing="0" cellpadding="0" border="0">
      <tbody>
        <tr class="tbg">
          <td width="40%" style="text-align: center;border-right: 1px solid #eee;"><h3>订单信息</h3></td>
          <td class="cl04"><h3>物流信息</h3></td>
        </tr>
        <tr>
          <td class="num cl04" style="border-right: 1px solid #eee;">
            <div class="item">
              <span class="label"> 收货地址：</span>
              <div class="left" style="height:28px; line-height:28px;">
              <span class="street" title="{{$receiverAddress}}">{{str_limit($receiverAddress, $limit = 40, $end = '...')}}</span>
              </div>
              <div class="clear"></div>
            </div>
            <div class="item">
              <span class="label"> 订单状态：</span>
              <div class="left" style="height:28px; line-height:28px;">
                <span>{{orderStatus($status)}}</span>
              </div>
              <div class="clear"></div>
            </div>
            <div class="item">
              <span class="label"> 支付方式：</span>
              <div class="left" style="height:28px; line-height:28px;">
                <span>{{paymentType($paymentType)}}</span>
              </div>
              <div class="clear"></div>
            </div>
            <div class="item">
              <span class="label"> 买家留言：</span>
              <div class="left" style="height:28px; line-height:28px;">
                <span>{{{$remark or ''}}}</span>
              </div>
              <div class="clear"></div>
            </div></td>
            <td>
              <div class="item">
                <span class="label"> 配送方式：</span>
                <div class="left" style="height:28px; line-height:28px;">
                  <span>{{shippingMethod($shippingMethod)}}</span>
                </div>
                <div class="clear"></div>
              </div>

              <div class="item">
                <span class="label"> 物流详情：</span>
                @if($expressInfo['items'])
                @foreach($expressInfo['items'] as $key=>$item)
                @php if($key>3){break;} @endphp
                <div class="left" style="height:28px; line-height:28px;">
                  <span title="{{$item['acceptTime']}} {{str_limit($item['acceptStation'], $limit = 40, $end = '...')}}">{{$item['acceptTime']}} {{str_limit($item['acceptStation'], $limit = 40, $end = '...')}}</span>
                </div>
                @endforeach
                @else
                <div class="left" style="height:28px; line-height:28px;">
                  <span>暂无物流信息</span>
                </div>
                @endif
                <div class="clear"></div>
              </div>

            </td>
          </tr>
        </tbody>
      </table>
    </br>
    <table class="g_table" cellspacing="0" cellpadding="0" border="0">
      <tbody>
        <tr class="tbg">
          <td class="cl06"></td>
          <td><i><img src="{{asset('front/img/dianpu.png')}}" width="15px;"></i> {{$storeName}}</td>
          <td class="cl04">数量</td>
          <td class="cl03">小计</td>
        </tr>
        @foreach($items as $item)
        <tr>
          <td class="cl06">
          </td>
          <td>
            <div class="bif">
              <a target="_blank" href="#" class="img"><img src="{{$item['image']}}" width="48px" height="68px"></a>
              <div class="info">
                <h4>
                  <a target="_blank" href="#">{{$item['name']}}</a>
                </h4>
              </div>
            </div>
          </td>
          <td class="num cl04">{{$item['num']}}</td>
          <td class="itemTotal cl03">￥{{$item['price']}}</td>
        </tr>
        @endforeach
      </tbody></table>
    </br>
    <div class="g_tbox">
      <div class="right" style="width:30%;">
        <div class="right total">商品总价<i class="price" id="orderPriceTotal">￥{{$goodsAmount}}</i></div>
        <div class="total clear right">优惠券<i class="price" id="coupon_price">￥{{$couponAmount}}</i><div class="clear"></div></div>
        <div class="total clear right">运费<i class="price" id="coupon_price">￥{{$shippingAmount}}</i><div class="clear"></div></div>
        <div class="total clear right tal_p">实付金额<i class="price" id="coupon_total">￥{{$needPayMoney}}</i><div class="clear"></div></div>
      </div>
      <div class="left" style="width:70%;">
      </div>
    </div>
  </div>

</div>
<div class="clear"></div>
{!!$ApiPresenter->getShowcaseList()!!}
@endsection
@section('js')
@endsection