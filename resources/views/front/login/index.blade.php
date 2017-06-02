@extends('layouts.login')
@section('title')登陆-@endsection
@section('content')
<div class="login">
	<div class="login1 tab-1" id="loginBlock">
		<div class="loginFunc">
			<span>登录</span>
		</div>
		<div class="loginForm">
			<div class="loginFormIpt showPlaceholder">
				<b class="ico ico-uid"></b>
				<input type="text" value="" maxlength="50" name="mobile" placeholder=" 请输入手机号" tabindex="1" class="loginFormTdIpt">
				<div id="idInputTest"></div>
			</div>
			<div class="loginFormIpt showPlaceholder">
				<b class="ico ico-pwd"></b>
				<input type="password" name="password" placeholder=" 请输入密码" tabindex="2" class="loginFormTdIpt">
			</div>

			<div class="loginFormCheck">
				<div class="forgetPwdLine">
					<a title="找回密码" href="{{url('login/resetPassword')}}" class="forgetPwd">忘记密码了?</a>
				</div>

			</div>
			<div class="loginFormBtn">
				<button type="button" tabindex="6" class="btn1 btn-login" style=" float:left; border:0 none;" onclick="login();">&nbsp;</button>
				<a href="{{url('register')}}" class="btn1 btn-reg">&nbsp;</a>
			</div>
			<div class="Clear"></div>
		</div>
	</div>
</div>
@endsection
@section('js')
<script type="text/javascript">
	function login() {
		var mobile = $("input[name='mobile']").val();
		var password = $("input[name='password']").val();
		if(mobile.length ==0 || password.length ==0){
			layer.msg("{{trans('front/system.login_error')}}");return;
		}

		var params = {};
		params.url = "{{url('login/login_check')}}";
		params.postData = {'mobile':mobile,'password':password};
		params.postType = "post";
		params.mustCallBack = true;// 是否必须回调
		params.callBack = function(json) {
			location.href = "{{url('/')}}";
		};
		ajaxJSON(params);
	}
</script>
@endsection