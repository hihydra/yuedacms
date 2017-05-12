<?php
$router->group(['prefix' => 'showcase'],function ($router)
{
	$router->get('{type}','ShowcaseController@index')->name('showcase');
});