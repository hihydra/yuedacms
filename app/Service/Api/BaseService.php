<?php
namespace App\Service\Api;

use Cookie;
/**
* 基类service
*/
class BaseService
{
	public function __construct(){
        $this->url = env('API_URL');
		$this->client = new \GuzzleHttp\Client(['base_uri' => env('API_URL'),'verify' => base_path('cacert.pem')]);  //api接口地址
        $this->api_sessionid = env('API_SESSIONID');
	}

	public function http_curl($path,$query,$mothod="GET",$cookie=false){
        $querys['query'] = $query;
        if (cookie::get($this->api_sessionid)&&!$cookie) {
            $querys['headers'] = array('cookie'=>cookie::get($this->api_sessionid));
        }
    	$response = $this->client->request($mothod,$path,$querys);
    	if ($response->getStatusCode() == 200) {
    		$body = json_decode($response->getbody(),true);
            switch ($body['result']) {
                case '1':
                    if($cookie){
                        $cookie_data = $response->getHeader('Set-Cookie');
                        $body['API_SESSIONID'] = array_first($cookie_data);
                        return $body;
                    }
                    return $body['data'];
                    break;
                case '2':
                    header('Location: '.url('/login'));
                    break;
                default:
                    flash_info(false,$body['message'],$body['message']);
                    break;
            }
		}else{
			abort(500);
		}
    }
}