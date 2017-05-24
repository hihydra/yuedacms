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

    public function index(Request $request)
    {
        $storeId = $request->input('storId');
        $productId = $request->input('productId');
        $good = $this->service->getGoodsDetail($productId,$storeId);
        $good['num'] = $request->input('num');
        $good['goodsId'] = $good['id'];
        $goodList['items'][] = $good;
        $goodList['id'] = $storeId;
        $goodList = $this->getCouponsByOrder(array($goodList));
        $addressList = $this->user->getAddressList();
        $name = trans('front/system.goods');
        return view('front.goods.index')->with(compact('goodList','name','addressList'));
    }

    public function cart(Request $request){
        $cartIds = $request->input('cartIds');
        $cartList = $this->service->getCartListByIds($cartIds);
        $goodList = $this->getCouponsByOrder($cartList);
        $addressList = $this->user->getAddressList();
        $name = trans('front/system.goods');
        //dd(compact('goodList','name','addressList'));
        return view('front.goods.index')->with(compact('goodList','name','addressList'));
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
        $storId = getStoreId();
        $lng = $request->input('lng');
        $lat = $request->input('lat');

        $responseData = $this->service->checkServiceRadius($storeId,$lng,$lat);
        return response()->json($responseData);
    }
}