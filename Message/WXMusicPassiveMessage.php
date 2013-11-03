<?php
class WXMusicPassiveMessage extends WXAbstractPassiveMessage
{
    protected $title;
    
    protected $description;
    
    protected $musicUrl;
    
    protected $HQMusicUrl;
    
    protected $thumbMediaId;
    
    public function __construct($message = null)
    {
        $this->init(parent::__construct($message));
    }
    
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }
    
    public function getTitle()
    {
        return $this->title;
    }
    
    public function setDescription($description)
    {
        $this->description = $description;
        
        return $this;
    }
    
    public function getDescription()
    {
        return $this->description;
    }
    
    public function setMusicUrl($musicUrl)
    {
        $this->musicUrl = $musicUrl;
    
        return $this;
    }
    
    public function getMusicUrl()
    {
        return $this->musicUrl;
    }
    
    public function setHQMusicUrl($HQMusicUrl)
    {
        $this->HQMusicUrl = $HQMusicUrl;
    }
    
    public function getHQMusicUrl()
    {
        return $this->HQMusicUrl;
    }
    
    public function setThumbMediaId($thumbMediaId)
    {
        $this->thumbMediaId = $thumbMediaId;
    }
    
    public function getThumbMediaId()
    {
        return $this->thumbMediaId;
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
        } else {
            $myXmlTpl = '<Music>
<Title><![CDATA[%s]]></Title>
<Description><![CDATA[%s]]></Description>
<MusicUrl><![CDATA[%s]]></MusicUrl>
<HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
<ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
</Music>';
            return sprintf($myXmlTpl, 
                    $this->getTitle(), 
                    $this->getDescription(),
                    $this->getMusicUrl(),
                    $this->getHQMusicUrl(),
                    $this->getThumbMediaId()
            );
        }
    }
}
?>