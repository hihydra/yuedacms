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
        //dd($carts);
        return view('front.cart.list')->with(compact('carts','name','recommendList'));
    }

    public function ajaxCartUpdateNum(Request $request,$cartId)
    {
        $num = $request->input('num');
        $responseData = $this->service->getCartUpdateNum($cartId,$num);
        return response()->json($responseData);
    }

    public function ajaxCartDelete($cartId)
    {
        $responseData = $this->service->getCartDelete($cartId);
        return response()->json($responseData);
    }
}
