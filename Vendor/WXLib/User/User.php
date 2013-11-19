<?php
/**
 * 分组管理接口
 *
 */
namespace WXlib\User;

use WXLib\Basic\Request;
use WXLib\Basic\RawBodyRequest;

class User
{
    /**
     * 获取用户基本信息
     * @param string $userOpenId
     * @return array
array(10) {
  ["subscribe"]=>
  int(1)
  ["openid"]=>
  string(28) "sdfasdfasfafadfasffasfafasdf"
  ["nickname"]=>
  string(6) "abc"
  ["sex"]=>
  int(1)
  ["language"]=>
  string(5) "zh_CN"
  ["city"]=>
  string(6) "朝阳"
  ["province"]=>
  string(6) "北京"
  ["country"]=>
  string(6) "中国"
  ["headimgurl"]=>
  string(128) "http://wx.qlogo.cn/mmopen/fasdfsadfasdfasdfasdfasdffpPsWoqsmEamlzurSUoRCgY4JQ9G2zL36Q7Q8iaDV0HIbkYbGTNicGdYzvU7lKAib/0"
  ["subscribe_time"]=>
  int(138444444)
}
     */
    public static function info($userOpenId)
    {
        $request = new Request(array(
                'method' => 'GET',
                'url' => 'https://api.weixin.qq.com/cgi-bin/user/info',
                'params' => array(
                        'openid' => $userOpenId
                )
        
        ));
        
        return $request->send();
    }
    
    /**
     * 获取关注者列表
     * @param string $nextOpenId
     * @return array
array(4) {
  ["total"]=>
  int(69)
  ["count"]=>
  int(69)
  ["data"]=>
  array(1) {
    ["openid"]=>
    array(69) {
      [0]=>
      string(28) "sdfasdfasfafadfasffasfafasdf"
      [1]=>
      string(28) "sdfasdfasfafadfasffasfafasdf"
      [2]=>
      string(28) "sdfasdfasfafadfasffasfafasdf"
      [3]=>
      string(28) "sdfasdfasfafadfasffasfafasdf"
      [4]=>
      string(28) "sdfasdfasfafadfasffasfafasdf"
      [5]=>
      string(28) "sdfasdfasfafadfasffasfafasdf"
      [6]=>
      string(28) "sdfasdfasfafadfasffasfafasdf"
      [7]=>
      ...
      ...
    }
  }
  ["next_openid"]=>
  string(28) "sdfasdfasfafadfasffasfafasdf"
}
     */
    public static function getFollowers($nextOpenId = null)
    {
        $request = new Request(array(
                'method' => 'GET',
                'url' => 'https://api.weixin.qq.com/cgi-bin/user/get',
                'params' => array(
                        'next_openid' => $nextOpenId
                )
        
        ));
        
        return $request->send();
    }
    
    /**
     * 生成用户授权页面地址
     * @param unknown $appId
     * @param unknown $redirectUri
     * @param unknown $scope
     * @param string $state
     * @param string $wechatRedirect
     * @return string
     */
    public static function getOauthUrl($appId, $redirectUri, $scope, $state = '', $wechatRedirect = false)
    {
        $params = array(
                'appid' => $appId,
                'redirect_uri' => $redirectUri,
                'response_type' => 'code',
                'scope' => $scope,
                'state' => $state,
        );
        if ($wechatRedirect) {
            array_push($params, array('#wechat_redirect' => $wechatRedirect));
        }
        
        $queryString = http_build_query($params);
        return 'https://open.weixin.qq.com/connect/oauth2/authorize?' . $queryString;
    }
    
    /**
     * 通过code换取网页授权access_token
     * @param unknown $code
     * @param string $grant_type
     * @param unknown $appid
     * @param unknown $secret
     */
    public static function  getOauthAccessToken($code, $grant_type = 'authorization_code', $appid, $secret)
    {
        $request = new Request(array(
                'method' => 'GET',
                'url' => 'https://api.weixin.qq.com/sns/oauth2/access_token',
                'params' => array(
                        'appid' => $appid,
                        'secret' => $secret,
                        'code' => $code,
                        'grant_type' => $grant_type
                )
        
        ));
        
        return $request->send();
    }
    
    /**
     * 刷新access_token
     * @param unknown $refresh_token
     * @param unknown $appid
     * @param string $grant_type
     * @return mixed
     */
    public static function getOauthRefreshedAccessToken($refresh_token, $appid, $grant_type='refresh_token')
    {
        $request = new Request(array(
                'method' => 'GET',
                'url' => 'https://api.weixin.qq.com/sns/oauth2/refresh_token',
                'params' => array(
                        'appid' => $appid,
                        'grant_type' => $grant_type,
                        'refresh_token' => $refresh_token,
                )
        
        ));
        
        return $request->send();
    }
    
    /**
     * 拉取用户信息(需scope为 snsapi_userinfo)
     * @param unknown $oAuthAccessToken
     * @param unknown $UserOpenId
     * @return mixed
     */
    public static function getOauthUserInfo($oAuthAccessToken, $UserOpenId)
    {
        $request = new Request(array(
                'method' => 'GET',
                'url' => 'https://api.weixin.qq.com/sns/userinfo',
                'params' => array(
                        'access_token' => $oAuthAccessToken,
                        'openid' => $UserOpenId,
                )
        
        ));
        
        return $request->send();
    }
    
    public function goAuthAction()
    {
        $REDIRECT_URI = urlencode('');
        $SCOPE = 'snsapi_base';
        $SCOPE = 'snsapi_userinfo';
        $STATE = '';
        $appid = '';
        $wxUrl = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$REDIRECT_URI&response_type=code&scope=$SCOPE&state=$STATE#wechat_redirect";
        header("Location: $wxUrl");
        exit;
    }
    
    public function receAuthAction()
    {
        $code = $this->request->getGetParameter('code');
        $res = $this->requestOpenId($code);
        var_dump($res);
        $res = $this->reqUserInfo($res['access_token'], $res['openid']);
        var_dump($res);
    }
    
    /**
     * 获取openid和access_token
     * @param unknown $code
     * @return Ambigous <mixed, boolean, array>
     */
    protected function requestOpenId($code)
    {
        $appid = '';
        $secret = '';
        $grant_type = 'authorization_code';
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$secret&code=$code&grant_type=$grant_type";
    
        $curl->setOptions(array(
                CURLOPT_TIMEOUT => 3
        ));
        $curl->setExtranetHttpProxy();
        $jsonCallback = $curl->sendByGet('', $url);
         
        $json_obj = new JSON();
        return $json_obj->unserialize($jsonCallback);
    }
    
    protected function reqUserInfo($accessToken, $openId)
    {
        $url = "https://api.weixin.qq.com/sns/userinfo?access_token=$accessToken&openid=$openId";
        $curl = new TMCurl();
        $curl->setOptions(array(
                CURLOPT_TIMEOUT => 3
        ));
        $curl->setExtranetHttpProxy();
        $jsonCallback = $curl->sendByGet('', $url);
         
        $json_obj = new JSON();
        return $json_obj->unserialize($jsonCallback);
    }
    
    protected function refreshAccessToken($refreshToken)
    {
        $url = 'https://api.weixin.qq.com/sns/oauth2/refresh_token?appid=APPID&grant_type=refresh_token&refresh_token=REFRESH_TOKEN';
        $res = '';
    
        return $res;
    }
    
}
?>