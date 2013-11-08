<?php
namespace WXLib\Message;

abstract class AbstractMessage
{
    protected $toUser;
    
    protected $fromUser;
    
    protected $messageType;
    
    protected $createTime;
    
    protected $xmlStringTpl = '<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[%s]]></MsgType>
%s
</xml>';
    
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
    
    public function setFromUser($user)
    {
        $this->fromUser = $user;
    
        return $this;
    }
    
    public function setCreateTime($time)
    {
        $this->createTime = $time;
    
        return $this;
    }
    
    public function getFromUser()
    {
        return $this->fromUser;
    }
    
    public function getCreateTime()
    {
        return $this->createTime;
    }
    
    
    public function __construct($message)
    {
        if (is_string($message)) {
            $message = $this->parseString($message);
            $this->init($message);
        } elseif (is_array($message)) {
            $this->init($message);
        } elseif ($message !== null) {
            throw new Exception(sprintf(
                    'Expecting a string or array, received "%s"',
                    (is_object($message) ? get_class($message) : gettype($message))
            ));
        }
    
        return $message;
    }
    
    public function toString()
    {
        return sprintf($this->xmlStringTpl, 
            $this->toUser, 
            $this->fromUser, 
            $this->createTime, 
            $this->messageType, 
            '%s'
        );
    }
    
    /**
     * 
     * @param array $message
     */
    public function init($message)
    {
        $this->setToUser($message['ToUserName'] ? $message['ToUserName'] : '');
        $this->setMessageType($message['MsgType'] ? $message['MsgType'] : '');
        $this->setFromUser($message['FromUserName'] ? $message['FromUserName'] : '');
        $this->setCreateTime($message['CreateTime'] ? $message['CreateTime'] : time());
    }
    
    public function parseString($message)
    {
        return (array)simplexml_load_string($message, 'SimpleXMLElement', LIBXML_NOCDATA);
    }
}
?>