<?php
$router->group(['prefix' => 'coupon','middleware' => ['isLogin']],function ($router)
{
	$router->get('/','CouponController@show')->name('coupon');
	$router->post('ajaxObtain','CouponController@ajaxObtain')->name('ajaxObtain');
});