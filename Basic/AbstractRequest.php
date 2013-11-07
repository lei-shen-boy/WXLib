<?php 
require_once 'RequestInterface.php';
require_once 'HTTP/Request2.php';

abstract class AbstractRequest implements RequestInterface
{
    protected $apiOptions = array(
            'method' => '',
            'url' => '',
            'params' => array(
            )
    );
    
    protected $request;
    
    public function __construct()
    {
        $this->setRequest();
    }
    
    public function getRequest()
    {
        return $this->request;
    }
    
    public function setRequest()
    {
        $request = new HTTP_Request2($this->apiOptions['url'], $this->apiOptions['method']);
        if ($request->getUrl()->getScheme() == 'https') {
            $request->setConfig(array(
                    'ssl_verify_peer' => false,
                    'ssl_verify_host' => false
            ));
        }
        
        if ($this->apiOptions['method'] != HTTP_Request2::METHOD_GET && $this->apiOptions['method'] != HTTP_Request2::METHOD_POST) {
            throw new Exception('Error:' . __METHOD__);
        }
        
        if ($this->apiOptions['method'] == HTTP_Request2::METHOD_GET && isset($this->apiOptions['params'])) {
            $request->getUrl()->setQueryVariables($this->apiOptions['params']);
        } elseif ($this->apiOptions['method'] == HTTP_Request2::METHOD_POST && isset($this->apiOptions['params'])) {
            $request->addPostParameter($this->apiOptions['params']);
        } 
        
        $this->request = $request;
        
        return $this;
    }
    
    public function send()
    {
        $response = $this->getRequest()->send();
        if ($response->getStatus() == 200) {
            return $this->parseResponse($response);
        } else {
            throw new Exception('Error' . $response->getStatus());
        }
    }
    
    protected function parseResponse($response)
    {
        $res = json_decode($response->getBody(), true);
        if (isset($res['errcode'])) {
            throw new Exception('Error: ' . $res['errmsg']);
        }
    
        return $res;
    }
}
?>