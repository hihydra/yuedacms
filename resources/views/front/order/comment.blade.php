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
    <form action="{{url('order/commentAdd')}}" method="post" id="sub_{{$item['id']}}"  enctype="multipart/form-data">
    <div class="g_tbox">
      <div class="left" style="width:100%;">
        <div class="item">
          <span class="label"><em>*</em> 买家评论：</span>
          <div class="left">
          <textarea id="ipt_content_{{$item['id']}}" name='content' style="width:700px; height:70px; border:1px solid #ccc; padding:5px;"></textarea>
          </div>
          <div class="clear"></div>
        </div>
        <input type="hidden" name="goodsId" value="{{$item['id']}}">
        <input type="hidden" name="orderId" value="{{$orderId}}">
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
          <span class="label"><em>*</em> 晒单：</span>
          <div class="left">
            <ul class="img-list-ul">
              <li class="upload-btn">
                <div style="height:80px;">
                  <input type="file" class="photo-input UploadImg" name="file" style="z-index:1; width:60px; height:60px;">
                  <a class="add-img-btn" style="position: relative;"><b></b></a>
                  <ul class="Figure">
                  </ul>
                </div>
              </li>
            </ul>
          </div>
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
    </form>
    @endforeach
  </br>
</div>

</div>
<div class="clear"></div>
{!!$ApiPresenter->getShowcaseList()!!}
@endsection
@section('js')
<script type="text/javascript">
  //上传头像预览
  $('.upload-btn').on('change', '.UploadImg', function(){
    var file = this.files[0];
    if(file == ''){
      return false;
    }
      //判断类型是不是图片
      if(!/image\/\w+/.test(file.type)){
        layer.msg('文件只能为图片类型');
        return false;
      }

      //判断照片是否小于2M
      if(file.size > 2*1024*1024){
        layer.msg('图片大小不能超过2M');
        return false;
      }

      var reader = new FileReader();
      reader.readAsDataURL(file);
      reader.onload = function(e){
          str = '<li><img src="'+this.result+'" height="60px"><a class="close" href="javascript:close(this);"><img src="{{asset('/front/img/close.png')}}" width="20px"></a></li>';
          $('.Figure').append(str);
          $(".Figure .close").click(function(){
            $(this).parent().remove();
          });
      }
  });
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
    if(content==""){
      layer.msg("{{trans('front/system.comment_content_error')}}");return;
    }
    /*
    var grade = $('#ipt_grade_'+goodsId).val();
    var params = {};
    params.url = "{{url('order/commentAdd')}}";
    params.postData = {'goodsId':goodsId,'orderId':{{$orderId}},'content':content,'grade':grade};
    params.postType = "post";
    params.mustCallBack = true;// 是否必须回调
    params.callBack = function(json) {
       location.href = "{{url('order')}}";
    };
    ajaxJSON(params);
    */
    $('#sub_'+goodsId).submit();
  }
</script>
@endsection