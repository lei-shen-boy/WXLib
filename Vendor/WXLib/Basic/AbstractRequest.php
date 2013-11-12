<?php
namespace WXLib\Basic;
require_once 'Vendor/PEAR/HTTP/Request2.php';

abstract class AbstractRequest implements RequestInterface
{
    protected $apiOptions = array(
            'method' => '',
            'url' => '',
            'params' => array(
            )
    );
    
    protected $request;
    
    public function __construct($apiOptions = null)
    {
        if (is_array($apiOptions)) {
            if (isset($apiOptions['method'])) {
                $this->setApiMethod($apiOptions['method']);
            }
            if (isset($apiOptions['url'])) {
                $this->setApiUrl($apiOptions['url']);
            }
            if (isset($apiOptions['params'])) {
                $this->setApiParams($apiOptions['params']);
            }
        }
        $this->setRequest();
    }
    
    public function setApiUrl($url)
    {
        $this->apiOptions['url'] = $url; 
    }
    
    public function setApiMethod($method)
    {
        $this->apiOptions['method'] = $method;
    }
    
    public function setApiParams($params)
    {
        if (!is_array($params)) {
            throw new \Exception('params must be array');
        }
        $this->apiOptions['params'] = $params;
    }
    
    public function getRequest()
    {
        return $this->request;
    }
    
    public function setRequest()
    {
        $request = new \HTTP_Request2($this->apiOptions['url'], $this->apiOptions['method']);
        /*
        $request->setConfig(array(
                'proxy_host'        => 'web-proxy.oa.com',
                'proxy_port'        => 8080,
        ));
        */
        if ($request->getUrl()->getScheme() == 'https') {
            $request->setConfig(array(
                    'ssl_verify_peer' => false,
                    'ssl_verify_host' => false
            ));
        }
        
        if ($this->apiOptions['method'] != \HTTP_Request2::METHOD_GET && $this->apiOptions['method'] != \HTTP_Request2::METHOD_POST) {
            throw new \Exception('Error:' . __METHOD__);
        }
        
        if ($this->apiOptions['method'] == \HTTP_Request2::METHOD_GET && isset($this->apiOptions['params'])) {
            $request->getUrl()->setQueryVariables($this->apiOptions['params']);
        } elseif ($this->apiOptions['method'] == \HTTP_Request2::METHOD_POST && isset($this->apiOptions['params'])) {
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
            throw new \Exception('Error' . $response->getStatus());
        }
    }
    
    protected function parseResponse($response)
    {
        $res = json_decode($response->getBody(), true);
        if (isset($res['errcode']) && $res['errcode'] != 0) {
            throw new \Exception('Error: ' . $res['errmsg']);
        }
    
        return $res;
    }
}
?>