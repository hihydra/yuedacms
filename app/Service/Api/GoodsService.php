<?php
namespace App\Service\Api;


//商品购买相关接口
class GoodsService extends BaseService
{
    //商品详情
    public function getGoods($storeId,$goodsId){
        $path  = '/api/shop/wap!goodsDetailWeb.do';
        $query = array('goodsId'=>$goodsId,'storeId'=>$storeId);
        $data = $this->http_curl($path,$query);
        return $data;
    }

    //商品评论
    public function getCommentList($storeId,$goodsId,$anchor=null){
        $path  = '/api/shop/comment!list.do';
        $query = array('goodsId'=>$goodsId,'storeId'=>$storeId,'anchor'=>$anchor);
        $data = $this->http_curl($path,$query);
        return $data;
    }

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
        $data = $this->http_curl($path,$query,'post',true);
        return $data;
    }

    //立即购买商品列表
    public function getCartListByIds($cartIds){
        $path  = '/api/shop/cart!listByIds.do?cartIds='.implode('&cartIds=',$cartIds);
        $query = array();
        $data = $this->http_curl($path,$query,'post',false,false,'form_params');
        return $data;
    }

    //立即购买
    public function getOrderDirectBuy($form){
        $path  = '/api/shop/order!directBuy.do';
        $query = $form;
        $data = $this->http_curl($path,$query,'post');
        return $data;
    }

}