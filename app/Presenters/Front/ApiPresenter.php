<?php
namespace App\Presenters\Front;
use Illuminate\Http\Request;
use App\Service\Api\UserService;
use App\Service\Api\CartService;
use App\Service\Api\IndexService;

class ApiPresenter
{
    private $index;

	public function __construct(IndexService $index){
		$this->index = $index;
	}

	public function getShowcaseList(){
		$data = $this->index->getShowcaseList(getStoreId());
		$html = view('front.share.recommend',$data);
		return $html;
	}
}