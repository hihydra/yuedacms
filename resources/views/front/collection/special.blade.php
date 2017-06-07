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
					<li>
					<a href="{{url('user/goods')}}" class="smooth">{{trans('front/system.goodsLike')}}</a>
						<b></b>
					</li>
					<li class="on">
						<a href="{{url('user/goods/special')}}" class="smooth">{{trans('front/system.specialLike')}}</a>
						<b></b>
					</li>
					<div class="clear"></div>
				</ul>
			</div>
		</div>
		<div class="Recommend-list Recommend-list-2">
			<ul>
				@foreach($datas as $data)
				<li class="div_{{$data['id']}}" style="width: 47%;">
					<div class="book">
						<a href="{{url('goods/'.$data['id'])}}"><img src="{{$data['thumbUrl']}}" style="width:440px;height:234px;" /></a>
					</div>
					<div class="info">
						<a href="{{url('goods/'.$data['id'])}}" class="tittle">{{str_limit($data['name'], $limit = 40, $end = '...')}}</a>
						<p class="author">{{date('Y-m-d h:i',round($data['likeTime']/1000))}} 喜欢</p>
						<p class="author"><img src="{{asset('front/img/u78.png')}}" width="14px;"> {{$data['likecount']}}&nbsp;&nbsp;<a class="btn_red" href="javascript:unlike({{$data['id']}})">取消收藏</a></p>
					</div>
				</li>
				@endforeach
				<div class="clear"></div>
			</ul>

		</div>
	</div>

 @include('layouts.partials.pagination')
	<div class="clear"></div>
</div>
@endsection
@section('js')
<script type="text/javascript">
	function unlike(id){
		var params = {};
		params.url = "{{url('user/ajaxSpecialUnlike')}}/"+id;
		params.postType = "post";
		params.mustCallBack = true;// 是否必须回调
		params.callBack = function(json) {
			$('.div_'+id).remove();
		};
		ajaxJSON(params);
	}
</script>
@endsection
