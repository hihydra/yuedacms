<?php
namespace App\Http\Controllers\Front;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\Api\IndexService;
use url;

class IndexController extends Controller
{
	protected $service;

	public function __construct(IndexService $service)
	{
		$this->service = $service;
	}

    public function index(Request $request)
    {
        $storeId = getStoreId();
    	$resultData = $this->service->getIndex($storeId);
    	return view('front.index.index')->with($resultData);
    }
}