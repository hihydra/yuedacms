@extends('layouts.front')
@section('title'){{$name}}-@endsection
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
					<input class="itxt" maxlength="20" type="text" id="tel" name="mobile" />
					<input type="button" class="person-code-btn" onclick="getCode('{{url('register/ajaxValidcode')}}',$('#tel').val(),this);" value="获取验证码"/>
				</div>
			</div>
			<div class="clear"></div>
			<div class="item">
				<span class="label"><em>*</em> 手机验证码：</span>
				<div class="fl">
					<input class="itxt" name="validcode" maxlength="20" value="" type="text" />
				</div>
			</div>
			<div class="clear"></div>
			<div class="item">
				<span class="label">&nbsp;</span>
				<div class="info-c">
					<a class="btn_red" href="javascript:changeMobile();">保存</a>
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
	function changeMobile(){
		var mobile = $("input[name='mobile']").val();
		var validcode = $("input[name='validcode']").val();
		if(mobile.length ==0 || validcode.length ==0){
			layer.msg("{{trans('front/system.mobile_validcode_error')}}");return;
		}
		var params = {};
	    params.url = "{{url('user/changeMobile_check')}}";
	    params.postData = {'mobile':mobile,'validcode':validcode};
	    params.postType = 'post';
	    params.mustCallBack = true;// 是否必须回调
	    params.callBack = function(json) {
	      window.location.reload();
	    };
	    ajaxJSON(params);
	}
	function changePassword(){
		var oldpassword = $("input[name='oldpassword']").val();
		var newpassword = $("input[name='newpassword']").val();
		var reNewpassword = $("input[name='reNewpassword']").val();
		if(oldpassword.length<5 || newpassword.length<5 || reNewpassword.length<5){
				layer.msg("{{trans('front/system.password_error')}}");return;
		}
		if(newpassword != reNewpassword){
				layer.msg("{{trans('front/system.repassword_error')}}");return;
		}

		var params = {};
	    params.url = "{{url('user/ajaxChangePassword')}}";
	    params.postData = {'oldpassword':oldpassword,'newpassword':newpassword};
	    params.postType = 'post';
	    params.mustCallBack = true;// 是否必须回调
	    params.callBack = function(json) {
	      window.location.reload();
	    };
	    ajaxJSON(params);
	}
</script>
@endsection
