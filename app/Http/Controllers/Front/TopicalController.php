<?php
namespace App\Http\Controllers\Front;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\Api\IndexService;
use App\Common\ArrayToolkit;
use URL;

class TopicalController extends Controller
{
	protected $service;

	public function __construct(IndexService $service)
	{
		$this->service = $service;
	}

    public function show(Request $request)
    {
    	$storeId = $request->input('storeId',getStoreId());
    	$anchor = $request->input('anchor');
    	$topicalList = $this->service->getTopicalList($storeId);
        $topicalList = ArrayToolkit::index($topicalList,'id');
    	$topicalFist = reset($topicalList);
    	$topicalId = $request->input('topicalId',$topicalFist['id']);
    	$topicalGoods = $this->service->getTopicalGoods($storeId,$topicalId,$anchor);
        $urlPath = compact('storeId','topicalId','anchor');
    	$name = '主题广场';
    	return view('front.topical.list')->with(compact('topicalList','topicalGoods','name','urlPath'));
    }
}