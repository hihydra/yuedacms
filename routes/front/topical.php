<?php
$router->group(['prefix' => 'topical'],function ($router)
{
	$router->get('/','TopicalController@show')->name('topical');
});