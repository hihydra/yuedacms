<?php
$router->group(['prefix' => 'coupon','middleware' => ['isLogin']],function ($router)
{
	$router->get('/','CouponController@index')->name('coupon');
	$router->post('ajaxObtain/{id}','CouponController@ajaxObtain')->name('ajaxObtain');
});