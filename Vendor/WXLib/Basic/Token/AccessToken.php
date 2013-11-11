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
                'accessToken' => 'zirjsruhwjVxxFhD_SVkoYouZSVpUm4XD7LPsV_KAz9hk1oZgKszTqWPkEPg58xQOPSr6muKwJM_20PlZu4vUQLuMCG_H_qp259py9uGFgbQhEnPsXlRFa3jvDOajDdC1Ha--fcFx0esppECrGTpfQ',
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