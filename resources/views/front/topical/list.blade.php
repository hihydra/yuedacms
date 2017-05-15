@extends('layouts.front')
@section('title'){{$name}}-@endsection
@section('content')
<div class="bk-left">
  <div class="area">
    <div class="category">
      <ul class="category-list">
        @foreach($topicalList as $topical)
        <li class="topical_{{$topical['id']}}">
          <div class="category-info list-nz">
            <h2><a href="{{URL::route('topical',['topicalId'=>$topical['id']])}}" class="ml-22">{{$topical['name']}}</a></h2>
            <em>></em>
          </div>
        </li>
        @endforeach
      </ul>
    </div>
  </div>
</div>
<div class="M2" style="margin-top:10px;">
  @include('front.share.crumb',['name'=>$name])
  <div class="fl-main">
    <div class="Recommend-list Recommend-list-1">
      <ul>
        @foreach($topicalGoods['datas'] as $good)
          <li>
            <div class="book">
              <a href="#"><img src="{{{$good['thumbUrl'] or defaultImg()}}}" /></a>
              <a href="#" class="tittle">{{str_limit($good['name'], $limit = 25, $end = '...')}}</a>
            </div>
            <div class="info">
              <p class="author"></p>
              <p class="price">￥{{$good['price']}}</p>
            </div>
          </li>
        @endforeach
        <div class="clear"></div>
      </ul>

    </div>
  </div>

  <!--分页-->
  <div class="pages">
    <a class="prev  icon-disable1" href="#"><b></b>上一页</a><strong>1</strong><a href="#">2</a><a href="#">3</a><a href="#">4</a>
    <i>...</i><a class="last" href="#">212</a><a class="next" href="#">下一页<b></b></a>
    <span class="go_page">去第<input id="go_page_input" class="input_02 g_ipt" name="" type="text">页 <input name="" class="p_go" value="GO" id="go_page_btn" type="button"></span>
  </div>
  <div class="clear"></div>
</div>
<div class="clear"></div>
@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function(){
        @php
          $topicalId = app('request')->input('topicalId');
        @endphp
        var topicalId = '{{$topicalId}}';
        if(topicalId){
           $('.topical_'+topicalId).addClass('hover');
        }else{
            $('.category-list li').first().addClass('hover');
        }
   });
</script>
@endsection