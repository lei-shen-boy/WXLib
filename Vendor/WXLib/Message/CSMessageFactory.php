<?php
/**
 * 客服消息的简单工厂
 */
namespace WXLib\Message\CustomerService;

use WXLib\Tool\DataParser;
use WXLib\Constants;
use WXLib\Message\AbstractMessageFactory;

class CSMessageFactory extends AbstractMessageFactory
{
    public static function checkMessage($message = null)
    {
        $messageArray = parent::checkMessage($message);
        if (!isset($messageArray[Constants::CS_MESSAGE_TYPE_FIELD])) {
            throw new \Exception('Please specify message type as a array element: $messageArray[\'MsgType\']');
        }
        if (!Constants::isCSMessageTypeName($messageArray[Constants::CS_MESSAGE_TYPE_FIELD])) {
            throw new \Exception('Invalid message type: ' . $messageArray['MsgType']);
        }
    }
    
    public static function createMessage($message = null)
    {
        $messageArray = self::checkMessage($message);
        $className = 'WXLib\\Message\\CS\\' . ucfirst(strtolower($messageArray[Constants::CS_MESSAGE_TYPE_FIELD])) . 'CSMessage';
        
        return new $className($messageArray);
    }
}
?>