<?php

use App\Service\Api\UserService;


if(!function_exists('flash_info')){
	function flash_info($result,$successMsg = 'success !',$errorMsg = 'something error !')
	{
		return $result ? flash($successMsg,'success')->important() : flash($errorMsg,'danger')->important();
	}
}

if(!function_exists('getUser')){
	function getUser($guards='')
	{
		return auth($guards)->user();
	}
}

if(!function_exists('getUerId')){
	function getUerId()
	{
		return $this->getUser()->id;
	}
}

if(!function_exists('getSettings')){
	function getSettings()
	{
		$key = config('admin.global.blog');

		if (cache()->has($key)) {
			return cache($key);
		}else{
			$settings = settings($key,config('admin.global.setting'));
			cache()->forever($key,$settings);
			return $settings;
		}
	}
}

if(!function_exists('isLogin')){
	function isLogin()
	{
		if(!empty(cookie::get($this->api_sessionid))){
			return true;
		}else{
			return false;
		}

	}
}

if(!function_exists('getUserInfo')){
	function getUserInfo()
	{
		return UserService::getInfo();
	}
}
