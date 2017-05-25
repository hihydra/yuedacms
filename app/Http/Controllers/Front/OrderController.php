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

    public function store(Request $request){
        $shippingMethod = $request->input('shippingMethod');
        $storeId = $request->input('storeId');
        $paymentType = $request->input('paymentType');
        $addressId = $request->input('addressId');
        $otherInfo = json_encode($request->input('otherInfo'));
        $form = compact('shippingMethod','storeId','paymentType','addressId','otherInfo');
        $cartIds = $request->input('cartIds');
        $resultData = $this->service->getOrderCreate($cartIds,$form);
        return redirect('order/pay?snLs[]='.implode('snLs[]=',$cartIds));
    }

    public function pay(Request $request){
        $snLs = $request->input('snLs');
        $name = trans('front/system.pay');
        $payInfoData = $this->service->getZhiFuBao($snLs);
        parse_str(preg_replace('/\"/', '', $payInfoData['payInfo']));
        return view('front.order.pay')->with(compact('snLs','name','total_fee'));
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
