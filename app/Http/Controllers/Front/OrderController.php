<?php

namespace App\Http\Controllers\Front;
use App\Service\Api\OrderService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use URL;

class OrderController extends Controller
{
    protected $service;

    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request){
        $anchor = $request->input('anchor','');
        $status = $request->input('status','');
        $orders = $this->service->getOrderList($anchor,$status);
        $name = trans('front/system.order');
        return view('front.order.list')->with(compact('orders','name'));
    }

    public function show($sn){
        $result = $this->service->getOrderDetail($sn);
        $result['expressInfo'] = $this->service->getOrderExpressInfo($sn);
        $result['name'] = trans('front/system.orderDetail');
        return view('front.order.show')->with($result);
    }

    public function expressInfo($sn){
        $resultData = $this->service->getOrderExpressInfo($id);
        return view('front.order.expressInfo')->with($resultData);
    }

    public function shippingType($regionid){
        $resultData = $this->service->getShippingType($regionid);
        return view('front.order.shippingType')->with($resultData);
    }

    public function store($request){
        $resultData = $this->service->getOrderCreate($request->all());
        return redirect('front.order.index');
    }

    public function ajaxCancel($sn){
        $responseData = $this->service->getOrderCancel($sn);
        return response()->json($responseData);
    }

    public function ajaxDelete($sn){
        $responseData = $this->service->getOrderDelete($sn);
        return response()->json($responseData);
    }

    public function rogConfirm($sn){
        $this->service->getRogConfirm($sn);
        return redirect('front.address.index');
    }

}
