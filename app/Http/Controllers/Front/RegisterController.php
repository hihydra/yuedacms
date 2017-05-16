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
        return view('front.register.index');
    }

    //注册提交
    public function register_check(Request $request){
    	$resultData = $this->service->getRegister($request->all());
    	return redirect('front.index');
    }

    //获取验证码
    public function ajaxValidcode(Request $request){
    	$region = $request->get('mobile');
    	$random = md5($region.env('SECRETKRY'));
    	$responseData = $this->service->getRegisterValidcode($mobile,$random);
    	return response()->json($responseData);
    }

}