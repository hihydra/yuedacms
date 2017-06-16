@extends('layouts.front')
@section('title'){{$name}}-@endsection
@inject('ApiPresenter','App\Presenters\Front\ApiPresenter')
@section('content')
<div class="M1" style="margin-top:10px;">
  @include('front.share.crumb',['name'=>$name])
  <div id="new_cart_wrapper" class="gwc_box gb_tal">
    @foreach($items as $item)
    <table class="g_table" cellspacing="0" cellpadding="0" border="0">
      <tbody>
        <tr class="tbg">
          <td colspan=2 style="text-align:center;"><h3>发布评价</h3></td>
        </tr>
        <tr>
          <td class="cl06"></td>
          <td>
            <div class="bif">
              <a target="_blank" href="{{url('goods/'.$item['id'])}}" class="img"><img src="{{$item['image']}}" width="48px" height="68px"></a>
              <div class="info">
                <h4>
                  <a target="_blank" href="{{url('goods/'.$item['id'])}}">{{$item['name']}}</a>
                </h4>
              </div>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="g_tbox">
      <div class="left" style="width:100%;">
        <div class="item">
          <span class="label"><em>*</em> 买家评论：</span>
          <div class="left">
          <textarea id="ipt_content_{{$item['id']}}" name='content' style="width:700px; height:70px; border:1px solid #ccc; padding:5px;"></textarea>
          </div>
          <div class="clear"></div>
        </div>
        <div class="item">
          <span class="label"><em>*</em> 买家评分：</span>
          <input id="ipt_grade_{{$item['id']}}" name="grade" value="5" type="hidden" />
          <div class="left" style="height:28px; line-height:28px;">
            <ul class="score">
              <li><a href="javascript:setCommentGrade(1);"><img src="{{asset('/front/img/rate_star.png')}}"></a></li>
              <li><a href="javascript:setCommentGrade(2);"><img id="img_grade_2" src="{{asset('/front/img/rate_star.png')}}" style="display: inline;"><img id="img_grade_un_2" style="display: none;" src="{{asset('/front/img/rate_unstar.png')}}"></a></li>
              <li><a href="javascript:setCommentGrade(3);"><img id="img_grade_3" src="{{asset('/front/img/rate_star.png')}}" style="display: none;"><img id="img_grade_un_3" style="display: inline;" src="{{asset('/front/img/rate_unstar.png')}}"></a></li>
              <li><a href="javascript:setCommentGrade(4);"><img id="img_grade_4" src="{{asset('/front/img/rate_star.png')}}" style="display: none;"><img id="img_grade_un_4" style="display: inline;" src="{{asset('/front/img/rate_unstar.png')}}"></a></li>
              <li><a href="javascript:setCommentGrade(5);"><img id="img_grade_5" src="{{asset('/front/img/rate_star.png')}}" style="display: none;"><img id="img_grade_un_5" style="display: inline;" src="{{asset('/front/img/rate_unstar.png')}}"></a></li>
            </ul>
          </div>
          <div class="clear"></div>
        </div>
        <div class="item">
          <!--
            <span class="label"><em>*</em> 晒单：</span>
            <div class="left">
              <ul class="img-list-ul">
                <li class="upload-btn">
                  <div>
                    <a href="#none" class="add-img-btn" style="position: relative; z-index: 0;"><b></b></a>
                    <ul class="Figure">
                      <li><a href="#"><img src="img/201612070922290897.jpg" width="50px"></a><a class="close" href="#"><img src="img/close.png" width="20px"></a></li>
                      <li><a href="#"><img src="img/自控力.jpg" width="50px"></a><a class="close" href="#"><img src="img/close.png" width="20px"></a></li>
                      <li><a href="#"><img src="img/201612070922290897.jpg" width="50px"></a><a class="close" href="#"><img src="img/close.png" width="20px"></a></li>
                      <li><a href="#"><img src="img/自控力.jpg" width="50px"></a><a class="close" href="#"><img src="img/close.png" width="20px"></a></li>
                      <li><a href="#"><img src="img/201612070922290897.jpg" width="50px"></a><a class="close" href="#"><img src="img/close.png" width="20px"></a></li>
                      <li><a href="#"><img src="img/自控力.jpg" width="50px"></a><a class="close" href="#"><img src="img/close.png" width="20px"></a></li>
                    </ul>
                  </div>
                </li>
              </ul>
            </div>
          -->
          <div class="clear"></div>
          <div class="item">
            <span class="label">&nbsp;</span>
            <div class="left">
              <a class="btn_red_01"  href="javascript:commentAdd({{$item['id']}});">提交</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </br>
</div>

</div>
<div class="clear"></div>
{!!$ApiPresenter->getShowcaseList()!!}
@endsection
@section('js')
<script type="text/javascript">
  function setCommentGrade(grade){
    $("#ipt_grade").val(grade);
    for(var i=2;i<=grade;i++){
      $("#img_grade_un_"+i).hide();
      $("#img_grade_"+i).show();
    }
    for(var i=5;i>grade;i--){
      $("#img_grade_"+i).hide();
      $("#img_grade_un_"+i).show();
    }
  }
  function commentAdd(goodsId){
    var content = $('#ipt_content_'+goodsId).val();
    var grade = $('#ipt_grade_'+goodsId).val();
    if(content==""){
      layer.msg("{{trans('front/system.comment_content_error')}}");return;
    }
    var params = {};
    params.url = "{{url('order/commentAdd')}}";
    params.postData = {'goodsId':goodsId,'orderId':{{$orderId}},'content':content,'grade':grade};
    params.postType = "post";
    params.mustCallBack = true;// 是否必须回调
    params.callBack = function(json) {
       location.href = "{{url('order')}}";
    };
    ajaxJSON(params);
  }
</script>
@endsection