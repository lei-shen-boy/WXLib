<?php
require_once 'HTTP/Request2.php';

class Basic
{
    /**
     * 获取access_token
     * https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=APPID&secret=APPSECRET
     * https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wxdd09ac20392be5cd&secret=9092deff10e20af3af3b68e87aed800c
     * @var unknown
     */
    const WX_API_HOST = 'https://api.weixin.qq.com/';
    const WX_API_PATH = 'cgi-bin/';
    const WX_API_TOKEN = 'token/';
    
    
    static function getRequest($url='', $method=HTTP_Request2::METHOD_GET)
    {
        $request = new HTTP_Request2($url, $method);
        $request->setConfig(array(
                'proxy_host'        => 'web-proxy.oa.com',
                'proxy_port'        => 8080,
        ));
        
        return $request;
    }
    
    static function getAccessTokenAPI()
    {
        return self::WX_API_HOST . self::WX_API_PATH . self::WX_API_TOKEN;
    }
    
    static function getAccessToken()
    {
        $request = self::getRequest(self::getAccessTokenAPI());
        $url = $request->getUrl();
        $url->setQueryVariables(array(
                'grant_type' => 'client_credential',
                'appid'       => 'wxdd09ac20392be5cd',
                'secret' => '9092deff10e20af3af3b68e87aed800c'
        ));
        $response = $request->send();
        return $response->getBody();
    }        
}
?>