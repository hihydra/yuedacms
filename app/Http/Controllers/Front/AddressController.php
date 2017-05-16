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

    public function create()
    {
        return view('front.address.create')->with($resultData);
    }

    public function store(){
        $resultData = $this->service->getAddressStore($request->all());
        return redirect('front.address.index');
    }

    public function update($request,$id){
        $resultData = $this->service->getAddressEdit($request->all());
        return redirect('front.address.index');
    }

    public function destroy($id)
    {
        $this->service->getAddressDelete($id);
        return redirect('front.address.index');
    }

    public function defaddr($id)
    {
        $this->service->getAddressDefaddr($id);
        return redirect('front.address.index');
    }
}
