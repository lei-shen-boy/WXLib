<?php
/**
 * 接收语音消息|回复语音消息
 */
require_once '../../Message/Common/AbstractCommonMessage.php';

class VoiceCommonMessage extends AbstractCommonMessage
{
    protected $voiceFormat;
    
    protected $mediaId;
    
    /**
     * 开通语音识别功能，用户每次发送语音给公众号时，微信会在推送的语音消息XML数据包中，增加一个Recongnition字段
     */
    protected $recognition;
    
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
    
    public function setRecognition($recognition)
    {
        $this->recognition = $recognition;
    }
    
    public function getRecognition()
    {
        return $this->recognition;
    }
    
    public function init($message)
    {
        parent::init($message);
        $this->setVoiceFormat($message['Format'] ? $message['Format'] : '');
        $this->setMediaId($message['MediaId'] ? $message['MediaId'] : '');
        $this->setRecognition($message['Recognition'] ? $message['Recognition'] : '');
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