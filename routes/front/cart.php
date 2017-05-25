<?php
$router->group(['prefix' => 'cart'],function ($router)
{
	$router->get('/','CartController@index');
	$router->post('ajaxCartUpdateNum/{cartId}','CartController@ajaxCartUpdateNum')->name('cart.ajaxCartUpdateNum');
	$router->post('ajaxCartDelete','CartController@ajaxCartDelete')->name('cart.ajaxCartDelete');
});