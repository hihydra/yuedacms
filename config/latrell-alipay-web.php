<?php
return [

	// 安全检验码，以数字和字母组成的32位字符。
	'key' => '42jpx2wnwouzibn42wxcmewu72gb1t9a',

	//签名方式
	'sign_type' => 'md5',

	// 服务器异步通知页面路径。
	'notify_url' => 'http://edu.fezo.com.cn:9011/api/shop/s_alipayDirectPlugin_payment-callback.do',

	// 页面跳转同步通知页面路径。
	'return_url' => ''
];
