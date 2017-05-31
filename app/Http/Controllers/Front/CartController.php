<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\Api\CartService;

class CartController extends Controller
{
    protected $service;

    public function __construct(CartService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $carts = $this->service->getCartList();
        $recommendList = $this->service->getCartRecommendList();
        $name = trans('front/system.cart');
        return view('front.cart.list')->with(compact('carts','name','recommendList'));
    }

    public function ajaxAdd(Request $request)
    {
        $num = $request->input('num');
        $productId = $request->input('productId');
        $storeId = getStoreId();
        $responseData = $this->service->getCartAdd($productId,$num,$storeId);
        return response()->json($responseData);
    }

    public function ajaxCartUpdateNum(Request $request,$cartId)
    {
        $num = $request->input('num');
        $responseData = $this->service->getCartUpdateNum($cartId,$num);
        return response()->json($responseData);
    }

    public function ajaxCartDelete(Request $request)
    {
        $cartIds = $request->input('cartIds');
        $responseData = $this->service->getCartDelete($cartIds);
        return response()->json($responseData);
    }
}
