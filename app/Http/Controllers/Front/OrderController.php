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
        if($status == 'STATUS_AFTERSALES'){
           $orders = $this->service->getAfterSalesList($anchor);
        }else{
           $orders = $this->service->getOrderList($anchor,$status);
        }
        $counts = $this->service->getOrderCounts();
        $name = trans('front/system.order');
        return view('front.order.list')->with(compact('orders','name','counts'));
    }

    public function show($sn){
        $result = $this->service->getOrderDetail($sn);
        $result['expressInfo'] = $this->service->getOrderExpressInfo($sn);
        $result['name'] = trans('front/system.orderDetail');
        //dd($result);
        return view('front.order.show')->with($result);
    }

    public function store(Request $request){
        $form = array_only($request->all(), ['shippingMethod','storeId','paymentType','addressId','otherInfo']);
        $form['otherInfo'] = json_encode($request->input('otherInfo'));
        $cartIds = $request->input('cartIds');
        $snLs = $this->service->getOrderCreate($cartIds,$form);
        return redirect('order/pay?snLs[]='.implode('snLs[]=',$snLs));
    }

    public function pay(Request $request){
        $snLs = $request->input('snLs');
        $name = trans('front/system.pay');
        $payInfoData = $this->service->getZhiFuBao($snLs);
        parse_str(preg_replace('/\"/', '', $payInfoData['payInfo']));
        $paylink = $this->service->getPayLink($snLs);
        return view('front.order.pay')->with(compact('paylink','name','total_fee'));
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
        $responseData = $this->service->getRogConfirm($sn);
        return response()->json($responseData);
    }

}
