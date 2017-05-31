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
							<li>
								<div class="small-img">
									<img src="{{asset('/front/img/6.jpg')}}" />
								</div>
							</li>
						</ul>
					</div>
					<!--缩略图-->
				</div>
				<div class="magnifier-view"></div>
				<!--经过放大的图片显示容器-->
			</div>

		<div class="con-book bp-m">
			<h1>小道理：分寸之间</h1>
			<div class="b-org">
				<ul>
					<li class="b-org-li">
						<span class="b-label"><span>价</span>格：</span>
						<a style="color:#b81b22;" href="#">￥<i>39</i>:00</a>
					</li>
					<li class="b-org-li">
						<span class="b-label"><span>原</span>价：</span>
						<a style="text-decoration:line-through;" href="#">￥58:00</a>
					</li>
					<li class="b-org-li">
						<span class="b-label"><span>作</span>者：</span>
						<a href="#">冯仑</a>
					</li>
					<li class="b-org-li">
						<span class="b-label">版权提供：</span>
						<a href="#">长江文艺出版社</a>
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
							<a href="javascript:unlike(29537);" class="favorite"><b class="sc"></b>喜欢</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="bi-m">
				<div class="choose-btns">
					<div class="wrap-input">
						<a class="btn-add" href="#">+</a>
						<a class="btn-reduce" href="#">-</a>
						<input class="buy-num" value="1" name="num" />
					</div>
					<a href="javascript:addCart(10187);" class="btn-append addtocart-btn"><b></b>加入购物车</a>
				</div><div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="book-select">
			<div class="bs-info">
				<ul class="bs-ul">
					<li class="on">
						<a href="#" class="smooth">内容详情</a>
						<b></b>
					</li>
					<li>
						<a href="#" class="smooth">出版信息</a>
						<b></b>
					</li>
					<li>
						<a href="#" class="smooth">评价</a>
						<b></b>
					</li>
					<div class="clear"></div>
				</ul>
				<div class="F-main">
					<div class="f-info" style="margin-top:10px;">
						<p>地产界思想家、商界哲人、畅销书《野蛮生长》《理想丰满》《行在宽处》作者冯仑新作。冯仑集数十年人生感喟与商界经验，以独具冯氏特色的劲爆、麻辣而深刻的“冯子论语”为基础，浅入深出谈论理想、人生、圈子、地产、创业、金钱等，与商界精英们纵论房产江湖，分享商道秘笈；与年轻人漫谈理想人生，闲话分寸之间。</p>
						<p>商界思想家，带领万通前进25年，守正出奇，践行理想，筑梦踏实。他是民营企业的布道者，体察历史，探究现实，勤于思考，乐于分享；他是社会公益的先行者，从学习国外先进到成立万通公益基金会，发起爱佑华夏慈善基金会、壹基金公益基金会和阿拉善SEE生态协会……知行合一；他是一个平和的人，有着智者的光辉和仁者的魅力。</p>
						<img src="{{asset('/front/img/6.jpg')}}" />
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>
<div class="clear"></div>
{!!$ApiPresenter->getShowcaseList('cart')!!}
@endsection
@section('js')
<script type="text/javascript" src="{{asset('/vendors/jquery.magnifier/magnifier.js')}}"></script>
<script type="text/javascript">
	$(function() {

		var magnifierConfig = {
		magnifier : "#magnifier1",//最外层的大容器
		width : 280,//承载容器宽
		height : 284,//承载容器高
		moveWidth : null,//如果设置了移动盒子的宽度，则不计算缩放比例
		zoom : 3//缩放比例
	};

	var _magnifier = magnifier(magnifierConfig);
	});
	function like(id) {
		$.post("{{url('user/ajaxGoodsLike')}}/"+id,function(result){
			layer.msg(result.message);
			if(result.result == 1){
				$('.favorite').html('<b class="sc"></b>喜欢');
				$('.favorite').attr('href','javascript:unlike('+id+')');
			}
		});
	}
	function unlike(id){
		$.post("{{url('user/ajaxGoodsUnlike')}}/"+id,function(result){
			layer.msg(result.message);
			if(result.result == 1){
				$('.favorite').html('<b class="sc-1"></b>喜欢');
				$('.favorite').attr('href','javascript:like('+id+')');
			}
		});
	}
	function addCart(id,num){
		$.post("{{url('cart/ajaxAdd')}}",{'productId':id,'num':$("input[name='num']").val()},function(result){
			if(result.result == CODE_NETWORK_ERROR){
				layer.msg(result.message);
			}else{
				$('.cartNum').html(result.cartCount);
			}
		});
	}
</script>
@endsection