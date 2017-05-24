<?php
$router->group(['prefix' => 'goods','middleware' => ['isLogin']],function ($router)
{
	$router->get('/','GoodsController@index')->name('goods');
	$router->get('cart','GoodsController@cart')->name('goods.cart');
	$router->get('checkServiceRadius','GoodsController@checkServiceRadius')->name('goods.checkServiceRadius');
});