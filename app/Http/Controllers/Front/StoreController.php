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
    public function ajaxRegionList(Request $request){
        $pid = $request->get('pid','');
        $region = $this->service->getRegionList($pid);
        foreach ($region as $key => $value) {
            $responseData[$value['id']] = $value['name'];
        }
        return response()->json($responseData);
    }

    //获取门店列表
    public function ajaxStorefront(Request $request){
        $region = $request->get('region','');
        $responseData = $this->service->getStorefrontList($region);
        return response()->json($responseData);
    }

}