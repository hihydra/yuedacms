<?php
$router->group(['prefix' => 'order','middleware' => ['isLogin']],function ($router)
{
	$router->get('pay','OrderController@pay')->name('order.pay');
	$router->get('afterSalesDetail/{id}','OrderController@afterSalesDetail')->name('order.afterSalesDetail');
	$router->get('/','OrderController@index')->name('order');
	$router->get('{sn}','OrderController@show');
	$router->post('/','OrderController@store');
	$router->post('ajaxCancel/{sn}','OrderController@ajaxCancel');
	$router->post('ajaxDelete/{sn}','OrderController@ajaxDelete');
	$router->post('rogConfirm/{sn}','OrderController@rogConfirm');
});