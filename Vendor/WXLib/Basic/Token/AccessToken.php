<?php
/**
 * @todo $apiOptions should be configed from a config center
 *
 */
namespace WXLib\Basic\Token;
use WXLib\Basic\Token\AccessTokenRequest;

class AccessToken
{
    const EXPIRES_IN = 7200;

    protected $accessToken;
    
    protected $updatedTime;
    
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
        
        return $this;
    }

    public function setExpiresIn($expiresIn)
    {
        $this->expiresIn = $expiresIn;
        
        return $this;
    }
    
    public function setUpdatedTime($updatedTime)
    {
        $this->updatedTime = $updatedTime;
    
        return $this;
    }
    
    public function getAccessToken()
    {
        return $this->accessToken;
    }
    
    public function getExpiresIn()
    {
        return $this->expiresIn;
    }
    
    public function getUpdatedTime()
    {
        return $this->updatedTime;
    }
    
    public function getFromRequest()
    {
        $newToken = (new AccessTokenRequest())->getToken();
        $this->setAccessToken($newToken['accessToken']);
        $this->setUpdatedTime(time());
    }
    
    public function getFromLocal()
    {
        //@todo 从本地获取accessToken
        $localToken = array(
                'accessToken' => 'PP6ei_QjFP7nr44U6I0SqDTLPWKkCOnoXFXGFVr9BXMcUop90i0vgHwXJ9QtB8y1M1v0oNMNJrMWxZaJOafRQOiI84VPxI48RpqERcRbe6RuL2G9IYbg0pNf1NvwSO1H7pI1AfEA_rUn1gf9bXrl3g',
                'updatedTime' => time()
        );
        $this->setAccessToken($localToken['accessToken']);
        $this->setUpdatedTime($localToken['updatedTime']);
    }
    
    public function updateLocal()
    {
        //@todo 将accessToken写入本地存储位置，比如mysql
    }
    
    public function get()
    {
        $this->getFromLocal();
        if ($this->getUpdatedTime() + self::EXPIRES_IN < time()) {
            $this->getFromRequest();
            $this->updateLocal();
        }
        
        return $this->getAccessToken();
    }
}
?>