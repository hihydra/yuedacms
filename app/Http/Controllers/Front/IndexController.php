<?php
namespace App\Http\Controllers\Front;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\Api\IndexService;
use App\Service\Front\IndexService as FrontService;
use url;

class IndexController extends Controller
{
	protected $service;

	public function __construct(IndexService $service,FrontService $index)
	{
		$this->service = $service;
        $this->index = $index;
	}

    public function index(Request $request)
    {
        $storeId = getStoreId();
    	$resultData = $this->service->getIndex($storeId);
        $resultData['links'] = $this->index->link();

    	return view('front.index.index')->with($resultData);
    }
}