@extends('layouts.front')
@section('title'){{$name}}-@endsection
@inject('ApiPresenter','App\Presenters\Front\ApiPresenter')
@section('content')
<div class="M1" style="margin-top:10px;">
  @include('front.share.crumb',['name'=>$name])
  <div class="wrapper">
    @if(true)
    <img src="{{asset('front/img/bannar2.jpg')}}" />
    <div class="topic-info j-main">
      <h1 class="topic-title">适合女性的书单推荐
        <span class="ic-03" style="padding-left:20px;font-weight:normal;">
          <a href="javascript:unlike(29537);" class="favorite"><b class="sc-1"></b>喜欢</a>
        </span>
      </h1>
      <p class="topic-desc">3月，是早春的季节，也是女性的节日。“腹有诗书气自华”这话说的一点都没错，从书中得到的知识是任何人都抢不走的，在这个春暖花开的季节，小糖君给各位糖果们推荐一份适合女性的书单，希望你们会喜欢。</p>
    </div>
    @endif
    <div class="product-list">
      @if($type == 'special')
      @foreach($goods['datas'] as $good)
      <div class="product-item j-main">
        <span class="ic-03" style="float: right;line-height: 35px;"><b class="sc-1"></b>{{$good['likecount']}}</span>
        <p class="p-title">{{$good['name']}}</p>
        <div class="left">
          <a href=""><img src="{{{$good['thumbUrl'] or defaultImg()}}}" width="1070px;" height="532px;" /></a>
        </div>
        <div class="clear"></div>
      </div>
      @endforeach
      @else
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
      @endif
    </div>
  </div>

  @include('layouts.partials.pagination')

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