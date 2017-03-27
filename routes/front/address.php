<?php
$router->group(['prefix' => 'address','middleware' => ['isLogin']],function ($router)
{
	$router->get('defaddr/{id}','AddressController@defaddr');
});
$router->resource('address','AddressController');
