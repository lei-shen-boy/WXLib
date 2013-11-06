<?php
require_once 'AccessTokenRequest.php';
/**
 * @todo $apiOptions should be configed from a config center
 *
 */
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
                'accessToken' => 'abc',
                'updatedTime' => '12345678'
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
        /*
        $this->getLocal();
        if ($this->getUpdatedTime() + self::EXPIRES_IN > time()) {
            $this->getFromRequest();
            $this->updateLocal();
        }
        */
        $this->getFromRequest();
        
        return $this->getAccessToken();
    }
}
?>