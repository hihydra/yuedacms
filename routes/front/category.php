<?php
$router->group(['prefix' => 'category'],function ($router)
{
	$router->get('/','CategoryController@index')->name('category');
});