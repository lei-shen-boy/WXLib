<?php
/**
 * 发送视频客服消息
 * @author huichaozh
 *
 */
namespace WXLib\Message\CustomerService;

class VideoCSMessage extends AbstractMediaCSMessage
{
    const MESSAGE_TYPE = 'video';
    const THUMB_MEDIA_ID_FIELD_NAME = 'thumb_media_id';
    
    protected $thumbMediaId;
    
    public function __construct($message = null, $accessToken = null)
    {
        $this->setMessageType(self::MESSAGE_TYPE);
        parent::__construct($message, $accessToken);
        array_push($this->fieldNames, self::THUMB_MEDIA_ID_FIELD_NAME);
    }
    
    public function setThumbMediaId($thumbMediaId)
    {
        $this->thumbMediaId = $thumbMediaId;
        
        return $this;
    }
    
    public function getThumbMediaId()
    {
        return $this->thumbMediaId;
    }
    
    public function setDetailOptions()
    {
        $this->setOption($this->getMessageType(), array(
                self::MEDIA_ID_FIELD_NAME => $this->getMediaId(),
                self::THUMB_MEDIA_ID_FIELD_NAME => $this->getThumbMediaId()
        ));
    }
}
?>
