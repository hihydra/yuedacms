<?php

namespace App\Http\Controllers\Front;
use App\Service\Api\CategoryService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use URL;

class CategoryController extends Controller
{
    protected $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }


    //分类列表
    public function show(Request $request)
    {
        $storeId = $request->input('storeId',getStoreId());
        $catId = $request->input('catId');
        $keyword = $request->input('keyword');
        $anchor = $request->input('anchor');
        $sort = $request->input('sort');
        $isAsc = $request->input('isAsc');
        $catList = $this->service->getCatList();
        $goodsList = $this->service->getGoodsList($storeId,$catId,$anchor,$keyword,$sort,$isAsc);
        //dd($goodsList);
        $urlPath = compact('storeId','catId','keyword','anchor','sort','isAsc');
        $name = '分类';
        return view('front.category.list')->with(compact('catList','goodsList','urlPath','name'));
    }

}
