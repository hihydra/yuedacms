<?php
$router->group(['prefix' => 'topical'],function ($router)
{
	$router->get('/','TopicalController@index')->name('topical');
});