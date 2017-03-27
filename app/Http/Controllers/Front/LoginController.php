<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\Api\UserService;

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
        $mobile = $request->input('mobile','18627880278');
        $password = $request->input('password','123456');
        $resultData = $this->service->getLogin($mobile,$password);
        return redirect('/')->withCookie('API_SESSIONID',$resultData->API_SESSIONID);
    }

    //重置密码
    public function changePassword(){
        return view('front.login.changePassword');
    }

    //提交重置密码
    public function changePassword_check(Request $request){
       $oldpassword = $request->input('oldpassword');
       $newpassword = $request->input('newpassword');
       $resultData = $this->service->getChangePassword($oldpassword,$newpassword);
       return redirect('login');
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
       $resultData = $this->service->getResetPassword($mobile,$password,$validcode);
       return redirect('login');
    }

    //忘记密码验证码
    public function ajaxValidcodeByMobile(Request $request){
        $region = $request->get('mobile');
        $responseData = $this->service->getValidcodeByMobile($mobile);
        return response()->json($responseData);
    }

    //修改手机号
    public function changeMobile(){
        return view('front.login.changeMobile');
    }

    //修改手机号验证码
    public function ajaxValidcode(){
        $responseData = $this->service->getValidcode();
        return response()->json($responseData);
    }

    //修改手机号提交
    public function changeMobile_check(Request $request){
       $mobile = $request->input('mobile');
       $validcode = $request->input('validcode');
       $resultData = $this->service->getChangeMobile($mobile,$validcode);
       return redirect('login');
    }

    //退出登陆
    public function login_out(){
       return redirect('/')->withCookie(cookie()->forget('API_SESSIONID'));
    }
}