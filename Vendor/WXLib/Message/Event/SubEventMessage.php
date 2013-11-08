<?php
/**
 * 关注/取消关注事件
 */
namespace WXLib\Message\Event;

class SubEventMessage extends AbstractEventMessage
{
    public function init($message)
    {
        parent::init($message);
        $this->setEventSub();
    }
}
?>