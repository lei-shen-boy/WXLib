<?php
/**
 * 发送图片客服消息
 * @author huichaozh
 *
 */
namespace WXLib\Message\CustomerService;

class VoiceCSMessage extends AbstractMediaCSMessage
{
    const MESSAGE_TYPE = 'voice';
    
    public function __construct($message = null, $accessToken = null)
    {
        $this->setMessageType(self::MESSAGE_TYPE);
        parent::__construct($message = null, $accessToken = null);
    }
    
    public function setDetailOptions()
    {
        $this->setOption($this->getMessageType(), array(self::MEDIA_ID_FIELD_NAME => $this->getMediaId()));
    }
}
?>