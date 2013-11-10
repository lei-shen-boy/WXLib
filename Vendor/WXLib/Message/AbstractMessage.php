<?php
namespace WXLib\Message;

use WXLib\Constants;
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
            throw new \Exception(sprintf(
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
        $this->setToUser(isset($message[Constants::TO_USER_NAME_FIELD]) ? $message[Constants::TO_USER_NAME_FIELD] : '');
        $this->setMessageType(isset($message[Constants::MESSAGE_TYPE_FIELD]) ? $message[Constants::MESSAGE_TYPE_FIELD] : '');
        $this->setFromUser(isset($message[Constants::FROM_USER_NAME_FIELD]) ? $message[Constants::FROM_USER_NAME_FIELD] : '');
        $this->setCreateTime(isset($message[Constants::CREATE_TIME_FIELD]) ? $message[Constants::CREATE_TIME_FIELD] : time());
    }
    
    public function parseString($message)
    {
        return (array)simplexml_load_string($message, 'SimpleXMLElement', LIBXML_NOCDATA);
    }
    
    /**
     * 是否是文本消息
     * @return boolean
     */
    public function isText()
    {
        return $this->getMessageType() == Constants::TEXT_MESSAGE_TYPE_NAME ? true : false;
    } 
    
    /**
     * 是否是图片消息
     * @return boolean
     */
    public function isImage()
    {
        return $this->getMessageType() == Constants::IMAGE_MESSAGE_TYPE_NAME ? true : false;
    }
    
    /**
     * 是否是语音消息
     * @return boolean
     */
    public function isVoice()
    {
        return $this->getMessageType() == Constants::VOICE_MESSAGGE_TYPE_NAME ? true : false;
    }
    
    /**
     * 是否是视频消息
     * @return boolean
     */
    public function isVideo()
    {
        return $this->getMessageType() == Constants::VIDEO_MESSAGGE_TYPE_NAME ? true : false;
    }
    
    /**
     * 是否是事件消息
     * @return boolean
     */
    public function isEvent()
    {
        return $this->getMessageType() == Constants::EVENT_MESSAGGE_TYPE_NAME ? true : false;
    }
    
    /**
     * 设置为文本消息
     * @return boolean
     */
    public function setToText()
    {
        $this->messageType = Constants::TEXT_MESSAGE_TYPE_NAME;
        
        return $this;
    }
    
    /**
     * 设置为图片消息
     * @return boolean
     */
    public function setToImage()
    {
        $this->messageType = Constants::IMAGE_MESSAGE_TYPE_NAME;
        
        return $this;
    }
    
    /**
     * 设置为语音消息
     * @return boolean
     */
    public function setToVoice()
    {
        $this->messageType = Constants::VOICE_MESSAGGE_TYPE_NAME;
        
        return $this;
    }
    
    /**
     * 设置为视频消息
     * @return boolean
     */
    public function setToVideo()
    {
        $this->messageType = Constants::VIDEO_MESSAGGE_TYPE_NAME;
        
        return $this;
    }
    
    /**
     * 设置为事件消息
     * @return boolean
     */
    public function setToEvent()
    {
        $this->messageType = Constants::EVENT_MESSAGGE_TYPE_NAME;
        
        return $this;
    }
}
?>