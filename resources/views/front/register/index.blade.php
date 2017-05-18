@extends('layouts.front')
@section('title')注册-@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/jquery.inputbox/jquery.inputbox.css')}}">
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
				<div name="city" type="selectbox">
					<div class="opts">
						<a class="selected">请选择城市</a>
						@foreach($regionList as $region)
						<a href="javascript:getStore({{$region['id']}});" val="{{$region['id']}}">{{$region['name']}}</a>
						@endforeach
					</div>
				</div>
				<div name="store" type="selectbox">
					<div class="opts">
						<a class="selected">请选择门店</a>
					</div>
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
				<input class="itxt" maxlength="20" placeholder="请输入手机验证码" type="text" name="validcode"/> <input type="button" class="person-code-btn" onclick="getCode('{{url('register/ajaxValidcode')}}',$('#tel').val(),this);" value="获取验证码"/>
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
		<button type="button" class="btn-register" onclick="register();">立即注册</button>
	</div>
</div>
<div class="clear"></div>
@endsection
@section('js')
<script type="text/javascript" src="{{asset('vendors/jquery.inputbox/jquery.inputbox.js')}}"></script>
<script type="text/javascript">
	$('div[name="city"]').inputbox({
		height:30,
		width:156
	});
	$('div[name="store"]').inputbox({
		height:30,
		width:156
	});
	function getStore(regionId){
		$.get("{{url('store/ajaxStorefront')}}/"+regionId,function(result){
			if(result.datas){
				$('div[name="store"] .selected').html('请选择门店');
				$('input[name="store"]').val('');
				var html ="<a class='selected'>请选择门店</a>";
				$.each(result.datas,function(i,data){
					html+="<a val="+data.id+">"+ data.name +"</a>";
				});
				$('div[name="store"] .opts').html(html);
			}else{
				layer.msg('{{trans("front/system.getStore")}}');
			}
		});
	}
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
		var nickname = $("input[name='nickname']").val();
		var mobile = $("input[name='mobile']").val();
		var password = $("input[name='password']").val();
		var rePassword = $("input[name='rePassword']").val();
		var validcode = $("input[name='validcode']").val();
		if(nickname.length ==0){
			layer.msg("{{trans('front/system.nickname_error')}}");return;
		}
		if(mobile.length ==0 || validcode.length ==0){
			layer.msg("{{trans('front/system.mobile_validcode_error')}}");return;
		}
		if(!$('input[name="store"]').val()){
			layer.msg("{{trans('front/system.store_error')}}");return;
		}
		if(password != rePassword){
			layer.msg("{{trans('front/system.repassword_error')}}");return;
		}
		$.post("{{url('register/register_check')}}",{'nickname':nickname,'mobile':mobile,'password':password,'validcode':validcode,'storeId':$('input[name="store"]').val()},function(result){
			layer.msg(result.message);
			if(result.result == 1){
				location.href = "{{url('login')}}";
			}
		});
	}
</script>
@endsection