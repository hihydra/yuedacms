<?php
$router->group(['prefix' => 'store'],function ($router)
{
	$router->get('ajaxRegionList','StoreController@ajaxRegionList')->name('store.ajaxRegionList');
	$router->get('ajaxStorefront/{regionId}','StoreController@ajaxStorefront')->name('store.ajaxStorefront');
});