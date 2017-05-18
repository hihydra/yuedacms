<?php
namespace App\Http\Controllers\Front;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\Api\UserService;
class StoreController extends Controller
{
	protected $service;

	public function __construct(UserService $service)
	{
		$this->service = $service;
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