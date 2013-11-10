<?php
/**
 * 关注/取消关注事件
 */
namespace WXLib\Message\Event;

class UNSubEventMessage extends AbstractEventMessage
{
    public function init($message)
    {
        parent::init($message);
        $this->setEventToUNSub();
    }
    
    public function toString()
    {
        $xmlStringTpl = parent::toString();
        return sprintf($xmlStringTpl,
                ""
        );
    
    }
}
?>