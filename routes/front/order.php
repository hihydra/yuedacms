<?php
$router->group(['prefix' => 'order'],function ($router)
{
	$router->get('/','OrderController@index')->name('order');
	$router->get('{sn}','OrderController@show');
	$router->get('expressInfo/{sn}','OrderController@expressInfo');
	$router->get('shippingType/{regionid}','OrderController@shippingType');
	$router->post('/','OrderController@store');
	$router->post('ajaxCancel/{sn}','OrderController@ajaxCancel');
	$router->post('ajaxDelete/{sn}','OrderController@ajaxDelete');
	$router->post('rogConfirm/{sn}','OrderController@rogConfirm');
});