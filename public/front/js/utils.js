var CODE_NETWORK_ERROR	= 0;
var CODE_SUCCESS		= 1;
var CODE_NOT_LOGIN		= 2;

function convertMoney(price){
	return parseInt(price*100+0.5)/100;
}