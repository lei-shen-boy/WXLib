<?php
/**
 * 发送图片|语音|视频客服消息的抽象类
 * @author huichaozh
 *
 */
namespace WXLib\Message\CustomerService;

abstract class AbstractMediaCSMessage extends AbstractCSMessage
{
    const MEDIA_ID_FIELD_NAME = 'media_id';
    
    protected $mediaId;
    
    public function initFieldNames()
    {
        parent::initFieldNames();
        array_push($this->fieldNames, self::MEDIA_ID_FIELD_NAME, $this->getMessageType());
    }
    
    public function setMediaId($mediaId)
    {
        $this->mediaId = $mediaId;
        
        return $this;
    }
    
    public function getMediaId()
    {
        return $this->mediaId;
    }
    
    /**
     *
     * @param array $message
     */
    public function init($message)
    {
        parent::init($message);
        $this->setMessageType($this->getMessageType());
        $this->setMediaId($message['MediaId'] ? $message['MediaId'] : '');
    }
}
?>