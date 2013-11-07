<?php
/**
 * 发送客服消息
 * @author huichaozh
 *
 */
require_once 'AbstractCSMessage.php';

class ImageCSMessage extends AbstractCSMessage
{
    const MEDIA_ID_FIELD_NAME = 'media_id';
    
    protected $mediaId;
    
    public function __construct($message = null)
    {
        parent::__construct($message);
    }
    
    public function initFieldNames()
    {
        parent::initFieldNames();
        array_push($this->fieldNames, self::CONTENT_FIELD_NAME);
    }
    
    public function setMediaId($mediaId)
    {
        $this->mediaId = $mediaId;
        $this->setOption(self::MESSAGE_TYPE_FIELD_NAME, array(self::CONTENT_FIELD_NAME => $content));
        
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
        $this->setMessageType(self::MESSAGE_TYPE);
        $this->setContent($message['Content'] ? $message['Content'] : '');
    }
}
?>