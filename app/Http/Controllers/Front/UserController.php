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
}
