<?php
/**
 * 普通消息的简单工厂
 */
namespace WXLib\Message\Common;

use WXLib\Tool\DataParser;
use WXLib\Constants;
use WXLib\Message\AbstractMessageFactory;

class CommonMessageFactory extends AbstractMessageFactory
{
    public static function checkMessage($message)
    {
        $messageArray = parent::checkMessage($message);
        if (!isset($messageArray[Constants::MESSAGE_TYPE_FIELD])) {
            throw new \Exception('Please specify message type as a array element: $messageArray[\'MsgType\']');
        }
        if (!Constants::isMessageTypeName($messageArray[Constants::MESSAGE_TYPE_FIELD])) {
            throw new \Exception('Invalid message type: ' . $messageArray[Constants::MESSAGE_TYPE_FIELD]);
        }
        
        return $messageArray;
    }
    
    public static function createMessage($message = null)
    {
        $messageArray = self::checkMessage($message);
        $className = 'WXLib\\Message\\Common\\' . ucfirst(strtolower($messageArray[Constants::MESSAGE_TYPE_FIELD])) . 'CommonMessage';
        
        return new $className($messageArray);
    }
}
?>