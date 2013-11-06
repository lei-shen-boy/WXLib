<?php
require_once 'MediaRequest.php';
/**
 * 上传多媒体文件
 * 上传的多媒体文件有格式和大小限制，如下：
图片（image）: 256K，支持JPG格式
语音（voice）：256K，播放长度不超过60s，支持AMR与MP3格式
视频（video）：2MB，支持MP4格式
缩略图（thumb）：64KB，支持JPG格式
 */
class MediaDownLoadRequest extends MediaRequest
{
    /**
     * Internal options array
     */
    protected $apiOptions = array(
            'method' => HTTP_Request2::METHOD_GET,
            'url' => 'http://file.api.weixin.qq.com/cgi-bin/media/get',
    );
    
    protected $mediaId;
    
    public function setMediaId($mediaId)
    {
        $this->mediaId = $mediaId;
    
        return $this;
    }
    
    public function getMediaId()
    {
        return $this->mediaId;
    }
    
    
    public function __construct($mediaId, $accessToken = null)
    {
        parent::__construct($accessToken);
        $this->setMediaId($mediaId);
        $this->request->getUrl()->setQueryVariable('media_id', $this->getMediaId());
    }
    
    public function getAddress()
    {
        return $this->request->getUrl()->getURL();
    }
    
    public function download($destination)
    {
        $address = $this->getAddress();
        return file_put_contents($destination, file_get_contents($this->getAddress()));
    }
    
}
?>