<?php

namespace App\Http\Controllers\Front;
use App\Service\Api\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddressController extends Controller
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function index(){
        $addresslist = $this->service->getAddressList();
        $name = trans('front/system.address');
        return view('front.address.list')->with(compact('addresslist','name'));
    }

    public function store(Request $request){
        $responseData = $this->service->getAddressStore($request->all());
        return response()->json($responseData);
    }

    public function update(Request $request,$id){
        $from = $request->all();
        $from['id'] = $id;
        $responseData = $this->service->getAddressEdit($from);
        return response()->json($responseData);
    }

    public function destroy($id)
    {
        $responseData = $this->service->getAddressDelete($id);
        return response()->json($responseData);
    }

    public function defaddr($id)
    {
        $responseData = $this->service->getAddressDefaddr($id);
        return response()->json($responseData);
    }
}
