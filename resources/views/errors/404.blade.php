@extends('layouts.front')
@section('title')404错误-@endsection
@section('css')
<style type="text/css">
  .page-message-container {
      width: 700px;
      margin: 0 auto;
      margin-bottom: 40px;
  }
  .page-message-panel {
      background: #fff;
      border: 1px solid #ccc;
      padding: 50px 50px;
  }
  .page-message-heading {
      margin-bottom: 25px;
  }
  .page-message-title {
      margin: 0;
      padding: 0;
      line-height: 1;
      font-size: 24px;
  }
  .page-message-body {
      font-size: 16px;
  }
</style>
@endsection
@inject('ApiPresenter','App\Presenters\Front\ApiPresenter')
@section('content')
<div class="M1" style="margin-top:10px;">
    <div class="container">
        <div class="page-message-container">
          <div class="page-message-panel">
            <div class="page-message-heading">
              <h2 class="page-message-title">提示信息</h2>
          </div>
          <div class="page-message-body">{{$exception->getMessage()}}</div>
      </div>
  </div>
</div>
</div>
{!!$ApiPresenter->getShowcaseList('cart')!!}
@endsection
@section('js')
@endsection