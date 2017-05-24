<?php
namespace App\Presenters\Front;
use Illuminate\Http\Request;
use App\Service\Api\CartService;
use App\Service\Api\IndexService;

class ApiPresenter
{
    private $index;
    private $cart;

	public function __construct(IndexService $index,CartService $cart){
		$this->index = $index;
		$this->cart  = $cart;
	}

	public function getShowcaseList($type = null){
		if($type == 'cart'){
			$data = $this->cart->getCartRecommendList();
		}else{
			$data = $this->index->getShowcaseList(getStoreId());
		}
		$html = view('front.share.recommend',$data);
		return $html;
	}

	public function getStore($storeId){
		$store = $this->index->getOpenList('','',200);
	}
}