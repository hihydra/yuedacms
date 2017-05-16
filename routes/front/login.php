<?php
$router->group(['prefix' => 'login'],function ($router)
{
	$router->get('/','LoginController@index');
    $router->post('login_check','LoginController@login_check')->name('login.login_check');
	$router->get('resetPassword','LoginController@resetPassword')->name('login.resetPassword');
	$router->post('resetPassword_check','LoginController@resetPassword_check')->name('login.resetPassword_check');
	$router->post('ajaxValidcodeByMobile','LoginController@ajaxValidcodeByMobile')->name('login.ajaxValidcodeByMobile');
});
$router->get('login_out','LoginController@login_out')->name('login_out');