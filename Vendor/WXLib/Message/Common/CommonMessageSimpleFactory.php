<?php
/**
 * 普通消息的简单工厂
 */
namespace WXLib\Message\Common;

use WXLib\Tool\DataParser;
use WXLib\Constants;

class CommonMessageSimpleFactory
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
        
        if (!isset($messageArray['MsgType'])) {
            throw new \Exception('Please specify message type as a array element: $messageArray[\'MsgType\']');
        }
        if (!Constants::isMessageTypeName($messageArray['MsgType'])) {
            throw new \Exception('Invalid message type: ' . $messageArray['MsgType']);
        }
        
        $messageType = $messageArray['MsgType'];
        $className = 'WXLib\\Message\\Common\\' . ucfirst(strtolower($messageType)) . 'CommonMessage';
        
        return new $className($messageArray);
    }
}
?>