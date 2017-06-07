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
          <td width="40%" style="text-align: center;border-right: 1px solid #eee;"><h3>退款信息</h3></td>
          <td class="cl04"><h3>钱款去向</h3></td>
        </tr>
        <tr>
          <td class="num cl04" style="border-right: 1px solid #eee;">
            <div class="item">
              <span class="label"> 服务门店：</span>
              <div class="left" style="height:28px; line-height:28px;">
                <span>{{$storeName}}</span>
              </div>
              <div class="clear"></div>
            </div>
            <div class="item">
              <span class="label"> 售后类型：</span>
              <div class="left" style="height:28px; line-height:28px;">
                <span>{{reason($reason)}}</span>
              </div>
              <div class="clear"></div>
            </div>
            <div class="item">
              <span class="label"> 退款原因：</span>
              <div class="left" style="height:28px; line-height:28px;">
                <span>{{$remark}}</span>
              </div>
              <div class="clear"></div>
            </div>
            <div class="item">
              <span class="label"> 售后编号：</span>
              <div class="left" style="height:28px; line-height:28px;">
                <span>{{$afterSalesSn}}</span>
              </div>
              <div class="clear"></div>
            </div>
            <div class="item">
              <span class="label"> 订单编号：</span>
              <div class="left" style="height:28px; line-height:28px;">
                <span>{{$orderSn}}</span>
              </div>
              <div class="clear"></div>
            </div>
          </td>
          <td style="padding-left:40px;">
            <div class="item-status">
              <div style="height: 55px;">
                @if($status == 'STATUS_SUCCESS')
                 <span><img width="40" style="vertical-align: middle;" src="{{asset('front/img/pay_ok.png')}}"></span>
                @elseif($status == 'STATUS_FAIL')
                <span><img width="40" style="vertical-align: middle;" src="{{asset('front/img/shibai.png')}}"></span>
                @elseif($status == 'STATUS_WAITING')
                <span><img width="40" style="vertical-align: middle;" src="{{asset('front/img/zhong.png')}}"></span>
                @else
                <span><img width="40" style="vertical-align: middle;" src="{{asset('front/img/shibai.png')}}"></span>
                @endif
                <span style="font-size: 22px;padding-left: 10px;vertical-align: middle;">{{orderStatus($status)}}</span>
              </div>
              <div class="clear"></div>
            </div>
            <div class="item">
              <span class="label"> 退款金额：</span>
              <div class="left" style="height:30px; line-height:28px;">
                <span>{{$money}}</span>
              </div>
              <div class="clear"></div>
            </div>
            <div class="item">
              <span class="label"> 退款时间：</span>
              <div class="left" style="height:30px; line-height:28px;">
                <span>{{date('Y-m-d H:i:s',$time)}}</span>
              </div>
              <div class="clear"></div>
            </div>
            <div class="item">
              <span class="label"> 钱款去向：</span>
              <div class="left" style="height:28px; line-height:28px;">
                <span>退回{{refundType($refundType)}}</span>
              </div>
              <div class="clear"></div>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    </div>
</div>
<div class="clear"></div>
{!!$ApiPresenter->getShowcaseList()!!}
@endsection