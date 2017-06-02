<?php
namespace App\Service\Api;


//优惠卷相关接口
class CouponService extends BaseService
{

    //领券中心
    public function getCouponList($storeId,$anchor=null){
        $path  = '/api/shop/coupon!list.do';
        $query = array('storeId'=>$storeId,'anchor'=>$anchor);
        $data = $this->http_curl($path,$query);
        return $data;
    }

    //领券
    public function getCouponObtain($id){
        $path  = '/api/shop/coupon!obtain.do';
        $query = array('id'=>$id);
        $data = $this->http_curl($path,$query,'post',true);
        return $data;
    }

    //我的优惠券列表
    /*
    参数：
    String status:状态
        STATUS_ALL,//全部(只用作查询)
        STATUS_EXPIRE,//已过期(只用作查询)
        STATUS_UNUSED),//未使用
        STATUS_USED,//已使用
    int anchor:由上一次请求返回
    */
    //我的优惠券
    public function getMyCoupons($status,$anchor=null){
        $path  = '/api/shop/coupon!myCoupons.do';
        $query = array('status'=>$status,'anchor'=>$anchor);
        $data = $this->http_curl($path,$query);
        return $data;
    }

    //获取快过期的优惠券数量
    public function getCouponExpiringCount(){
        $path  = '/api/shop/coupon!expiringCount.do';
        $query = array();
        $data = $this->http_curl($path,$query);
        return $data;
    }

    //获取待提交订单可用优惠券列表
    public function getCouponsByOrder($json){
        $path  = '/api/shop/coupon!getCouponsByOrder.do';
        $query = array('paramData'=>$json);
        $data = $this->http_curl($path,$query,'post');
        return $data;
    }

}