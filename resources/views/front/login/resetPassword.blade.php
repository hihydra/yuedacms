@extends('layouts.login')
@section('title')找回密码-@endsection
@section('css')
<style type="text/css">
	.person-code-btn{
        margin: 0 0 0 15px;
        padding: 7px 10px;
        background: #fff;
        border: 1px solid #b81b22;
        color: #b81b22;
    }
</style>
@endsection
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
	function tel(){
		var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
		if(!myreg.test($('#tel').val()))
		{
			layer.msg("{{trans('front/system.phone_error')}}");
			$('#tel').focus();
			return false;
		}else{
			return true;
		}
	}
	function getCode(url,mobile,obj){
		if(tel()){
			$.post(url,{'mobile':mobile},function(result){
				layer.msg(result.message);
				if(result.result == 1){
					settime(obj);
				}
			});
		}
	}
	var countdown=60;
	function settime(obj) {
		tel();
		if (countdown == 0) {
			obj.removeAttribute("disabled");
			obj.value="获取验证码";
			countdown = 60;
			return;
		} else {
			obj.setAttribute("disabled", true);
			obj.value="重新发送(" + countdown + ")";
			countdown--;
		}
		setTimeout(function() {
			settime(obj) }
			,1000)
	}
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
		$.post("{{url('login/resetPassword_check')}}",{'mobile':mobile,'password':password,'validcode':validcode},function(result){
			layer.msg(result.message);
			if(result.result == 1){
				location.href = "{{url('login')}}";
			}
		});
	}
</script>
@endsection