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
        $storeId = $request->input('storeId',getStoreId());
    	$resultData = $this->service->getIndex($storeId);
        $resultData['storeId'] = $storeId;
    	return view('front.index.index')->with($resultData);
    }

    public function search()
    {
        $result = $this->service->search(request('q',''));
        if ($result) {
            return view('front.index.search')->with($result);
        }
        return redirect('/');
    }
}