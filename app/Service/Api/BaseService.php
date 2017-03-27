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
		$this->client = new \GuzzleHttp\Client(['base_uri' => env('API_URL')]);  //api接口地址
	}

	public function http_curl($path,$query,$mothod="GET",$cookie=false){
        $querys['query'] = $query;
        if (cookie::get('API_SESSIONID')&&!$cookie) {
            $querys['headers'] = array('cookie'=>cookie::get('API_SESSIONID'));
        }
    	$response = $this->client->request($mothod,$path,$querys);
    	if ($response->getStatusCode() == 200) {
    		$body = json_decode($response->getbody());
            switch ($body->result) {
                case '1':
                    if($cookie){
                        $cookie_data = $response->getHeader('Set-Cookie');
                        $body->API_SESSIONID = $cookie_data[0];
                        return $body;
                    }
                    dd($body);
                    return $body->data;
                    break;
                case '2':
                    header('Location: '.url('/login'));
                    break;
                default:
                    flash_info(false,$body->message,$body->message);
                    break;
            }
		}else{
			abort(500);
		}
    }
}