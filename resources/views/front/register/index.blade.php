@extends('layouts.front')
@section('title')注册-@endsection
@section('css')
<script type="text/javascript" src="{{asset('vendors/jquery.inputbox/jquery.inputbox.css')}}"></script>
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
<div class="reg-detail">
	<h3 class="reg-title">注册{{$settings['title']}}账号</h3>
	<div class="box-shadow-in"></div>
	<div class="node">
		<div class="node-title">{{$settings['title']}}账号</div>
		<div class="node-intro">输入手机号作为您的书城帐号，用于登录、重设密码、验证身份。</div>
		<div class="item">
			<span class="label"><em>*</em> 昵称：</span>
			<div class="fl">
				<input class="itxt" name="nickname" maxlength="20" placeholder="您的昵称" type="text" />
			</div>
		</div>
		<div class="clear"></div>
		<div class="item">
			<span class="label"><em>*</em> 所属门店：</span>
			<div class="fl">
			<div id="test1">
				<input type="hidden" class="province" value=""/>
				<input type="hidden" class="city" value=""/>
				<input type="hidden" class="area" value=""/>
				<div name="province" type="selectbox" style="z-index:2;"><div class="opts"></div></div>
				<div name="city" type="selectbox" style="z-index:2;"><div class="opts"></div></div>
				<div name="area" type="selectbox" style="z-index:2;"><div class="opts"></div></div>
			</div>
			</div>
		</div>
		<div class="clear"></div>
		<div class="item">
			<span class="label"><em>*</em> 手机号：</span>
			<div class="fl">
				<input class="itxt" name="mobile" maxlength="20" placeholder="建议使用常用手机"  type="text" id="tel"/>
			</div>
			<div class="clear"></div>
		</div>
		<div class="item">
			<span class="label"><em>*</em> 手机验证码：</span>
			<div class="fl">
				<input class="itxt" maxlength="20" placeholder="请输入手机验证码" type="text" name="validcode"/> <input type="button" class="person-code-btn" onclick="getCode('{{url('login/ajaxValidcodeByMobile')}}',$('#tel').val(),this);" value="获取验证码"/>
			</div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="box-shadow-in"></div>
	<div class="node">
		<div class="node-title">设置登录密码</div>
		<div class="node-intro">密码由 8-32 位字符组成，需至少包含一个大写字母、一个小写字母和一个数字，建议不与其他密码相同</div>
		<div class="item">
			<span class="label"><em>*</em> 设置密码：</span>
			<div class="fl">
				<input class="itxt" name="password" maxlength="20" placeholder="请输入密码" type="password" />
			</div>
		</div>
		<div class="clear"></div>
		<div class="item">
			<span class="label"><em>*</em> 确认密码：</span>
			<div class="fl">
				<input class="itxt" name="rePassword" maxlength="20" placeholder="请再次输入密码" type="password" />
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="box-shadow-in"></div>
	<div class="register">
		<button type="submit" class="btn-register">立即注册</button>
	</div>
</div>
<div class="clear"></div>
@endsection
@section('js')
<script type="text/javascript" src="{{asset('vendors/jquery.inputbox/jquery.inputbox.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/jquery.ganged/jquery.ganged.js')}}"></script>
<script type="text/javascript">
	$(function(){
		$.get("{{url('store/ajaxRegionList')}}",function(result){
			var data = result;
			$('#test1').ganged({'data': data, 'width': 100, 'height': 30});
			$('#test2').ganged({'data': data});
		});
	})

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
	function register() {
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