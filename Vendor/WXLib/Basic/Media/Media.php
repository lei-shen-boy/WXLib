<?php
namespace WXLib\Basic\Media;

class Media
{
    /**
     * 媒体文件在微信后台保存时间为3天，即3天后media_id失效
     */
    const EXPIRES_IN = 259200;
    
    protected $type;
    
    protected $mediaId;

    protected $updatedTime;
    
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }
    
    public function getType()
    {
        return $this->type;
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
    
    public function setUpdatedTime($updatedTime)
    {
        $this->updatedTime = $updatedTime;
    
        return $this;
    }
    
    public function getUpdatedTime()
    {
        return $this->updatedTime;
    }
    
    public function getFromRequest()
    {
    }
    
    public function getFromLocal()
    {
    }
    
    public function updateLocal()
    {
    }
    
    public function get()
    {
    }
}
?>