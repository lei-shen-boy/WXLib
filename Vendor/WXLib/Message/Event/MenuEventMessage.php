<?php
/**
 *用户点击自定义菜单后，如果菜单按钮设置为click类型，则微信会把此次点击事件推送给开发者，
 *注意view类型（跳转到URL）的菜单点击不会上报。
 *
 */
namespace WXLib\Message\Event;
use WXLib\Constants;
class MenuEventMessage extends AbstractEventMessage
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
        $this->setEventKey(isset($message[Constants::EVENT_KEY_FIELD]) ? $message[Constants::EVENT_KEY_FIELD] : '');
        $this->setEventToMenu();
    }
    
    public function toString()
    {
        $xmlStringTpl = parent::toString();
        return sprintf($xmlStringTpl,
                "
<EventKey><![CDATA[{$this->getEventKey()}]]></EventKey>"
                                );
    }
}
?>