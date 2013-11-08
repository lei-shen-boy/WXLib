<?php
/**
 * 扫描带参数二维码事件
 *
 */
class ScanQREventMessage extends AbstractEventMessage
{
    /**
     * 事件KEY值，与自定义菜单接口中KEY值对应
     */
    protected $eventKey;
    
    public function setEventKey($eventKey)
    {
        $this->eventKey = $eventKey;
        
        return $this;
    }
    
    public function getEventKey()
    {
        return $this->eventKey;
    }
    
    public function init($message)
    {
        parent::init($message);
        $this->setTitle($message['EventKey'] ? $message['EventKey'] : '');
    }
}
?>