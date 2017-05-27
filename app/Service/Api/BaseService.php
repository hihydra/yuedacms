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

	public function __construct(){
        $this->url = env('API_URL');
		$this->client = new \GuzzleHttp\Client(['base_uri' => env('API_URL'),'verify' => base_path('cacert.pem')]);
        $this->api_sessionid = env('API_SESSIONID');
	}

	public function http_curl($path,$query,$mothod="GET",$cookie=false,$abort=true,$type='query'){
        $querys[$type] = $query;
        if (cookie::get($this->api_sessionid)&&!$cookie) {
            $querys['headers'] = array('cookie'=>cookie::get($this->api_sessionid));
        }
    	$response = $this->client->request($mothod,$path,$querys);
    	if ($response->getStatusCode() == 200) {
    		$body = json_decode($response->getbody(),true);
            //dd($body);
            switch ($body['result']) {
                case '1':
                    if($cookie){
                        $cookie_data = $response->getHeader('Set-Cookie');
                        $body['API_SESSIONID'] = array_first($cookie_data);
                    }
                    if(isset($body['data'])){
                        return $body['data'];
                    }else{
                        return $body;
                    }
                    break;
                case '2':
                    if($abort){
                        header('Location: '.url('/login'));exit;
                    }else{
                        return false;
                    }
                    break;
                default:
                    if($abort){
                        return $body;
                    }else{
                        abort(404,$body['message']);
                    }
                    break;
            }
		}else{
			abort(500);
		}
    }
}