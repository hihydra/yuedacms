<?php
$router->group(['prefix' => 'showcase'],function ($router)
{
	$router->get('{type}/{id?}','ShowcaseController@index')->name('showcase');
});