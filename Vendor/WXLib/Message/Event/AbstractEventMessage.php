<?php
/**
 * 接收到的事件消息
 */
namespace WXLib\Message\Event;
use WXLib\Message\AbstractMessage;

class AbstractEventMessage extends AbstractMessage
{
    const EVENT_SUBSCRIBE_NAME = 'subscribe';
    const EVENT_UNSUBSCRIBE_NAME = 'unsubscribe';
    const EVENT_SCAN_NAME = 'scan';
    const EVENT_LOCATION_NAME = 'LOCATION';
    const EVENT_MENU_NAME = 'CLICK';
    
    /**
     * 事件类型
     */
    protected $event;
    
    public function setEventSub()
    {
        $this->setEvent(self::EVENT_SUBSCRIBE_NAME);
    }
    
    public function setEventUnsub()
    {
        $this->setEvent(self::EVENT_UNSUBSCRIBE_NAME);
    }
    
    public function setEventScan()
    {
        $this->setEvent(self::EVENT_SCAN_NAME);
    }
    
    public function setEventLocation()
    {
        $this->setEvent(self::EVENT_LOCATION_NAME);
    }
    
    public function setEventMenu()
    {
        $this->setEvent(self::EVENT_MENU_NAME);
    }
    
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
    
    public function toString()
    {
        $xmlStringTpl = parent::toString();
        return sprintf($xmlStringTpl,
                "<Event><![CDATA[{$this->getEvent()}]]></Event>" . '%s'
        );
    }
}
?>