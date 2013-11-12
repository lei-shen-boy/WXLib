<?php
/**
 * @todo $apiOptions should be configed from a config center
 *
 */

namespace WXLib\Basic;
use WXLib\Basic\AbstractRequest;
use WXLib\Basic\Token\AccessToken;

class RawBodyRequest extends AbstractRequest
{
    protected $accessToken;
    
    protected $rawBody;
    
    public function setAccessToken($accessToken) 
    {
        $this->accessToken = $accessToken;
        
        return $this;
    }
    
    public function getAccessToken()
    {
        return $this->accessToken;
    }
    
    public function setRawBody($rowBody)
    {
        $this->rawBody = $rowBody;
    }
    
    public function getRawBody()
    {
        return $this->rawBody;
    }
    
    public function __construct($apiOptions = null)
    {
        parent::__construct($apiOptions);
        if (!isset($apiOptions['accessToken'])) {
            $accessToken = (new AccessToken())->get();
        } else {
            $accessToken = $apiOptions['accessToken'];
        }
        $this->setAccessToken($accessToken);
        $this->getRequest()->getUrl()->setQueryVariable('access_token', $this->getAccessToken());
    }
    
    public function send()
    {
        $this->request->setBody($this->getRawBody());
        return parent::send();
    }
}
?>