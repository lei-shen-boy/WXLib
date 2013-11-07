<?php
/**
 * 发送语音客服消息
 * @author huichaozh
 *
 */
require_once 'AbstractMediaCSMessage.php';

class MusicCSMessage extends AbstractMediaCSMessage
{
    const MESSAGE_TYPE = 'music';
    const TITLE_FIELD_NAME = 'title';
    const DESCRIPTION_FIELD_NAME = 'description';
    const MUSIC_URL_FIELD_NAME = 'musicurl';
    const HQ_MUSIC_URL_FIELD_NAME ='hqmusicurl';
    const THUMB_MEDIA_ID_FIELD_NAME = 'thumb_media_id';
    
    
    protected $title;
    protected $description;
    protected $musicUrl;
    protected $HQMusicUrl;
    protected $thumbMediaId;
    
    public function __construct($message = null, $accessToken = null)
    {
        $this->setMessageType(self::MESSAGE_TYPE);
        parent::__construct($message = null, $accessToken = null);
        array_push($this->fieldNames, self::TITLE_FIELD_NAME, self::DESCRIPTION_FIELD_NAME, self::MUSIC_URL_FIELD_NAME, self::HQ_MUSIC_URL_FIELD_NAME, self::THUMB_MEDIA_ID_FIELD_NAME);
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
    
    public function setDetailOptions()
    {
        $this->setOption($this->getMessageType(), array(
                self::TITLE_FIELD_NAME => $this->getTitle(),
                self::DESCRIPTION_FIELD_NAME => $this->getDescription(),
                self::MUSIC_URL_FIELD_NAME => $this->getMusicUrl(),
                self::HQ_MUSIC_URL_FIELD_NAME => $this->getHQMusicUrl(),
                self::THUMB_MEDIA_ID_FIELD_NAME => $this->getThumbMediaId()
        ));
    }
}
?>