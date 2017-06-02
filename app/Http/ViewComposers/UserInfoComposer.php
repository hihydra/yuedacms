<?php
namespace App\Http\ViewComposers;
use Illuminate\View\View;
use App\Service\Api\UserService;
use App\Service\Api\CartService;
use Cookie;

class UserInfoComposer
{
	protected $user;
    protected $cart;

	public function __construct(UserService $user,CartService $cart){
		$this->user = $user;
        $this->cart = $cart;
	}

    public function compose(View $view)
    {
    	$data = $this->user->getInfo(true);
        if($data['result'] == $this->user->CODE_SUCCESS){
            $userInfo = $data['data'];
            $cartCount = $this->cart->getCartCount();
            $userInfo['cartCount'] = $cartCount['count'];
        }else{
            $userInfo = false;
        }
		$view->with('userInfo',$userInfo);
    }
}