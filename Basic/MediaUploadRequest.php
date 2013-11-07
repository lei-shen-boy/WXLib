<?php
require_once 'Request.php';
/**
 * 上传多媒体文件
 * 上传的多媒体文件有格式和大小限制，如下：
图片（image）: 256K，支持JPG格式
语音（voice）：256K，播放长度不超过60s，支持AMR与MP3格式
视频（video）：2MB，支持MP4格式
缩略图（thumb）：64KB，支持JPG格式
 */
class MediaUploadRequest extends Request
{
    /**
     * Internal options array
     */
    protected $apiOptions = array(
            'method' => HTTP_Request2::METHOD_POST,
            'url' => 'http://file.api.weixin.qq.com/cgi-bin/media/upload',
    );
    
    protected $type;
    
    protected $media;
    
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }
    
    public function getType()
    {
        return $this->type;
    }
    
    public function setMedia($media)
    {
        $this->media = $media;
    
        return $this;
    }
    
    public function getMedia()
    {
        return $this->media;
    }
    
    
    public function __construct($type, $media, $accessToken = null)
    {
        parent::__construct($accessToken);
        $this->setType($type);
        $this->setMedia($media);
        $this->request->addPostParameter('type', $this->getType());
        $this->request->addUpload('media', $media);
    }
    
    /**
     * 上传多媒体文件
     * 上传的多媒体文件有格式和大小限制，如下：
图片（image）: 256K，支持JPG格式
语音（voice）：256K，播放长度不超过60s，支持AMR与MP3格式
视频（video）：2MB，支持MP4格式
缩略图（thumb）：64KB，支持JPG格式
     *
     *@return array(3) {
  ["type"]=>
  string(5) "image"
  ["media_id"]=>
  string(64) "kNZbH3impdT-rUeXh5hWzmY6KyOjGdNxOubtuSEZCHtHLbDfuOKTCk7mrvg1FM-U"
  ["created_at"]=>
  int(1383754449)
}
     */
    public function upload()
    {
        return $this->send();
    }
    
}
?>