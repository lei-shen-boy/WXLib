<?php
/**
 * 发送客服消息
 * @author huichaozh
 *
 */
namespace WXLib\Message\CustomerService;

use WXLib\Basic\RawBodyRequest;
use WXLib\Constants;

abstract class AbstractCSMessage extends RawBodyRequest implements AbstractCSMessageInterface
{
    protected $apiOptions = array(
            'method' => 'POST',
            'url' => 'https://api.weixin.qq.com/cgi-bin/message/custom/send',
    );
    
    protected $fieldNames = array();
    
    protected $toUser;
    
    protected $messageType;
    
    protected $options = array();
    
    public function __construct($message = null, $accessToken = null)
    {
        if (isset($message) && !is_array($message)) {
            throw new \Exception(sprintf(
                    'Expecting a string or array, received "%s"',
                    (is_object($message) ? get_class($message) : gettype($message))
            ));
        }
        $this->initFieldNames();
        $this->init($message);
        parent::__construct($accessToken);
    }
    
    public function initFieldNames()
    {
        $this->fieldNames = array(Constants::CS_TO_USER_FIELD, Constants::CS_MESSAGE_TYPE_FIELD);
    }
    
    public function setOption($field, $value)
    {
        $this->checkFieldName($field);
        $this->options[$field] = $value;
    }
    
    public function getOption($field)
    {
        return $this->options[$field];
    }
    
    public function getOptions()
    {
        return $this->options;
    }
    
    abstract public function setDetailOptions();
    
    public function buildOptions()
    {
        $this->setOption(Constants::CS_TO_USER_FIELD, $this->getToUser());
        $this->setOption(Constants::CS_MESSAGE_TYPE_FIELD, $this->getMessageType());
        $this->setDetailOptions();
    }
    
    public function checkFieldName($field)
    {
        if (!in_array($field, $this->fieldNames)) {
            throw new \Exception('Error:' . __METHOD__);
        }
    }
    
    public function setToUser($user)
    {
        $this->toUser = $user;
        
    
        return $this;
    }
    
    public function getToUser()
    {
        return $this->toUser;
    }
    
    public function setMessageType($messageType)
    {
        $this->messageType = $messageType;
    
        return $this;
    }
    
    public function getMessageType()
    {
        return $this->messageType;
    }
    
    /**
     *
     * @param array $message
     */
    public function init($message)
    {
        $this->setToUser(isset($message[Constants::CS_TO_USER_FIELD]) ? $message[Constants::CS_TO_USER_FIELD] : '');
    }
    
    public function toString()
    {
        $this->buildOptions();
        return $this->encode($this->getOptions());
    }
    
    public function encode($data)
    {
        if (!is_array($data)) {
            throw new \Exception('Error' . __METHOD__);
        }
        
        return json_encode($data);
    }
    
    public function send(){
        $this->setRawBody($this->toString());
        return parent::send();
    }
}
?>