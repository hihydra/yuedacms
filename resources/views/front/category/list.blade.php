@extends('layouts.front')
@section('title'){{$name}}-@endsection
@section('content')
<div class="bk-left">
  <div class="area">
    <div class="category">
      <ul class="category-list">
        <li>
          <div class="category-info list-nz">
            <h2><a href="{{url('category')}}" class="ml-22">全部</a></h2>
            <em>></em>
          </div>
        </li>
        @foreach($catList as $cat)
        <li class="cat_{{$cat['id']}}">
          <div class="category-info list-nz">
            <h2><a href="{{URL::route('category',['catId'=>$cat['id']])}}" class="ml-22">{{$cat['name']}}</a></h2>
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
    <div class="show-switch">
      <a href="{{URL::route('category',['catId'=>$urlPath['catId'],'keyword'=>$urlPath['keyword'],'sort'=>'SORT_TIME'])}}" class="sort-item sort-hover SORT_TIME">
        <em class="curr3"><span>时间</span><b></b></em>
      </a>
      <a href="{{URL::route('category',['catId'=>$urlPath['catId'],'keyword'=>$urlPath['keyword'],'sort'=>'SORT_PRICE'])}}" class="sort-item sort-hover SORT_PRICE">
        <em class="curr3"><span>价格</span><b></b></em>
      </a>
      <a href="{{URL::route('category',['catId'=>$urlPath['catId'],'keyword'=>$urlPath['keyword'],'sort'=>'SORT_SALES'])}}" class="sort-item sort-hover SORT_SALES">
        <em><span>销量</span><b></b></em>
      </a>
    </div>
    <div class="Recommend-list Recommend-list-1">
      <ul>
       @foreach($goodsList['datas'] as $good)
       <li>
        <div class="book">
          <a href="{{url('goods/'.$good['id'])}}"><img src="{{{$good['thumbUrl'] or defaultImg()}}}" /></a>
          <a href="{{url('goods/'.$good['id'])}}" class="tittle">{{str_limit($good['name'], $limit = 25, $end = '...')}}</a>
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
    $catId = app('request')->input('catId');
    @endphp
    var catId = '{{$catId}}';
    if(catId){
     $('.cat_'+catId).addClass('hover');
   }else{
    $('.category-list li').first().addClass('hover');
  }

  var sort = "{{{$urlPath['sort'] or 0}}}";
  if(sort != 0){
    var isAsc = {{{$urlPath['isAsc'] or 0}}};
    if(isAsc){
      $('.'+sort+' em').attr('class','curr2');
      $('.'+sort).attr("href",$('.'+sort).attr("href")+"&isAsc=false");
    }else{
      $('.'+sort+' em').attr('class','curr1');
      $('.'+sort).attr("href",$('.'+sort).attr("href")+"&isAsc=true");
    }
  }
});
</script>
@endsection