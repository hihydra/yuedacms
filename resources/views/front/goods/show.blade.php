@extends('layouts.front')
@section('title'){{$name}}-@endsection
@inject('ApiPresenter','App\Presenters\Front\ApiPresenter')
@section('css')
<link href="{{asset('/vendors/jquery.magnifier/magnifier.css')}}" type="text/css" rel="stylesheet">
@endsection
@section('content')
<div class="M1" style="margin-top:10px;">
	@include('front.share.crumb',['name'=>$name])
	<div class="list-info">

		<div class="magnifier" id="magnifier1">
			<div class="magnifier-container">
				<div class="images-cover"></div>
				<!--当前图片显示容器-->
				<div class="move-view"></div>
				<!--跟随鼠标移动的盒子-->
			</div>
			<div class="magnifier-assembly">
				<div class="magnifier-btn">
					<span class="magnifier-btn-left">&lt;</span>
					<span class="magnifier-btn-right">&gt;</span>
				</div>
				<!--按钮组-->
				<div class="magnifier-line">
					<ul class="clearfix animation03">
						@foreach($images as $img)
						<li>
							<div class="small-img">
								<img src="{{$img}}" />
							</div>
						</li>
						@endforeach
					</ul>
				</div>
				<!--缩略图-->
			</div>
			<div class="magnifier-view"></div>
			<!--经过放大的图片显示容器-->
		</div>

		<div class="con-book bp-m">
			<h1>{{$name}}</h1>
			<div class="b-org">
				<ul>
					<li class="b-org-li">
						<span class="b-label"><span>价</span>格：</span>
						<a style="color:#b81b22;" href="#">￥<i>{{$price}}</i></a>
					</li>
					<li class="b-org-li">
						<span class="b-label"><span>原</span>价：</span>
						<a style="text-decoration:line-through;">￥{{$mktprice}}</a>
					</li>
					<li class="b-org-li">
						<span class="b-label"><span>作</span>者：</span>
						<a>{{$author}}</a>
					</li>
					<li class="b-org-li">
						<span class="b-label">版权提供：</span>
						<a>{{$press}}</a>
					</li>
				</ul>
			</div>
			<div class="bi-m">
				<div class="j-main">
					<ul class="ic-info clearfix">
						<!--
						<li class="ic-02">
							<div class="share-1">
								<a href="#" class="share"><b></b>分享</a>
							</div>
						</li>
					-->
					<li class="ic-03">
						@if($hasLike)
						<a href="javascript:unlike({{$id}});" class="favorite"><b class="sc"></b>喜欢</a>
						@else
						<a href="javascript:like({{$id}});" class="favorite"><b class="sc-1"></b>喜欢</a>
						@endif
					</li>
				</ul>
			</div>·
		</div>
		<div class="bi-m">
			<div class="choose-btns">
				<div class="wrap-input">
					<div id="div_num" class="Numinput" style="margin-left: 7px;"></div>
				</div>
				<i id="icon-cart"></i>
				@if(isset($isPresale)&&$isPresale)
				<a href="{{URL::route('goods.buy',['productId'=>$productId,'isPresale'=>true])}}" class="btn-appendCart addtocart-btn"><b></b>预约购买</a>
				@else
				<a href="javascript:void(0);" onclick="addCart({{$productId}})" class="btn-appendCart addtocart-btn addcart"><b></b>加入购物车</a>
				<a href="{{URL::route('goods.buy',['productId'=>$productId])}}" class="btn-append"><b></b>立即购买</a>
				@endif

			</div><div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="book-select">
		<div class="bs-info">
			<ul class="bs-ul" id="ul_menu">
				<li id="li_contentInfo" class="on">
					<a href="javascript:showInfo('contentInfo');" class="smooth">内容详情</a>
					<b></b>
				</li>
				<li id="li_pressInfo">
					<a href="javascript:showInfo('pressInfo');" class="smooth">{{$params[0]['name']}}</a>
					<b></b>
				</li>
				<li id="li_comment">
					<a href="javascript:showInfo('comment');" class="smooth">评价</a>
					<b></b>
				</li>
				<div class="clear"></div>
			</ul>
			<div class="F-main">
				<div class="f-info" id="div_contentInfo" style="margin-top:10px;">
					{!!$intro!!}
				</div>
			</div>
			<div class="F-main" id="div_pressInfo" style="margin-top:10px;display:none;">
				<div class="f-info">
					<ul class="f-ul">
						@foreach($params[0]['paramList'] as $param)
						<li>
							<span class="bitips">{{$param['name']}}：</span>
							{{$param['value']}}
						</li>
						@endforeach
					</ul>
				</div>
			</div>
			<div class="F-main" id="div_comment" style="display:none;">
			</div>
		</div>
	</div>
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
<div class="Recommend-book M1">
  <div class="hot-h2">
    <h2>
      <p>为你推荐</p>
    </h2>
  </div>
  <div class="Recommend-list">
    <ul>
      @foreach($recommends as $key=>$commend)
      @php if($key>5){break;}@endphp
      <li>
        <div class="book">
          <a href="{{url('goods/'.$commend['id'])}}"><img src="{{{$commend['image'] or defaultImg()}}}" /></a>
          <a href="{{url('goods/'.$commend['id'])}}" class="tittle">{{str_limit($commend['name'], $limit = 25, $end = '...')}}</a>
        </div>
        <div class="info">
          <p class="price">￥{{$commend['price']}}</p>
        </div>
      </li>
      @endforeach
      <div class="clear"></div>
    </ul>
  </div>
</div>
@endsection
@section('js')
<script type="text/javascript" src="{{asset('/vendors/jquery.magnifier/magnifier.js')}}"></script>
<script type="text/javascript" src="{{asset('/vendors/jquery.numinput/jquery.numinput.js')}}"></script>
<script type="text/javascript" src="{{asset('/vendors/jquery.fly/jquery.fly.min.js')}}"></script>
<script type="text/javascript">
	$(function() {
		var magnifierConfig = {
			magnifier : "#magnifier1",//最外层的大容器
			width : 320,//承载容器宽
			height : 320,//承载容器高
			moveWidth : null,//如果设置了移动盒子的宽度，则不计算缩放比例
			zoom : 3//缩放比例
		};
		var _magnifier = magnifier(magnifierConfig);
		$("#div_num").numinput({name:"num"});
	});
	function addCartFlyer(cartCount) {
		var startOffset = $(".addcart").offset();
		var endOffset = $(".cartNum").offset();
	    var img = $('.small-img').children('img').attr('src'); //获取当前点击图片链接
	    var flyer = $('<img class="flyer-img" src="' + img + '">'); //抛物体对象
	    flyer.fly({
	    	start: {
	        	left: startOffset.left,//抛物体起点横坐标
	        	top: startOffset.top //抛物体起点纵坐标
	        },
	        end: {
		        left: endOffset.left + 10,//抛物体终点横坐标
		        top: endOffset.top + 10, //抛物体终点纵坐标
		    },
		    onEnd: function() {
		    	$('.flyer-img').remove();
		    	$('.cartNum').html(cartCount);
		    }
		});
	}
	function like(id) {
		var params = {};
		params.url = "{{url('user/ajaxGoodsLike')}}/"+id;
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
		params.url = "{{url('user/ajaxGoodsUnlike')}}/"+id;
		params.postType = "post";
		params.mustCallBack = true;// 是否必须回调
		params.callBack = function(json) {
			$('.favorite').html('<b class="sc-1"></b>喜欢');
			$('.favorite').attr('href','javascript:like('+id+')');
		};
		ajaxJSON(params);
	}
	function addCart(id){
		var params = {};
		params.url = "{{url('cart/ajaxAdd')}}";
		params.postData = {'productId':id,'num':$("input[name='num']").val()};
		params.postType = "post";
		params.mustCallBack = true;// 是否必须回调
		params.callBack = function(json) {
			addCartFlyer(json.data.cartCount);
		};
		ajaxJSON(params);
	}
	function showInfo(div){
		$("#ul_menu").find("li").removeClass("on");
		$("#div_contentInfo").hide();
		$("#div_pressInfo").hide();
		$("#div_comment").hide();
		$("#li_"+div).addClass("on");
		$("#div_"+div).show();
		if(div == 'comment'){
			loadComment();
		}
	}
	function loadComment(anchor=1){
		var params = {};
		params.url = "{{url('goods/ajaxComment/'.$id)}}";
		params.postData = {'anchor':anchor};
		params.postType = "get";
		params.mustCallBack = true;//是否必须回调
		params.callBack = function (json){
			$('#div_comment').html(json.data);
		};
		ajaxJSON(params);
	}
</script>
@endsection