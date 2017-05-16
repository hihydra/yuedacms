<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\Api\UserService;
use Cookie;

class LoginController extends Controller
{
	  protected $service;

  	public function __construct(UserService $service)
  	{
  		  $this->service = $service;
  	}

    //登陆首页
    public function index(){
        return view('front.login.index');
    }

    //提交登陆
    public function login_check(Request $request){
        $mobile = $request->input('mobile','13986287787');
        $password = $request->input('password','123456');
        $resultData = $this->service->getLogin($mobile,$password);
        if($resultData['result'] == 1){
          Cookie::forever('API_SESSIONID',$resultData['API_SESSIONID']);
          $this->setStoreId();
        }
        return response()->json($resultData);
    }

    public function setStoreId(){
        $userInfo = $this->service->getInfo(false);
        if(empty($userInfo['storeId'])){
            $userInfo['storeId'] = config('settings.storeId');
        }
        return  Cookie::forever('storeId',$userInfo['storeId']);
    }

    //忘记密码
    public function resetPassword(){
        return view('front.login.resetPassword');
    }

    //忘记密码提交
    public function resetPassword_check(Request $request){
       $mobile = $request->input('mobile');
       $password = $request->input('password');
       $validcode = $request->input('validcode');
       $responseData = $this->service->getResetPassword($mobile,$password,$validcode);
       return response()->json($responseData);
    }

    //忘记密码验证码
    public function ajaxValidcodeByMobile(Request $request){
        $mobile = $request->get('mobile');
        $responseData = $this->service->getValidcodeByMobile($mobile);
        return response()->json($responseData);
    }

    //退出登陆
    public function login_out(){
       return redirect('login')->withCookie(cookie()->forget('API_SESSIONID'));
    }
}