<?php
/**
 * 接收图片消息|回复图片消息
 */
namespace WXLib\Message\Common;

class ImageCommonMessage extends AbstractCommonMessage
{
    protected $picUrl;
    
    protected $mediaId;
    
    public function setPicUrl($picUrl)
    {
        $this->picUrl = $picUrl;
        
        return $this;
    }
    
    public function getPicUrl()
    {
        return $this->picUrl;
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
        $this->setPicUrl($message['PicUrl'] ? $message['PicUrl'] : '');
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
            $myXmlTpl = '<PicUrl><![CDATA[%s]]></PicUrl>
 <MediaId><![CDATA[%s]]></MediaId>';
            
            return sprintf($myXmlTpl, $this->getPicUrl(), $this->getMediaId());
        } else {
            $myXmlTpl = '<Image>
<MediaId><![CDATA[%s]]></MediaId>
</Image>';
            return sprintf($myXmlTpl, $this->getMediaId());
        }
    }
}
?>