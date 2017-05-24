<?php
namespace App\Http\Controllers\Front;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\Api\CouponService;

class CouponController extends Controller
{
	protected $service;

	public function __construct(CouponService $service)
	{
		$this->service = $service;
	}

    public function index(Request $request)
    {
        $storeId = getStoreId();
        $anchor = $request->input('anchor');
        $coupons = $this->service->getCouponList($storeId,$anchor);
        $name = trans('front/system.coupon');
    	return view('front.coupon.list')->with(compact('coupons','name'));
    }

    public function ajaxObtain($id){
        $responseData = $this->service->getCouponObtain($id);
        return response()->json($responseData);
    }
}