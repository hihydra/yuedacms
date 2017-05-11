<?php
$router->group(['prefix' => 'login'],function ($router)
{
	$router->get('/','LoginController@index');
    $router->get('login_check','LoginController@login_check')->name('login.login_check');
	$router->get('changePassword','LoginController@changePassword')->name('login.changePassword');
	$router->post('changePassword_check','LoginController@changePassword_check')->name('login.changePassword_check');
	$router->get('resetPassword','LoginController@resetPassword')->name('login.resetPassword');
	$router->post('resetPassword_check','LoginController@resetPassword_check')->name('login.resetPassword_check');
	$router->get('ajaxValidcodeByMobile','LoginController@ajaxValidcodeByMobile')->name('login.ajaxValidcodeByMobile');
	$router->get('login_out','LoginController@login_out')->name('login.login_out');
});