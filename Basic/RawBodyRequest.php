<?php
/**
 * @todo $apiOptions should be configed from a config center
 *
 */
require_once 'AbstractRequest.php';
require_once 'AccessToken.php';

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
    
    public function __construct($accessToken= null)
    {
        parent::__construct();
        if ($accessToken == null) {
            $accessToken = (new AccessToken())->get();
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