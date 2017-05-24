<?php
$router->group(['prefix' => 'store'],function ($router)
{
	$router->get('/','StoreController@index')->name('store');
	$router->get('ajaxRegionList','StoreController@ajaxRegionList')->name('store.ajaxRegionList');
	$router->get('ajaxStorefront/{regionId}','StoreController@ajaxStorefront')->name('store.ajaxStorefront');
	$router->get('{storeId}/{storeName}','StoreController@switchStore')->name('switchStore');

});