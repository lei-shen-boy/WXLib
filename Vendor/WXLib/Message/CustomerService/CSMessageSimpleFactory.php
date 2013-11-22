<?php
/**
 * 客服消息的简单工厂
 */
namespace WXLib\Message\CustomerService;

use WXLib\Tool\DataParser;
use WXLib\Constants;

class CSMessageSimpleFactory
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
        if (!Constants::isCSMessageTypeName($messageArray['MsgType'])) {
            throw new \Exception('Invalid message type: ' . $messageArray['MsgType']);
        }
        
        $messageType = $messageArray['MsgType'];
        $className = 'WXLib\\Message\\CS\\' . ucfirst(strtolower($messageType)) . 'CSMessage';
        
        return new $className($messageArray);
    }
}
?>