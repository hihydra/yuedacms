<?php
$router->group(['prefix' => 'register'],function ($router)
{
	$router->get('/','RegisterController@index');
	$router->post('register_check','RegisterController@register_check')->name('register.register_check');
	$router->post('ajaxValidcode','RegisterController@ajaxValidcode')->name('register.ajaxValidcode');
});