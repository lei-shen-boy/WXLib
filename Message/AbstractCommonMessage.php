<?php
/**
 * 接收到的普通消息|发送的被动响应消息
 * @author Gavin
 *
 */
require_once 'AbstractMessage.php';

class AbstractCommonMessage extends AbstractMessage
{
    protected $messageId;
    
    public function setMessageId($messageId)
    {
        $this->messageId = $messageId;
    
        return $this;
    }
    
    public function getMessageId()
    {
        return $this->messageId;
    }
    
    public function init($message)
    {
        parent::init($message);
        $this->messageId = isset($message['MsgId']) ? $message['MsgId'] : '';
    }
    
    public function toString()
    {
        $xmlStringTpl = parent::toString();
        return sprintf($xmlStringTpl,
                '%s' . ($this->getMessageId() ? "<MsgId>{$this->getMessageId()}</MsgId>" : '')
        ); 
    }
}
?>