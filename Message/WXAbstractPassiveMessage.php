<?php
abstract class WXAbstractPassiveMessage extends WXAbstractMessage
{
    protected $fromUser;
    
    protected $createTime;
    
    protected $messageId;
    
    protected $messageDirection;
    
    
    protected $xmlStringTpl = '<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[%s]]></MsgType>
%s
%s</xml>';
    
    public function __construct($message)
    {
        if (is_string($message)) {
            $message = $this->parseString($message);
        } elseif ($message !== null && !is_array($message)) {
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
            '%s', 
            $this->messageId ? '<MsgId>' . $this->messageId . '</MsgId>' : ''
        );
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
    
    public function setMessageId($messageId)
    {
        $this->messageId = $messageId;
        
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
    
    public function getMessageId()
    {
        return $this->messageId;
    }
    
    /**
     * 
     * @param array $message
     */
    public function init($message)
    {
        parent::setToUser($message['ToUserName'] ? $message['ToUserName'] : '');
        parent::setMessageType($message['MsgType'] ? $message['MsgType'] : '');
        $this->setFromUser($message['FromUserName'] ? $message['FromUserName'] : '');
        $this->setCreateTime($message['CreateTime'] ? $message['CreateTime'] : time());
        $this->setMessageId($message['MsgId'] ? $message['MsgId'] : '');
    }
    
    public function parseString($message)
    {
        return (array)simplexml_load_string($message, 'SimpleXMLElement', LIBXML_NOCDATA);
    }
}
?>