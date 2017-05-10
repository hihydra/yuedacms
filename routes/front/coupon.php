<?php
$router->group(['prefix' => 'coupon','middleware' => ['isLogin']],function ($router)
{
	$router->get('/','CouponController@show')->name('coupon');
	$router->get('obtain/{id}','CouponController@obtain');
});