<?php
require_once 'AbstractRequest.php';
/**
 * @todo $apiOptions should be configed from a config center
 *
 */
class AccessTokenRequest extends AbstractRequest
{
    /**
     * Internal options array
     */
    protected $apiOptions = array(
        'method' => HTTP_Request2::METHOD_GET,
        'url' => 'https://api.weixin.qq.com/cgi-bin/token',
        'params' => array(
            'grant_type' => 'client_credential',
            'appid'    => 'appid1',
            'secret'    => 'secret1',
        )
    );
    
    public function __construct()
    {
        $this->apiOptions = array(
            'method' => HTTP_Request2::METHOD_GET,
            'url' => 'https://api.weixin.qq.com/cgi-bin/token',
            'params' => array(
                'grant_type' => 'client_credential',
                'appid'    => 'wxdd09ac20392be5cd',
                'secret'    => '9092deff10e20af3af3b68e87aed800c',
            )
        );
        parent::__construct();
    }
    
    public function getToken()
    {
        $res = $this->send();
        $token['accessToken'] = $res['access_token'];
        $token['expiresIn'] = $res['expires_in'];
        
        return $token;
    }
    
    
}
?>