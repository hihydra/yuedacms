var CODE_NETWORK_ERROR	= 0;
var CODE_SUCCESS		= 1;
var CODE_NOT_LOGIN		= 2;

function convertMoney(price){
	return parseInt(price*100+0.5)/100;
}
	function tel(){
		var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
		if(!myreg.test($('#tel').val()))
		{
			layer.msg('��������Ч���ֻ����룡');
			$('#tel').focus();
			return false;
		}else{
			return true;
		}
	}