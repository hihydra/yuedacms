@extends('layouts.front')
@section('title'){{$name}}-@endsection
@section('css')
<style type="text/css">
	.person-code-btn{
        margin: 0 0 0 15px;
        padding: 7px 10px;
        background: #fff;
        border: 1px solid #ff6280;
        color: #ff6280;
    }
</style>
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
						<a href="{{url('user')}}" class="smooth">{{trans('front/system.userInfo')}}</a>
						<b></b>
					</li>
					<li class="on">
						<a href="{{url('user/safe')}}" class="smooth">{{trans('front/system.safe')}}</a>
						<b></b>
					</li>
					<div class="clear"></div>
				</ul>
			</div>
		</div>
		<div style="width:930px; margin:20px 0 10px 0;">
			<div class="item">
				<span class="label"><em>*</em> 更换手机号码：</span>
				<div class="fl">
					<input class="itxt" maxlength="20" type="text" id="tel"/>
					<input type="button" class="person-code-btn" onclick="getCode('{{url('user/ajaxValidcode')}}',$('#tel'),this);" value="获取验证码"/>
				</div>
			</div>
			<div class="clear"></div>
			<div class="item">
				<span class="label"><em>*</em> 手机验证码：</span>
				<div class="fl">
					<input class="itxt" maxlength="20" value="" type="text" />
				</div>
			</div>
			<div class="clear"></div>
			<div class="item">
				<span class="label">&nbsp;</span>
				<div class="info-c">
					<a class="btn_red" href="#">保存</a>
				</div>
			</div>
			<br><br>
			<div class="clear" style="border-bottom:1px dashed #CCC; margin-bottom:10px;"></div>
			<div class="item">
				<span class="label"><em>*</em> 旧密码：</span>
				<div class="fl">
					<input class="itxt" maxlength="20" name="oldpassword"  type="password" />
				</div>
			</div>
			<div class="clear"></div>
			<div class="item">
				<span class="label"><em>*</em> 新密码：</span>
				<div class="fl">
					<input class="itxt" maxlength="20" name="newpassword"  type="password" />
				</div>
			</div>
			<div class="clear"></div>
			<div class="item">
				<span class="label"><em>*</em> 确认新密码：</span>
				<div class="fl">
					<input class="itxt" maxlength="20" name="reNewpassword"  type="password" />
				</div>
			</div>
			<div class="clear"></div>
			<div class="item">
				<span class="label">&nbsp;</span>
				<div class="info-c">
					<a class="btn_red" href="javascript:changePassword();">保存</a>
				</div>
			</div>
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
			alert('请输入有效的手机号码！');
			$('#tel').focus();
			return false;
		}else{
			return true;
		}
	}
	function getCode(url,mobile,obj){
		if(tel()){
			$.post(url,function(result){
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
	function changePassword(){
		var oldpassword = $("input[name='oldpassword']").val();
		var newpassword = $("input[name='newpassword']").val();
		var reNewpassword = $("input[name='reNewpassword']").val();
		if(oldpassword.length<5 || newpassword.length<5 || reNewpassword.length<5){
				layer.msg("{{trans('front/system.password_error')}}");return;
		}
		if(newpassword.length != reNewpassword.length){
				layer.msg("{{trans('front/system.repassword_error')}}");return;
		}
		$.post("{{url('user/ajaxChangePassword')}}",{'oldpassword':oldpassword,'newpassword':newpassword},function(result){
			layer.msg(result.message);
			if(result.result == 1){
				window.location.reload();
			}
		});
	}
</script>
@endsection
