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
@include('layouts.partials.pagination')
 {{--@include('layouts.partials.pagination',['totalPages'=>$topicalGoods['totalPages']])--}}
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