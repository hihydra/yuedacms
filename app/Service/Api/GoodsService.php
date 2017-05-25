<?php
namespace App\Service\Api;


//商品购买相关接口
class GoodsService extends BaseService
{

    //商品详情(获取立即购买需要的参数)
    public function getGoodsDetail($productId,$storeId){
        $path  = '/api/shop/goods!detail.do';
        $query = array('productId'=>$productId,'storeId'=>$storeId);
        $data = $this->http_curl($path,$query);
        return $data;
    }

    //判断是否在配送范围
    public function checkServiceRadius($storeId,$lng,$lat){
        $path  = '/api/shop/storefront!checkServiceRadius.do';
        $query = array('lng'=>$lng,'lat'=>$lat,'storeId'=>$storeId);
        $data = $this->http_curl($path,$query);
        return $data;
    }

    //立即购买
    public function getCartListByIds($cartIds){
        $path  = '/api/shop/cart!listByIds.do?cartIds='.implode('&cartIds=',$cartIds);
        $query = array();
        $data = $this->http_curl($path,$query,'post',false,true,'form_params');
        return $data;
    }

    //立即购买
    public function getOrderDirectBuy($from){
        $path  = '/api/shop/order!directBuy.do';
        $query = $from;
        $data = $this->http_curl($path,$query);
        return $data;
    }

}