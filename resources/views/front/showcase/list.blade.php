@extends('layouts.front')
@section('title'){{$name}}-@endsection
@inject('ApiPresenter','App\Presenters\Front\ApiPresenter')
@section('content')
<div class="M1" style="margin-top:10px;">
  @include('front.share.crumb',['name'=>$name])
  <div class="wrapper">
    @if($type == 'specialDetail')
    <img src="{{$goods['image']}}" width="1070px"/>
    <div class="topic-info j-main" style="padding-top:10px;">
      <h1 class="topic-title">{{$goods['name']}}
        <span class="ic-03" style="padding-left:20px;font-weight:normal;">
          @if($goods['hasLike'])
          <a href="javascript:unlike({{$goods['id']}});" class="favorite"><b class="sc"></b>喜欢</a>
          @else
          <a href="javascript:like({{$goods['id']}});" class="favorite"><b class="sc-1"></b>喜欢</a>
          @endif
        </span>
      </h1>
      <p class="topic-desc">{{$goods['intro']}}</p>
    </div>
    @endif
    <div class="product-list">
      @if($type == 'special')
      @foreach($goods['datas'] as $good)
      <div class="product-item">
        <span class="favorite"><img src="{{asset('front/img/u78.png')}}" />{{$good['likecount']}}</span>
        <p class="p-title">{{$good['name']}}</p>
        <div class="left">
          <a href="{{url('showcase/specialDetail/'.$good['id'])}}"><img src="{{{$good['thumbUrl'] or defaultImg()}}}" width="1070px;" height="532px;" /></a>
        </div>
        <div class="clear"></div>
      </div>
      @endforeach
      @elseif($type == 'specialDetail')
      @foreach($goods['items'] as $good)
      <div class="product-item">
        <p class="p-title">@if($good['sloganTitle']){{$good['sloganTitle']}}@else{{$good['name']}}@endif</p>
        <div class="right">
          <p class="desc">{{{$good['slogan'] or ''}}}</p>
          <div class="pc-info-b">
            <p class="pc-like-area"><i class="ico-like"></i><span>{{$good['likecount']}}</span></p>
            <p class="pc-like-area no-border"><span><a href="{{url('goods/'.$good['id'])}}">查看详情</a></span></p>
          </div>
        </div>
        <div class="left">
          <img src="{{{$good['image'] or defaultImg()}}}" width="156px;" height="156px;" />
        </div>
        <div class="clear"></div>
      </div>
      @endforeach
      @include('layouts.partials.pagination')
      @else($type == 'recommend' || $type == 'sales')
      @foreach($goods['datas'] as $good)
      <div class="product-item">
        <p class="p-title">{{$good['name']}}</p>
        <div class="right">
          <p class="desc">{{{$good['desc'] or ''}}}</p>
          <div class="pc-info-b">
            <p class="pc-like-area"><span>价格：<span class="pc-price">￥{{{$good['price'] or ''}}}</span></span></p>
            <p class="pc-like-area"><i class="ico-like"></i><span>{{$good['likecount']}}</span></p>
            <p class="pc-like-area no-border"><span><a href="{{url('goods/'.$good['id'])}}">查看详情</a></span></p>
          </div>
        </div>
        <div class="left">
          <img src="{{{$good['thumbUrl'] or defaultImg()}}}" width="156px;" height="156px;" />
        </div>
        <div class="clear"></div>
      </div>
      @endforeach
      @include('layouts.partials.pagination',['totalPages'=>$goods['totalPages']])
      @endif
    </div>
  </div>

</div>
<div class="clear"></div>
{!!$ApiPresenter->getShowcaseList()!!}
@endsection
@section('js')
<script type="text/javascript">
  function like(id) {
    var params = {};
    params.url = "{{url('user/ajaxSpecialLike')}}/"+id;
    params.postType = "post";
    params.mustCallBack = true;// 是否必须回调
    params.callBack = function(json) {
      $('.favorite').html('<b class="sc"></b>喜欢');
      $('.favorite').attr('href','javascript:unlike('+id+')');
    };
    ajaxJSON(params);
  }
  function unlike(id){
    var params = {};
    params.url = "{{url('user/ajaxSpecialUnlike')}}/"+id;
    params.postType = "post";
    params.mustCallBack = true;// 是否必须回调
    params.callBack = function(json) {
      $('.favorite').html('<b class="sc-1"></b>喜欢');
      $('.favorite').attr('href','javascript:like('+id+')');
    };
    ajaxJSON(params);
  }
</script>
@endsection