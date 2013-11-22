<?php
/**
 * 工厂方法的消息基类
 */
namespace WXLib\Message;

use WXLib\Message\Common\CommonMessageSimpleFactory;
use WXLib\Message\CustomerService\CSMessageSimpleFactory;
use WXLib\Message\Event\EventMessageSimpleFactory;
use WXLib\Tool\DataParser;
use WXLib\Constants;

abstract class AbstractMessageFactory
{
    abstract public static function createMessage($message = null)
    {
    }
    
    public static function checkMessage($message = null)
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
        
        return $messageArray;
    }
}
?>