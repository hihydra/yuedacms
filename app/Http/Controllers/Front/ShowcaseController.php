<?php
namespace App\Http\Controllers\Front;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\Api\IndexService;
class ShowcaseController extends Controller
{
	protected $service;

	public function __construct(IndexService $service)
	{
		$this->service = $service;
	}

    public function index(Request $request,$type)
    {
        $storeId = getStoreId();
        $anchor = $request->input('anchor');
        switch ($type) {
            case 'recommend':
                $goods = $this->service->getRecommend($storeId,$anchor);
                $name = trans('front/system.recommend');
                break;
            case 'sales':
                $goods = $this->service->getShowcaseSales($storeId,$anchor);
                $name = trans('front/system.sales');
                break;
            case 'special':
                $goods = $this->service->getListByStore($storeId,$anchor);
                $name = trans('front/system.special');
                break;
        }
    	return view('front.showcase.list')->with(compact('goods','name','type'));
    }
}