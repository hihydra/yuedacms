<?php
$router->group(['prefix' => 'category'],function ($router)
{
	$router->get('/','CategoryController@show')->name('category');
});