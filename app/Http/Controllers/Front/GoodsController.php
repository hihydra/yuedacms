<?php
namespace App\Http\Controllers\Front;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\Api\UserService;
use App\Service\Api\GoodsService;
use App\Service\Api\CouponService;
use App\Common\ArrayToolkit;

class GoodsController extends Controller
{
	protected $service;
    protected $user;
    protected $coupon;

    public function __construct(GoodsService $service,UserService $user,CouponService $coupon)
    {
      $this->service = $service;
      $this->user = $user;
      $this->coupon = $coupon;
    }

    public function show(Request $request,$goodsId){
        $storeId = getStoreId();
        $goodList = $this->service->getGoods($storeId,$goodsId);
        return view('front.goods.show',$goodList);
    }

    public function ajaxComment(Request $request,$goodsId){
        $storeId = getStoreId();
        $anchor = $request->input('anchor');
        $commentList = $this->service->getCommentList($storeId,$goodsId,$anchor);
        $responseData = (string)(view('front.goods.comment',$commentList));
        return response()->json(array('result' =>$this->service->CODE_SUCCESS,'data'=>$responseData));
    }

    public function buy(Request $request)
    {
        if($request->has('cartIds')){
            $cartIds = $request->input('cartIds');
            $goodList = $this->service->getCartListByIds($cartIds);
            $name = trans('front/system.goods');
            $type = 'cart';
        }else if($request->has('productId')){
            $storeId = getStoreId();
            $productId = $request->input('productId');
            $good = $this->service->getGoodsDetail($productId,$storeId);
            $good['num'] = $request->input('num',1);
            $good['goodsId'] = $good['id'];
            $good['productId'] = $productId;
            $items[] = $good;
            $id = $storeId;
            $goodList[] = compact('items','id');
            $name = trans('front/system.goods');
            $type = 'direct';
        }
        $goodList = $this->getCouponsByOrder($goodList);
        $addressList = $this->user->getAddressList();
        $isPresale = $request->input('isPresale','false');
        return view('front.goods.buy')->with(compact('goodList','name','type','addressList','isPresale'));
    }

    public function directBuy(Request $request)
    {
        $form = array_only($request->all(), ['receiver','receiverMobile','receiverAddress','lng','lat','shippingMethod','storeId','paymentType','addressId','num','productId']);
        $form['otherInfo'] = json_encode($request->input('otherInfo'));
        $snLs = $this->service->getOrderDirectBuy($form);
        return redirect('order/pay?snLs[]='.implode('&snLs[]=',$snLs));
    }

    //获取订单可用优惠券列表
    private function getCouponsByOrder($goodList){
        foreach ($goodList as &$cart) {
            $goodsPrice = 0;
            foreach ($cart['items'] as $key=>$item) {
                $goods[$key]['id'] =  $item['goodsId'];
                $goods[$key]['price'] = $item['price'] * $item['num'];
                $goodsPrice +=$item['price'] * $item['num'];
            }
            if($goodsPrice > 58){
                $freight = 0;
            }else{
                $freight = 10;
            }
            $storeId = $cart['id'];
            $json[]=compact('goods','freight','storeId');
            $cart['goodsPrice'] = $goodsPrice;
            $cart['freight']  = $freight;
        }
        $coupons = $this->coupon->getCouponsByOrder(json_encode($json));
        $coupons = ArrayToolkit::index($coupons,'storeId');
        $goodList = ArrayToolkit::index($goodList,'id');
        foreach ($coupons as $key=>$coupon) {
            $goodList[$key]['coupons'] = $coupon['coupons'];
        }
        return $goodList;
    }

    public function checkServiceRadius(Request $request){
        $storeId = getStoreId();
        $lng = $request->input('lng');
        $lat = $request->input('lat');

        $responseData = $this->service->checkServiceRadius($storeId,$lng,$lat);
        return response()->json($responseData);
    }
}