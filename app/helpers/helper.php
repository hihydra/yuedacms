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

if(!function_exists('defaultImg')){
	function defaultImg()
	{
		return config('settings.defaultImg');
	}
}

if(!function_exists('isLogin')){
	function isLogin()
	{
		if(!empty(cookie::get(env('api_sessionid')))){
			return true;
		}else{
			return false;
		}

	}
}


if(!function_exists('getStoreId')){
	function getStoreId()
	{
		if(!empty(Cookie::get('storeId'))){
			return Cookie::get('storeId');
		}else{
			return config('settings.storeId');
		}
	}
}

if(!function_exists('orderStatus')){
	function orderStatus($status)
	{
		switch ($status) {
			case 'STATUS_UNKNOWN':
				return '未知';
				break;
			case 'STATUS_NOT_CONFIRM':
				return '待确认';
				break;
			case 'STATUS_NOT_PAY':
				return '待付款';
				break;
			case 'STATUS_WAIT_SHIP':
				return '待发货';
				break;
			case 'STATUS_SHIPPING':
				return '待收货';
				break;
			case 'STATUS_COMPLETE':
				return '已完成';
				break;
			case 'STATUS_CANCEL':
				return '已取消';
				break;
		}
	}
}


if(!function_exists('paymentType')){
	function paymentType($type)
	{
		switch ($type) {
			case 'online':
				return '在线支付';
				break;
			case 'cod':
				return '货到付款';
				break;
		}
	}
}