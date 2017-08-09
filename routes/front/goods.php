<?php
$router->group(['prefix' => 'goods','middleware' => ['isLogin']],function ($router)
{
	$router->post('buy','GoodsController@buy')->name('goods.buy');
	$router->get('buy','GoodsController@buy')->name('goods.buy');
	$router->post('directBuy','GoodsController@directBuy')->name('goods.directBuy');
	$router->post('checkServiceRadius','GoodsController@checkServiceRadius')->name('goods.checkServiceRadius');
});
$router->get('goods/ajaxComment/{goodsId}','GoodsController@ajaxComment')->name('goods.ajaxComment');
$router->get('goods/{goodsId}','GoodsController@show')->name('goods');