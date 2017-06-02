@extends('layouts.front')
@section('title'){{$name}}-@endsection
@section('css')
@endsection
@section('content')
@include('front.share.leftSidebar')
<div class="M2" style="margin-top:10px; width:928px;">
	@include('front.share.crumb',['name'=>$name])
	<div class="fl-main">
		<div style="width:930px; margin:10px 0 10px 0;">
			<div class="m_p">
				<p>{{trans('front/system.suggest_des')}}</p>
				<p class="right">阅达.智慧书城运营中心</p>
			</div>
			<div class="clear"></div>
			<div class="Set-up Set-up-in" style=" background:#fff; min-height:auto;">
				<textarea style="height: 140px; width:97%; border:1px solid #eee; padding:10px;" data-height="140" class="textarea" name="content" placeholder="请在这里输入您的宝贵意见"></textarea>
				<input style=" width:97%; border:1px solid #eee; padding:10px;" placeholder="请留下您的手机号码或QQ号码" name="mobile" />
			</div>
			<div class="info-c">
				<a class="btn_red" href="javascript:obtain();">保存</a>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
@endsection
@section('js')
<script type="text/javascript">
	function obtain(){
		if($("textarea[name='content']").val().length==0 || $("input[name='mobile']").val().length==0){
			layer.msg("{{trans('front/system.suggest_error')}}");return;
		}
		var params = {};
	    params.url = "{{url('user/ajaxSuggestSave')}}";
	    params.postData = {'content':$("textarea[name='content']").val(),'mobile':$("input[name='mobile']").val()};
	    params.postType = 'post';
	    params.mustCallBack = true;// 是否必须回调
	    params.callBack = function(json) {
	      window.location.reload();
	    };
	    ajaxJSON(params);
	}
</script>
@endsection
