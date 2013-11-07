<?php
/**
 * 发送客服消息
 * @author huichaozh
 *
 */
require_once 'Basic/RawBodyRequest.php';
require_once 'AbstractCSMessageInterface.php';

abstract class AbstractCSMessage extends RawBodyRequest implements AbstractCSMessageInterface
{
    protected $apiOptions = array(
            'method' => 'POST',
            'url' => 'https://api.weixin.qq.com/cgi-bin/message/custom/send',
    );
    
    const TO_USER_FIELD_NAME = 'touser';
    const MESSAGE_TYPE_FIELD_NAME = 'msgtype';
    
    protected $fieldNames = array();
    
    protected $toUser;
    
    protected $messageType;
    
    protected $options = array();
    
    public function __construct($message, $accessToken = null)
    {
        $this->initFieldNames();
        parent::__construct($accessToken);
        if (is_array($message)) {
            $this->init($message);
        } elseif ($message !== null) {
            throw new Exception(sprintf(
                    'Expecting a string or array, received "%s"',
                    (is_object($message) ? get_class($message) : gettype($message))
            ));
        }
    
        return $message;
    }
    
    public function initFieldNames()
    {
        $this->fieldNames = array(self::TO_USER_FIELD_NAME, self::MESSAGE_TYPE_FIELD_NAME);
    }
    
    public function setOption($field, $value)
    {
        $this->checkFieldName($field);
        $this->options[$field] = $value;
    }
    
    public function getOptions()
    {
        return $this->options;
    }
    
    public function checkFieldName($field)
    {
        if (!in_array($field, $this->fieldNames)) {
            throw new Exception('Error:' . __METHOD__);
        }
    }
    
    public function setToUser($user)
    {
        $this->toUser = $user;
        $this->setOption(self::TO_USER_FIELD_NAME, $user);
    
        return $this;
    }
    
    public function getToUser()
    {
        return $this->toUser;
    }
    
    public function setMessageType($messageType)
    {
        $this->messageType = $messageType;
        $this->setOption(self::MESSAGE_TYPE_FIELD_NAME, $messageType);
    
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
        $this->setToUser($message[self::TO_USER_FIELD_NAME] ? $message[self::TO_USER_FIELD_NAME] : '');
    }
    
    public function toString()
    {
        return $this->encode($this->options);
    }
    
    public function encode($data)
    {
        if (!is_array($data)) {
            throw new Exception('Error' . __METHOD__);
        }
        
        return json_encode($data);
    }
    
    public function send(){
        $this->setRawBody($this->toString());
        return parent::send();
    }
}
?>