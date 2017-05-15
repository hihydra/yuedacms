@extends('layouts.front')
@section('title'){{$name}}-@endsection
@section('css')
@endsection
@section('content')
@include('front.share.leftSidebar')
<div class="M2" style="margin-top:10px; width:928px;">
	@include('front.share.crumb',['name'=>$name])
	<div class="fl-main">
		<div class="book-select" style="margin-top:0;">
			<div class="bs-info">
				<ul class="bs-ul" style="margin-top:0;">
					<li class="on">
					<a href="{{url('user/collection')}}" class="smooth">{{trans('front/system.goodsLike')}}</a>
						<b></b>
					</li>
					<li>
						<a href="{{url('user/collection/specialLike')}}" class="smooth">{{trans('front/system.specialLike')}}</a>
						<b></b>
					</li>
					<div class="clear"></div>
				</ul>
			</div>
		</div>
		<div class="Recommend-list Recommend-list-2">
			<ul>
				@foreach($datas as $data)
				<li class="div_{{$data['id']}}">
					<div class="book">
						<a href="#"><img src="{{$data['thumbUrl']}}" /></a>
					</div>
					<div class="info">
						<a href="#" class="tittle">{{str_limit($data['name'], $limit = 25, $end = '...')}}</a>
						<p class="author">{{date('Y-m-d h:i',round($data['likeTime']/1000))}} 喜欢</p>
						<p class="price">￥{{$data['price']}}</p>
						<div class="info-c">
							<a class="btn_red" href="#">加入购物车</a>
							<a class="qx" href="javascript:unlike({{$data['id']}})">取消收藏</a>
						</div>
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
@endsection
@section('js')
<script type="text/javascript">
	function unlike(id){
		$.post("{{url('user/ajaxGoodsUnlike')}}/"+id,function(result){
			layer.msg(result.message);
			if(result.result == 1){
				$('.div_'+id).remove();
			}
		});
	}
</script>
@endsection
