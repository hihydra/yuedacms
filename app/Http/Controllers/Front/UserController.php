<?php

namespace App\Http\Controllers\Front;
use App\Service\Api\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected $service;

    public function __construct(UserService $service){
        $this->service = $service;
    }

    public function index(){
        $resultData = $this->service->getInfo();
        return view('front.user.index')->with($resultData);
    }

    public function update(Request $request,$id){
        $resultData = $this->service->getSaveInfo($request->all(),$id);
        return redirect('front.user.index');
    }

    public function ajaxSetPic(Request $request){
        $responseData = $this->service->getSetPic($request->all());
        return response()->json($responseData);
    }

    public function suggest(){
        return view('front.user.suggest');
    }

    public function ajaxSuggestSave(Request $request){
        $mobile = $request->input('mobile');
        $content = $request->input('content');
        $responseData = $this->service->getSuggestSave($mobile,$content);
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
}
