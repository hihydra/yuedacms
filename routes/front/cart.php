<?php
$router->group(['prefix' => 'cart','middleware' => ['isLogin']],function ($router)
{
	$router->get('/','CartController@index');
	$router->post('ajaxAdd','CartController@ajaxAdd')->name('cart.ajaxAdd');
	$router->post('ajaxCartUpdateNum/{cartId}','CartController@ajaxCartUpdateNum')->name('cart.ajaxCartUpdateNum');
	$router->post('ajaxCartDelete','CartController@ajaxCartDelete')->name('cart.ajaxCartDelete');
});