<?php
$router->group(['prefix' => 'showcase'],function ($router)
{
	$router->get('{type}','ShowcaseController@show')->name('showcase');
});