var CODE_NETWORK_ERROR	= 0;
var CODE_SUCCESS		= 1;
var CODE_NOT_LOGIN		= 2;
var countdown = 60;

function convertMoney(price){
	return parseInt(price*100+0.5)/100;
}

function ajaxJSON(params){
	$.ajax({
		url: params.url,
		data: params.postData,
		type: params.postType,
		dataType: "json",
		success: function(json){
			if(json.result==CODE_NOT_LOGIN){
				location.replace(json.loginUrl);
			}else if(json.result==CODE_SUCCESS){
				if(json.message!=null){
					layer.msg(json.message);
				}
				params.callBack(json);
			}else{
				layer.msg(json.message==null?params.error:json.message);
			}
		},
		error:function(){
			layer.msg('请求错误');
		}
	});
}

function tel(){
	var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
	if(!myreg.test($('#tel').val()))
	{
		layer.msg('请输入有效的手机号码！');
		$('#tel').focus();
		return false;
	}else{
		return true;
	}
}

function getCode(url,mobile,obj){
	if(tel()){
		var params = {};
	    params.url = url;
	    params.postData = {'mobile':mobile};
	    params.postType = 'post';
	    params.mustCallBack = true;// 是否必须回调
	    params.callBack = function(json) {
	      settime(obj);
	    };
	    ajaxJSON(params);
	}
}

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