@extends('layouts.login')
@section('title')找回密码-@endsection
@section('content')
<div class="login">
	<div class="login1 tab-1" id="loginBlock">
		<div class="loginFunc">
			<span>找回密码</span>
		</div>
		<div class="loginForm">
			<div class="loginFormIpt showPlaceholder">
				<b class="ico ico-phone"></b>
				<input type="text" value="" maxlength="50" name="mobile" placeholder=" 请输入手机号" class="loginFormTdIpt" id="tel">
				<div id="idInputTest"></div>
			</div>
			<div class="loginFormIpt showPlaceholder">
				<b class="ico ico-pwd"></b>
				<input type="password" name="password" placeholder=" 请输入密码" class="loginFormTdIpt">
			</div>
			<div class="verification-code" style="float:left;">
				<b class="ico ico-pwd"></b>
				<input type="password" name="validcode" placeholder="验证码" class="loginFormTdIpt">
			</div>

			<input type="button" class="person-code-btn" onclick="getCode('{{url('login/ajaxValidcodeByMobile')}}',$('#tel').val(),this);" value="获取验证码"/>

			<div class="loginFormCheck">
				<div class="forgetPwdLine">
					<a title="找回密码" href="{{url('login')}}" class="forgetPwd">返回登陆</a>
				</div>
			</div>
			<div class="loginFormBtn">
				<a class="btn-submit" href="javascript:resetPassword();">提交</a>
			</div>
			<div class="Clear"></div>
		</div>
	</div>
</div>
@endsection
@section('js')
<script type="text/javascript">
	function resetPassword() {
		var mobile = $("input[name='mobile']").val();
		var password = $("input[name='password']").val();
		var validcode = $("input[name='validcode']").val();
		if(mobile.length ==0 || password.length ==0){
			layer.msg("{{trans('front/system.login_error')}}");return;
		}
		if(validcode.length ==0){
			layer.msg("{{trans('front/system.validcode_error')}}");return;
		}

	    var params = {};
	    params.url = "{{url('login/resetPassword_check')}}";
	    params.postData = {'mobile':mobile,'password':password,'validcode':validcode};
	    params.postType = 'post';
	    params.mustCallBack = true;// 是否必须回调
	    params.callBack = function(json) {
	       location.href = "{{url('login')}}";
	    };
	    ajaxJSON(params);
	}
</script>
@endsection