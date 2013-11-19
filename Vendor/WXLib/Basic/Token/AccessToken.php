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
                'accessToken' => 'SM6rqKqCRkXAZnCrv-aY8YCkA3mXKM7p56Bk2IsnEbm2PIg7cyt71HiVUwo0i0ZIXZII2uorWZ5sFNsmhCNCrIo7U-6_2InSCdSXsdNii8ygkRnzZP_HWrgkK5hZDwdtTOSZplTCz_E7D-y75R2FpQ',
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