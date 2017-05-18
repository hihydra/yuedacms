<?php

namespace App\Http\Controllers\Front;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\Api\UserService;

class RegisterController extends Controller
{
	protected $service;

	public function __construct(UserService $service)
	{
		$this->service = $service;
	}

    //注册首页
    public function index(){
        $regionList = $this->service->getRegionList();
        return view('front.register.index')->with(compact('regionList'));
    }

    //注册提交
    public function register_check(Request $request){
    	$responseData = $this->service->getRegister($request->all());
    	return response()->json($responseData);
    }

    //获取验证码
    public function ajaxValidcode(Request $request){
    	$mobile = $request->get('mobile');
    	$random = md5($mobile.env('SECRETKRY'));
    	$responseData = $this->service->getRegisterValidcode($mobile,$random);
    	return response()->json($responseData);
    }

}