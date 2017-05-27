<?php
$router->group(['prefix' => 'goods','middleware' => ['isLogin']],function ($router)
{
	$router->post('/','GoodsController@index')->name('goods');
	$router->get('/','GoodsController@index')->name('goods');
	$router->post('directBuy','GoodsController@directBuy')->name('goods.directBuy');
	$router->get('checkServiceRadius','GoodsController@checkServiceRadius')->name('goods.checkServiceRadius');
});