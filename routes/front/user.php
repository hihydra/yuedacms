<?php
$router->group(['prefix' => 'user','middleware' => ['isLogin']],function ($router)
{
	$router->get('/','UserController@index')->name('user');
	$router->get('safe','UserController@safe')->name('user.safe');
	$router->post('saveInfo','UserController@saveInfo')->name('user.saveInfo');
	$router->get('ajaxSetPic','UserController@ajaxSetPic')->name('user.ajaxSetPic');
	$router->get('share','UserController@share')->name('share');
	$router->get('suggest','UserController@suggest')->name('user.suggest');
	$router->post('ajaxSuggestSave','UserController@ajaxSuggestSave')->name('user.ajaxSuggestSave');
	$router->get('changeMobile','UserController@changeMobile')->name('user.changeMobile');
	$router->post('ajaxValidcode','UserController@ajaxValidcode')->name('user.ajaxValidcode');
	$router->post('changeMobile_check','UserController@changeMobile_check')->name('user.changeMobile_check');
	$router->post('ajaxChangePassword','UserController@ajaxChangePassword')->name('user.ajaxChangePassword');
	//我的礼券
	$router->get('myCoupons','UserController@myCoupons')->name('user.myCoupons');
	//收货地址
	$router->resource('address','AddressController');
	$router->post('address/defaddr/{id}','AddressController@defaddr');
	//收藏
	$router->get('collection','CollectionController@goodsLike');
	$router->get('collection/specialLike','CollectionController@specialLike');
	$router->post('ajaxGoodsLike/{goodsId}/{specialId}','CollectionController@ajaxGoodsLike')->name('user.Collection.ajaxGoodsLike');
	$router->post('ajaxGoodsUnlike/{goodsId}','CollectionController@ajaxGoodsUnlike')->name('user.Collection.ajaxGoodsUnlike');
	$router->post('ajaxSpecialLike/{specialId}','CollectionController@ajaxCartUpdateNum')->name('user.Collection.ajaxSpecialLike');
	$router->post('ajaxSpecialUnlike/{specialId}','CollectionController@ajaxSpecialUnlike')->name('user.Collection.ajaxSpecialUnlike');
});