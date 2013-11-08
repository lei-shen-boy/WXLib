<?php
/**
 * 扫描带参数二维码事件
 * 用户扫描带场景值二维码时，可能推送以下两种事件：
如果用户还未关注公众号，则用户可以关注公众号，关注后微信会将带场景值关注事件推送给开发者。
如果用户已经关注公众号，则微信会将带场景值扫描事件推送给开发者。
 *
 */
namespace WXLib\Message\Event;
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
        $this->setEventKey($message['EventKey'] ? $message['EventKey'] : '');
        $this->setTicket($message['Ticket'] ? $message['Ticket'] : '');
        $this->setEventScan();
    }
    
    /**
     * 新用户：如果用户还未关注公众号，则用户可以关注公众号，关注后微信会将带场景值关注事件推送给开发者
     * 老用户：如果用户已经关注公众号，则微信会将带场景值扫描事件推送给开发者
     * @throws \Exception
     * @return boolean
     */
    public function isNewUser()
    {
        if (!$this->getEventKey()) {
            throw new \Exception('Error: EventKey is invalid, ' . __METHOD__);
        }
        if (0 === strpos($this->getEventKey(), 'qrscene_')) {
            return true;
        }
        return false;
    }
}
?>