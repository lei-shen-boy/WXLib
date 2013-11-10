<?php
/**
 * 扫描带参数二维码事件
 * 用户扫描带场景值二维码时，可能推送以下两种事件：
如果用户还未关注公众号，则用户可以关注公众号，关注后微信会将带场景值关注事件推送给开发者。
如果用户已经关注公众号，则微信会将带场景值扫描事件推送给开发者。
 *
 */
namespace WXLib\Message\Event;
use WXLib\Constants;
class ScanQREventMessage extends AbstractEventMessage
{
    /**
     * 事件KEY值，与自定义菜单接口中KEY值对应
     */
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
        $this->setEventKey($message[Constants::EVENT_KEY_FIELD] ? $message[Constants::EVENT_KEY_FIELD] : '');
        $this->setTicket($message[Constants::TICKET_FIELD] ? $message[Constants::TICKET_FIELD] : '');
        $this->setEventToScan();
    }
    
    public function toString()
    {
        $xmlStringTpl = parent::toString();
        return sprintf($xmlStringTpl,
                "<EventKey><![CDATA[{$this->getEventKey()}]]></EventKey>
<Ticket><![CDATA[{$this->getTicket()}]]></Ticket>"
                        );
    }
}
?>