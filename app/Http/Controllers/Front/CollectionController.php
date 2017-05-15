<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\Api\CollectionService;

class CollectionController extends Controller
{
  	protected $service;

  	public function __construct(CollectionService $service)
  	{
  		 $this->service = $service;
  	}

    //已收藏的商品列表
    public function goodsLike(Request $Request){
       $anchor = $Request->input('anchor');
       $result = $this->service->getGoodsLikeList($anchor);
       $result['name'] = trans('front/system.collection');
       return view('front.collection.goods')->with($result);
    }

    //收藏商品
    public function ajaxGoodsLike($goodsId,$specialId){
      $responseData = $this->service->getGoodsLike($goodsId,$specialId);
      return response()->json($responseData);
    }

    //取消收藏商品
    public function ajaxGoodsUnlike($goodsId){
      $responseData = $this->service->getGoodsUnlike($goodsId);
      return response()->json($responseData);
    }

    //已收藏的专题列表
    public function specialLike(Request $Request){
       $anchor = $Request->input('anchor');
       $result = $this->service->getSpecialLikeList($anchor);
       $result['name'] = trans('front/system.collection');
       //dd($result);
       return view('front.collection.special')->with($result);
    }

    //收藏专题
    public function ajaxSpecialLike($specialId){
      $responseData = $this->service->getSpecialLike($specialId);
      return response()->json($responseData);
    }

    //取消收藏专题
    public function ajaxSpecialUnlike($specialId){
      $responseData = $this->service->getSpecialUnlike($specialId);
      return response()->json($responseData);
    }
}