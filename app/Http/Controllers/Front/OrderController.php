<?php

namespace App\Http\Controllers\Front;
use App\Service\Api\OrderService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\UploadTrait;
use URL;

class OrderController extends Controller
{
    use UploadTrait;
    protected $service;

    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request){
        $anchor = $request->input('anchor','');
        $status = $request->input('status','');
        $counts = $this->service->getOrderCounts();
        $name = trans('front/system.order');
        if($status == 'STATUS_AFTERSALES'){
           $orders = $this->service->getAfterSalesList($anchor);
           return view('front.order.afterSales')->with(compact('orders','name','counts'));
        }else{
           $orders = $this->service->getOrderList($anchor,$status);
           return view('front.order.list')->with(compact('orders','name','counts'));
        }
    }

    public function show($sn){
        $result = $this->service->getOrderDetail($sn);
        $result['expressInfo'] = $this->service->getOrderExpressInfo($sn);
        $result['name'] = trans('front/system.orderDetail');
        return view('front.order.show')->with($result);
    }

    public function store(Request $request){
        $form = array_only($request->all(), ['shippingMethod','storeId','paymentType','addressId','otherInfo']);
        $form['otherInfo'] = json_encode($request->input('otherInfo'));
        $cartIds = $request->input('cartIds');
        $snLs = $this->service->getOrderCreate($cartIds,$form);
        return redirect('order/pay?snLs[]='.implode('&snLs[]=',$snLs));
    }

    public function pay(Request $request){
        $snLs = $request->input('snLs');
        $sn = array_first($snLs);
        $order = $this->service->getOrderDetail($sn);
        if($order['status'] != 'STATUS_NOT_PAY'){
            return redirect('order/'.$sn);
        }
        $name = trans('front/system.pay');

        $payInfoData = $this->service->getZhiFuBao($snLs);
        parse_str(preg_replace('/\"/', '', $payInfoData['payInfo']));
        $paylink = $this->service->getPayLink($snLs);
        return view('front.order.pay')->with(compact('paylink','name','total_fee'));
    }

    public function afterSalesDetail($id){
        $data = $this->service->getAfterSalesDetail($id);
        $data['name'] = trans('front/system.afterSalesDetail');
        return view('front.order.afterSalesDetail')->with($data);
    }

    public function comment($orderId){
        $items = $this->service->getWaitCommentGoods($orderId);
        $name = trans('front/system.comment');
        return view('front.order.comment')->with(compact('items','name','orderId'));
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

    public function commentAdd(Request $request){
        $data = $request->all();
        if (!empty($data['file'])) {
            $filePath = $this->uploadApiImage($data['file']);
            $filePath = str_replace('\\','/',base_path().'\public'.$filePath);
            $data['file'] = $filePath;
        }
        $responseData = $this->service->getCommentAdd($data);
        return response()->json($responseData);
    }

}
