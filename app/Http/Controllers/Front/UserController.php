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
        $result = $this->service->getInfo();
        $result['name'] = trans('front/system.setting');
        return view('front.user.index')->with($result);
    }

    public function saveInfo(Request $request){
        $superiorCode = $request->input('superiorCode');
        if(!empty($superiorCode)){
            $responseData = $this->service->bindSuperior($superiorCode);
            if($responseData['result'] != 1){
                return response()->json($responseData);
            }
        }
        $responseData = $this->service->getSaveInfo($request->all());
        return response()->json($responseData);
    }

    public function safe(){
        $result = $this->service->getInfo();
        $result['name'] = trans('front/system.setting');
        return view('front.user.safe')->with($result);
    }

    public function ajaxSetPic(Request $request){
        $responseData = $this->service->getSetPic($request->all());
        return response()->json($responseData);
    }
    //分享
    public function share()
    {
        $name = trans('front/system.share');
        return view('front.user.share')->with(compact('name'));
    }

    //意见反馈
    public function suggest(){
        $name = trans('front/system.suggest');
        return view('front.user.suggest')->with(compact('name'));
    }
    //意见反馈提交
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
    //修改密码
    public function ajaxChangePassword(Request $request){
        $oldpassword = $request->input('oldpassword');
        $newpassword = $request->input('newpassword');
        $responseData = $this->service->getChangePassword($oldpassword,$newpassword);
        return response()->json($responseData);
    }
}
