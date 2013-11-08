<?php
/**
 * 接收到的事件消息
 */
require_once '../../Message/AbstractMessage.php';

class AbstractEventMessage extends AbstractMessage
{
    const EVENT_SUBSCRIBE = 'subscribe';
    const EVENT_UNSUBSCRIBE = 'unsubscribe';
    const EVENT_SCAN = 'scan';
    const EVENT_LOCATION = 'LOCATION';
    const EVENT_CLICK = 'CLICK';
    
    /**
     * 事件类型
     */
    protected $event;
    
    public function setEvent($event)
    {
        $this->event = $event;
        
        return $this;
    }
    
    public function getEvent()
    {
        return $this->event;
    }
    
    public function init($message)
    {
        parent::init($message);
        $this->event = isset($message['Event']) ? $message['Event'] : '';
    }
}
?>