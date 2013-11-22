<?php
/**
 * 事件消息的简单工厂
 */
namespace WXLib\Message\Event;

use WXLib\Tool\DataParser;
use WXLib\Constants;

class EventMessageSimpleFactory
{
    public static function createMessage($message = null)
    {
        if (is_string($message)) {
            $messageArray = DataParser::parseXml($message);
        } elseif (is_array($message)) {
            $messageArray = $message;
        } elseif ($message !== null) {
            throw new \Exception(sprintf(
                    'Expecting a string or array, received "%s"',
                    (is_object($message) ? get_class($message) : gettype($message))
            ));
        }
        
        if (!isset($messageArray[Constants::MESSAGE_TYPE_FIELD])) {
            throw new \Exception('Please specify message type as a array element: $messageArray[\'MsgType\']');
        }
        
        /**
         * 对事件消息做判断
         * 事件消息实际也归属于普通消息，也是由微信服务器主动将微信用户的某种消息(这里就是事件)推送过来，但事件消息又具有特殊性，所以在系统设计上把时间消息提出来作为
         * 和普通消息，客服消息并列的一类消息
         */
        if ($messageArray[Constants::MESSAGE_TYPE_FIELD] !== Constants::EVENT_MESSAGGE_TYPE_NAME) {
            throw new \Exception('Please specify message type to ' . Constants::EVENT_MESSAGGE_TYPE_NAME);
        }
        
        if (!Constants::isEventTypeName($messageArray[Constants::EVENT_FIELD])) {
            throw new \Exception('Invalid message type: ' . $messageArray[Constants::MESSAGE_TYPE_FIELD]);
        }
        
        $eventType = $messageArray[Constants::EVENT_FIELD];
            $preix = '';
            switch ($eventType) {
            	case Constants::SUBSCRIBE_EVENT_TYPE_NAME:
            	    $preix = 'Sub';
            	    break;
            	case Constants::UNSUBSCRIBE_EVENT_TYPE_NAME:
            	    $preix = 'UNSub';
            	    break;
            	case Constants::MENU_EVENT_TYPE_NAME:
            	    $preix = 'Menu';
            	    break;
            	case Constants::SCAN_EVENT_TYPE_NAME:
            	    $preix = 'ScanQR';
            }
            $preix = $preix ? $preix : ucfirst(strtolower($eventType));
            $className = 'WXLib\\Message\\Event\\' . ucfirst(strtolower($preix)) . 'EventMessage';
      
        
        return new $className($messageArray);
    }
}
?>