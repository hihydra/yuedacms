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
												<li>
							<div class="small-img">
								<img src="{{asset('/front/img/5.jpg')}}" />
							</div>
						</li>
																		<li>
							<div class="small-img">
								<img src="{{asset('/front/img/7.jpg')}}" />
							</div>
						</li>
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
						<a style="color:#b81b22;" href="#">￥<i>39</i>.00</a>
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
						<a href="javascript:unlike(29537);" class="favorite"><b class="sc-1"></b>喜欢</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="bi-m">
			<div class="choose-btns">
				<div class="wrap-input">
					<div id="div_num" class="Numinput" style="margin-left: 7px;"></div>
				</div>
				<i id="icon-cart"></i>
				<a href="javascript:void(0);" onclick="addCart(10187)" class="btn-append addtocart-btn addcart"><b></b>加入购物车</a>
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
					<a href="javascript:showInfo('pressInfo');" class="smooth">出版信息</a>
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
					<p>地产界思想家、商界哲人、畅销书《野蛮生长》《理想丰满》《行在宽处》作者冯仑新作。冯仑集数十年人生感喟与商界经验，以独具冯氏特色的劲爆、麻辣而深刻的“冯子论语”为基础，浅入深出谈论理想、人生、圈子、地产、创业、金钱等，与商界精英们纵论房产江湖，分享商道秘笈；与年轻人漫谈理想人生，闲话分寸之间。</p>
					<p>商界思想家，带领万通前进25年，守正出奇，践行理想，筑梦踏实。他是民营企业的布道者，体察历史，探究现实，勤于思考，乐于分享；他是社会公益的先行者，从学习国外先进到成立万通公益基金会，发起爱佑华夏慈善基金会、壹基金公益基金会和阿拉善SEE生态协会……知行合一；他是一个平和的人，有着智者的光辉和仁者的魅力。</p>
					<img src="{{asset('/front/img/6.jpg')}}" />
				</div>
			</div>
			<div class="F-main" id="div_pressInfo" style="margin-top:10px;display:none;">
				<div class="f-info">
					<ul class="f-ul">
						<li>
							<span class="bitips">作<span>者</span>：</span>
							<a href="#">冯仑</a>
						</li>
						<li>
							<span class="bitips">开<span>本</span>：</span>
							<a href="#">32开</a>
						</li>
						<li>
							<span class="bitips">绘<span>者</span>：</span>
							<a href="#">王家珠</a>
						</li>
						<li>
							<span class="bitips">出版时间：</span>
							<a href="#">2013-05-01</a>
						</li>
						<li>
							<span class="bitips">出<span>版社</span>：</span>
							<a href="#">未来出版社</a>
						</li>
						<li>
							<span class="bitips">印刷时间：</span>
							<a href="#">2013-06-01</a>
						</li>
						<li>
							<span class="bitips">ISB<span>N</span>：</span>
							<a href="#">9845214786511</a>
						</li>
						<li>
							<span class="bitips">用<span>纸</span>：</span>
							<a href="#">胶版纸</a>
						</li>
						<li>
							<span class="bitips">版<span>次</span>：</span>
							<a href="#">1</a>
						</li>
						<li>
							<span class="bitips">印<span>次</span>：</span>
							<a href="#">1</a>
						</li>
						<li>
							<span class="bitips">包<span>装</span>：</span>
							<a href="#">平装</a>
						</li>
						<li>
							<span class="bitips">套装数量：</span>
							<a href="#">3000</a>
						</li>
						<li>
							<span class="bitips">外<span>文名</span>：</span>
							<a href="#">&nbsp;</a>
						</li>
						<li>
							<span class="bitips">正文语种：</span>
							<a href="#">简体中文</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="F-main" id="div_comment" style="display:none;">
				<div class="f-info" style="margin-top:10px;">
					<div class="mt">
						<div class="mt-inner">
							<ul>
								<li class="curr"><a href="#">全部评价<em>(100+)</em></a></li>
								<li><a href="#">晒图<em>(50+)</em></a></li>
								<li><a href="#">好评<em>(80+)</em></a></li>
								<li><a href="#">中评<em>(20+)</em></a></li>
								<li><a href="#">差评<em>(2)</em></a></li>
								<li class="comm-curr-sku trig-item">
									<span><input type="checkbox" /></span>
									<label>只看当前商品评价</label>
								</li>
							</ul>
						</div>
						<div class="comments-table">
							<div class="com-table-main">
								<div class="comments-item">
									<div class="column column1">
										<div class="g-star"></div>
										<div class="comment-time">2017-04-11 11:37</div>
									</div>
									<div class="column column2">
										<div class="p-comment">
											物流速度很快，包装很好，还是中央党校出版的，好！<br/>现在人民的名义那么火，其实，追问都是真是案例加工而成，更真实，更震撼。
										</div>
										<div class="p-show-img">
											<ul>
												<li><div class="show-more-pic"><img src="img/1.jpg" /></div></li>
												<li><div class="show-more-pic"><img src="img/2.jpg" /></div></li>
												<li><div class="show-more-pic"><img src="img/3.jpg" /></div></li>
												<li><div class="show-more-pic"><img src="img/4.jpg" /></div></li>
											</ul>
										</div>
										<div class="clear"></div>
										<div class="comment-operate">
											<a href="#" class="nice">点赞（0）</a>
											<a href="#" class="replylz">回复（<span>0</span>）</a>
										</div>
									</div>
									<div class="clear"></div>
								</div>

								<div class="comments-item">
									<div class="column column1">
										<div class="g-star g-star3"></div>
										<div class="comment-time">2017-04-08 18:37</div>
									</div>
									<div class="column column2">
										<div class="p-comment">
											帮我妈妈买的，书的质量纸张可以！！很好
										</div>
										<div class="clear"></div>
										<div class="comment-operate">
											<a href="#" class="nice">点赞（0）</a>
											<a href="#" class="replylz">回复（<span>0</span>）</a>
										</div>
									</div>
									<div class="clear"></div>
								</div>

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
				</div>
			</div>
		</div>
	</div>
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
{!!$ApiPresenter->getShowcaseList()!!}
@endsection
@section('js')
<script type="text/javascript" src="{{asset('/vendors/jquery.magnifier/magnifier.js')}}"></script>
<script type="text/javascript" src="{{asset('/vendors/jquery.numinput/jquery.numinput.js')}}"></script>
<script type="text/javascript" src="{{asset('/vendors/jquery.fly/jquery.fly.min.js')}}"></script>
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
	function showInfo(id){
		$("#ul_menu").find("li").removeClass("on");
		$("#div_contentInfo").hide();
		$("#div_pressInfo").hide();
		$("#li_"+id).addClass("on");
		$("#div_"+id).show();
	}
</script>
@endsection