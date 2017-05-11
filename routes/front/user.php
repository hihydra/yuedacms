<?php
$router->group(['prefix' => 'user','middleware' => ['isLogin']],function ($router)
{
	$router->get('ajaxSetPic','UserController@ajaxSetPic')->name('user.ajaxSetPic');
	$router->get('suggest','UserController@suggest')->name('user.suggest');
	$router->post('ajaxSuggestSave','UserController@ajaxSuggestSave')->name('user.ajaxSuggestSave');
	$router->get('changeMobile','UserController@changeMobile')->name('user.changeMobile');
	$router->get('ajaxValidcode','UserController@ajaxValidcode')->name('user.ajaxValidcode');
	$router->post('changeMobile_check','UserController@changeMobile_check')->name('user.changeMobile_check');
});
$router->resource('user','UserController');
