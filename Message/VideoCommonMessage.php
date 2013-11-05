<?php
/**
 * 接收视频消息|回复视频消息
 */
require_once 'AbstractCommonMessage.php';

class VideoCommonMessage extends AbstractCommonMessage
{
    protected $mediaId;
    
    protected $thumbMediaId;
    
    public function setThumbMediaId($thumbMediaId)
    {
        $this->thumbMediaId = $thumbMediaId;
        
        return $this;
    }
    
    public function getThumbMediaId()
    {
        return $this->thumbMediaId;
    }
    
    public function setMediaId($mediaId)
    {
        $this->mediaId = $mediaId;
    }
    
    public function getMediaId()
    {
        return $this->mediaId;
    }
    
    public function init($message)
    {
        parent::init($message);
        $this->setThumbMediaId($message['ThumbMediaId'] ? $message['ThumbMediaId'] : '');
        $this->setMediaId($message['MediaId'] ? $message['MediaId'] : '');
    }
    
    public function toString()
    {
        $tpl = parent::toString();
        return sprintf($tpl, $this->getMyXmlPart());
    }
    
    protected function getMyXmlPart()
    {
        if ($this->getMessageId()) {
            $myXmlTpl = '<MediaId><![CDATA[media_id]]></MediaId>
<ThumbMediaId><![CDATA[%s]]></ThumbMediaId>';
            
            return sprintf($myXmlTpl, $this->getMediaId(), $this->thumbMediaId());
        } else {
            $myXmlTpl = '<Video>
<MediaId><![CDATA[%s]]></MediaId>
<ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
</Video> ';
            return sprintf($myXmlTpl, $this->thumbMediaId());
        }
    }
}
?>