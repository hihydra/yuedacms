<?php
namespace App\Service\Api;

//订单相关接口
class OrderService extends BaseService
{
    //获取订单列表
    public function getOrderList($anchor = null,$status = null){
        $path  = '/api/shop/order!list.do';
        $query = array('anchor'=>$anchor,'status'=>$status);
        $data = $this->http_curl($path,$query);
        return $data;
    }
    //获取“退款/售后”列表
    public function getAfterSalesList($anchor = null){
        $path  = '/api/shop/order!afterSalesList.do';
        $query = array('anchor'=>$anchor);
        $data = $this->http_curl($path,$query);
        return $data;
    }

    //获取订单数量
    public function getOrderCounts(){
        $path  = '/api/shop/order!counts.do';
        $query = array();
        $data = $this->http_curl($path,$query);
        return $data;
    }

    //获取订单详情
    public function getOrderDetail($sn){
        $path  = '/api/shop/order!detail.do';
        $query = array('sn'=>$sn);
        $data = $this->http_curl($path,$query);
        return $data;
    }

    //获取“退款详情”、“钱款去向”
    public function getAfterSalesDetail($id){
        $path  = '/api/shop/order!afterSalesDetail.do';
        $query = array('id'=>$id);
        $data = $this->http_curl($path,$query);
        return $data;
    }

    //获取物流信息
    public function getOrderExpressInfo($sn){
        $path  = '/api/shop/order!expressInfo.do';
        $query = array('sn'=>$sn);
        $data = $this->http_curl($path,$query);
        return $data;
    }

    //获取配送方式
    public function getShippingType($regionid){
        $path  = '/api/shop/checkout!getShippingType.do';
        $query = array('regionid'=>$regionid);
        $data = $this->http_curl($path,$query);
        return $data;
    }

    //生成订单
    public function getOrderCreate($cartIds,$form){
        $path  = '/api/shop/order!create.do?cartIds='.implode('&cartIds=',$cartIds);
        $query = $form;
        $data = $this->http_curl($path,$query,'post',false,false,'form_params');
        return $data;
    }

    //取消订单（只能取消未付款的订单）
    public function getOrderCancel($sn,$reason=null){
        $path  = '/api/shop/order!cancel.do';
        $query = array('sn'=>$sn,'reason'=>$reason);
        $data = $this->http_curl($path,$query,'post',true);
        return $data;
    }

    //删除订单（只能删除已取消与已完成的订单）
    public function getOrderDelete($sn){
        $path  = '/api/shop/order!delete.do';
        $query = array('sn'=>$sn);
        $data = $this->http_curl($path,$query,'post',true);
        return $data;
    }

    //获取支付宝相关参数
    public function getZhiFuBao($snLs){
        $path  = '/api/shop/payment!zhiFuBao.do?sn='.implode('&sn=',$snLs);
        $query = array();
        $data = $this->http_curl($path,$query,'post',false,true,'form_params');
        return $data;
    }

    //获取微信支付相关参数
    public function getWeiXin($snLs){
        $path  = '/api/shop/payment!weiXin.do?sn='.implode('&sn=',$snLs);
        $query = array();
        $data = $this->http_curl($path,$query,'post',false,true,'form_params');
        return $data;
    }

    //支付链接
    public function getPayLink($snLs){
        $data['alipay']  =  $this->url.'/api/shop/payment!zhiFuBaoWeb.do?sn='.implode('&sn=',$snLs);
        return $data;
    }

    //获取订单中待评价商品列表
    public function getWaitCommentGoods($orderId){
        $path  = '/api/shop/comment!waitCommentGoods.do';
        $query = array('orderId'=>$orderId);
        $data = $this->http_curl($path,$query);
        return $data;
    }

    //已购商品评价
    public function getCommentAdd($form){
        $path  = '/api/shop/comment!add.do';
        $query = $form;
        $data = $this->http_curl($path,$query);
        return $data;
    }

    //确定收货
    public function getRogConfirm($sn){
        $path  = '/api/shop/order!rogConfirm.do';
        $query = array('sn'=>$sn);
        $data = $this->http_curl($path,$query,'post',true);
        return $data;
    }

    //查询运费
    public function getFreight($paramData){
        $path  = '/api/shop/order!getFreight.do';
        $query = array('paramData'=>$paramData);
        $data = $this->http_curl($path,$query);
        return $data;
    }

}