<?php
/**
 * 关注/取消关注事件
 */
namespace WXLib\Message\Event;
use WXLib\Constants;

class SubEventMessage extends AbstractEventMessage
{
    protected $eventKey;
    
    protected $ticket;
    
    public function setEventKey($eventKey)
    {
        $this->eventKey = $eventKey;
    
        return $this;
    }
    
    public function getEventKey()
    {
        return $this->eventKey;
    }
    
    public function setTicket($ticket)
    {
        $this->ticket = $ticket;
    }
    
    public function getTicket()
    {
        return $this->ticket;
    }
    
    public function init($message)
    {
        parent::init($message);
        $this->setEventToSub();
        $this->setEventKey(isset($message[Constants::EVENT_KEY_FIELD]) ? $message[Constants::EVENT_KEY_FIELD] : '');
        $this->setTicket(isset($message[Constants::TICKET_FIELD]) ? $message[Constants::TICKET_FIELD] : '');
    }
    
    public function toString()
    {
        $xmlStringTpl = parent::toString();
        if ($this->isScanSubEvent()) {
            return sprintf($xmlStringTpl,
                    "
<EventKey><![CDATA[{$this->getEventKey()}]]></EventKey>
<Ticket><![CDATA[{$this->getTicket()}]]></Ticket>"                    
            );
        } else {
            return sprintf($xmlStringTpl,
                    ""
            );
        }
        
        }
    
    /**
     * 是否是扫描后关注事件
     * 新用户：如果用户还未关注公众号，则用户可以关注公众号，关注后微信会将带场景值关注事件推送给开发者
     * @throws \Exception
     * @return boolean
     */
    public function isScanSubEvent()
    {
        if (0 === strpos($this->getEventKey(), Constants::SCAN_SUB_EVENT_KEY_VALUE_REFIX)) {
            return true;
        }
        return false;
    }
}
?>