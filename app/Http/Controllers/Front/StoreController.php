<?php
namespace App\Http\Controllers\Front;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\Api\UserService;
use App\Service\Api\IndexService;
use App\Common\ArrayToolkit;
use Cookie;

class StoreController extends Controller
{
	protected $service;
    protected $index;

	public function __construct(UserService $service,IndexService $index)
	{
		$this->service = $service;
        $this->index = $index;
	}

    public function index(Request $request){
        $storeId = getStoreId();
        $store = $this->index->getOpenList('','',200);
        $storeList = ArrayToolkit::group($store['datas'],'regionAlias');
        $sales = $this->index->getShowcaseSales($storeId);
        $name = trans('front/system.store');

        return view('front.store.index')->with(compact('name','sales','storeList','storeId'));
    }

    public function switchStore($storeId,$storeName){
        $storeId = Cookie::forever('storeId',$storeId);
        $storeName = Cookie::forever('storeName',$storeName);
        return redirect('/')->withCookie($storeId)->withCookie($storeName);
    }

    //获取区域列表
    public function ajaxRegionList(){;
        $responseData = $this->service->getRegionList();
        return response()->json($responseData);
    }

    //获取门店列表
    public function ajaxStorefront($regionId){
        $responseData = $this->service->getStorefrontList($regionId);
        return response()->json($responseData);
    }

}