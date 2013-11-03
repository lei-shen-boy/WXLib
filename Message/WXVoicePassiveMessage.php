<?php
class WXVoicePassiveMessage extends WXAbstractPassiveMessage
{
    protected $voiceFormat;
    
    protected $mediaId;
    
    public function __construct($message = null)
    {
        $this->init(parent::__construct($message));
    }
    
    public function setVoiceFormat($voiceFormat)
    {
        $this->voiceFormat = $voiceFormat;
        
        return $this;
    }
    
    public function getVoiceFormat()
    {
        return $this->voiceFormat;
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
        $this->setVoiceFormat($message['Format'] ? $message['Format'] : '');
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
            $myXmlTpl = '<MediaId><![CDATA[%s]]></MediaId>
<Format><![CDATA[%s]]></Format>';
            
            return sprintf($myXmlTpl, $this->getMediaId(), $this->getVoiceFormat());
        } else {
            $myXmlTpl = '<Voice>
<MediaId><![CDATA[%s]]></MediaId>
</Voice>';
            return sprintf($myXmlTpl, $this->getMediaId());
        }
    }
}
?>