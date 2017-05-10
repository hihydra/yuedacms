<?php
namespace App\Presenters\Front;
use Illuminate\Http\Request;
use App\Service\Api\UserService;
use App\Service\Api\CartService;
use App\Service\Api\IndexService;

class ApiPresenter
{
    private $user;
    private $cart;
    private $index;

	public function __construct(UserService $user,CartService $cart,IndexService $index){
		$this->user = $user;
		$this->cart = $cart;
		$this->index = $index;
	}

	public function getInfo(){
		$data = $this->user->getInfo();
		return $data;
	}

	public function getCartCount(){
		$data = $this->cart->getCartCount();
		return $data;
	}

	public function getShowcaseList(){
		$data = $this->index->getShowcaseList(getStoreId());
		$html = view('front.share.recommend',$data);
		return $html;
	}
}