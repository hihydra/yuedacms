<?php
$router->group(['prefix' => 'register'],function ($router)
{
	$router->get('/','RegisterController@index');
	$router->post('register','RegisterController@register');
	$router->get('ajaxValidcode','RegisterController@ajaxValidcode')->name('register.ajaxValidcode');
});