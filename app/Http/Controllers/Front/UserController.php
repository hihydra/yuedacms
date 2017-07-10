<?php

namespace App\Http\Controllers\Front;
use App\Service\Api\UserService;
use App\Service\Api\CouponService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\ArrayToolkit;
use App\Traits\UploadTrait;
use url;

class UserController extends Controller
{
    use UploadTrait;
    protected $service;
    protected $coupon;

    public function __construct(UserService $service,CouponService $coupon){
        $this->service = $service;
        $this->coupon = $coupon;
    }

    public function index(){
        $result = $this->service->getInfo();
        $result['regionList'] = $this->service->getRegionList();
        $result['name'] = trans('front/system.setting');
        return view('front.user.index')->with($result);
    }

    public function saveInfo(Request $request){
        $data = $request->all();
        if (!empty($data['file'])) {
            if($data['w']){
                $crop = array_only($data,['w','h','x','y']);
            }else{
                $crop = '';
            }

            $filePath = $this->uploadApiImage($data['file'],$crop);
            $filePath = str_replace('\\','/',base_path().'\public'.$filePath);
            $this->service->getSetPic($filePath);
        }
        $superiorCode = $request->input('superiorCode');
        if(!empty($superiorCode)){
            $responseData = $this->service->bindSuperior($superiorCode);
        }
        $responseData = $this->service->getSaveInfo($request->all());
        return redirect('user');
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

    //我的礼券
    public function myCoupons(Request $request){
        $status = $request->input('status','STATUS_UNUSED');
        $anchor = $request->input('anchor','');
        $coupons = $this->coupon->getMyCoupons($status,$anchor,12);
        $name = trans('front/system.myCoupons');
        return view('front.user.myCoupons')->with(compact('name','coupons','status'));
    }

    //修改手机号
    public function changeMobile(){
        return view('front.login.changeMobile');
    }

    //修改手机号提交
    public function changeMobile_check(Request $request){
       $mobile = $request->input('mobile');
       $validcode = $request->input('validcode');
       $responseData = $this->service->getChangeMobile($mobile,$validcode);
       return response()->json($responseData);
    }

    //修改密码验证码
    public function ajaxValidcode(){
        $responseData = $this->service->getValidcode();
        return response()->json($responseData);
    }

    //修改密码
    public function ajaxChangePassword(Request $request){
        $oldpassword = $request->input('oldpassword');
        $newpassword = $request->input('newpassword');
        $responseData = $this->service->getChangePassword($oldpassword,$newpassword);
        return response()->json($responseData);
    }
}
