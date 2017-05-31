<?php
$router->group(['prefix' => 'goods','middleware' => ['isLogin']],function ($router)
{
	$router->get('{productId}','GoodsController@show')->name('goods');
	$router->post('buy','GoodsController@buy')->name('goods.buy');
	$router->get('buy','GoodsController@buy')->name('goods.buy');
	$router->post('directBuy','GoodsController@directBuy')->name('goods.directBuy');
	$router->get('checkServiceRadius','GoodsController@checkServiceRadius')->name('goods.checkServiceRadius');
});