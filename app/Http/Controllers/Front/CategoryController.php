<?php

namespace App\Http\Controllers\Front;
use App\Service\Api\CategoryService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    protected $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }


    //分类列表
    public function show($storeId)
    {
        $catList = $this->service->getCatList();
        $goodsList = $this->service->getGoodsList();
        return view('front.category.list')->with(compact('catList','goodsList'));
    }

}
