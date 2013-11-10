<?php
/**
 * 接收到的事件消息
 */
namespace WXLib\Message\Event;
use WXLib\Message\AbstractMessage;
use WXLib\Constants;

class AbstractEventMessage extends AbstractMessage
{
    /**
     * 事件类型
     */
    protected $event;
    
    /**
     * 是否是关注事件
     * @return boolean
     */
    public function isSubEvent()
    {
        return $this->getEvent() == Constants::SUBSCRIBE_EVENT_TYPE_NAME ? true : false;
    }
    
    /**
     * 是否是取消关注事件
     * @return boolean
     */
    public function isUnSubEvent()
    {
        return $this->getEvent() == Constants::UNSUBSCRIBE_EVENT_TYPE_NAME ? true : false;
    }
    
    /**
     * 是否是扫描事件
     * @return boolean
     */
    public function isScanEvent()
    {
        return $this->getEvent() == Constants::SCAN_EVENT_TYPE_NAME ? true : false;
    }
    
    /**
     * 是否是位置事件
     * @return boolean
     */
    public function isLocationEvent()
    {
        return $this->getEvent() == Constants::LOCATION_EVENT_TYPE_NAME ? true : false;
    }
    
    /**
     * 是否是点击菜单事件
     * @return boolean
     */
    public function isMenuEvent()
    {
        return $this->getEvent() == Constants::MENU_EVENT_TYPE_NAME ? true : false;
    }
    
    public function setEventToSub()
    {
        $this->setEvent(Constants::SUBSCRIBE_EVENT_TYPE_NAME);
    }
    
    public function setEventToUnsub()
    {
        $this->setEvent(Constants::UNSUBSCRIBE_EVENT_TYPE_NAME);
    }
    
    public function setEventToScan()
    {
        $this->setEvent(Constants::SCAN_EVENT_TYPE_NAME);
    }
    
    public function setEventToLocation()
    {
        $this->setEvent(Constants::LOCATION_EVENT_TYPE_NAME);
    }
    
    public function setEventToMenu()
    {
        $this->setEvent(Constants::MENU_EVENT_TYPE_NAME);
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
        $this->event = isset($message[Constants::EVENT_FIELD]) ? $message[Constants::EVENT_FIELD] : '';
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