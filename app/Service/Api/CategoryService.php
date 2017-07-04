<?php
namespace App\Service\Api;


//分类相关接口
class CategoryService extends BaseService
{
    //获取分类列表
    public function getCatList(){
        $path  = '/api/shop/goods!catList.do';
        $query = array();
        $data = $this->http_curl($path,$query);
        return $data;
    }

    //分类商品搜索
    public function getGoodsList($storeId=NULL,$catId=NULL,$anchor=NULL,$keyword=NULL,$sort='SORT_TIME',$isAsc=false,$pageSize=null){
        $path  = '/api/shop/goods!search.do';
        $query = array('storeId'=>$storeId,'catId'=>$catId,'anchor'=>$anchor,'keyword'=>$keyword,'sort'=>$sort,'isAsc'=>$isAsc,'pageSize'=>$pageSize);
        $data = $this->http_curl($path,$query);
        return $data;
    }

}