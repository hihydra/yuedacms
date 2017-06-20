<?php
namespace App\Service\Api;

use Cookie;
/**
* 基类service
*/
class BaseService
{
    public $url;
    public $client;
    public $api_sessionid;
    public $CODE_NETWORK_ERROR  = 0;
    public $CODE_SUCCESS        = 1;
    public $CODE_NOT_LOGIN      = 2;

	public function __construct(){
        $this->url = env('API_URL');
		$this->client = new \GuzzleHttp\Client(['base_uri' => env('API_URL'),'verify' => base_path('cacert.pem')]);
        $this->api_sessionid = env('API_SESSIONID');
	}

	public function http_curl($path,$query,$mothod="GET",$json=false,$cookie=false,$type='query'){
        $querys[$type] = $query;
        if (cookie::get($this->api_sessionid)&&!$cookie) {
            $querys['headers'] = array('cookie'=>cookie::get($this->api_sessionid));
        }
    	$response = $this->client->request($mothod,$path,$querys);

    	if ($response->getStatusCode() == 200) {
    		$body = json_decode($response->getbody(),true);
            if ($json) {
                if($body['result'] == $this->CODE_NOT_LOGIN){
                    $body['loginUrl'] = url('/login');
                }
                if($cookie&&$body['result']==$this->CODE_SUCCESS){
                    $cookie_data = $response->getHeader('Set-Cookie');
                    $body[$this->api_sessionid] = array_first($cookie_data);
                }
                return $body;
            }else{
                switch ($body['result']) {
                    case $this->CODE_SUCCESS:
                        if(isset($body['data'])){
                            return $body['data'];
                        }else{
                            return $body;
                        }
                        break;
                    case $this->CODE_NOT_LOGIN:
                        header('Location: '.url('/login'));exit;
                        break;
                    default:
                        abort(404,$body['message']);
                        break;
                }
            }
		}else{
			abort(500);
		}
    }
}