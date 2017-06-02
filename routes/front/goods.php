<?php
$router->group(['prefix' => 'goods','middleware' => ['isLogin']],function ($router)
{
	$router->post('buy','GoodsController@buy')->name('goods.buy');
	$router->get('buy','GoodsController@buy')->name('goods.buy');
	$router->post('directBuy','GoodsController@directBuy')->name('goods.directBuy');
	$router->get('checkServiceRadius','GoodsController@checkServiceRadius')->name('goods.checkServiceRadius');
});
$router->get('goods/{productId}','GoodsController@show')->name('goods');