<?php 
require_once '../Vendor/autoload.php';
use WXLib\Message\Common\CommonMessageDelegator;
use WXLib\Constants;
use WXLib\Tool\DecoratorCreater;
use WXLib\Message\Message;

$message = '<xml>
 <ToUserName><![CDATA[toUser]]></ToUserName>
 <FromUserName><![CDATA[fromUser]]></FromUserName>
 <CreateTime>1348831860</CreateTime>
 <MsgType><![CDATA[text]]></MsgType>
 <Content><![CDATA[this is a test]]></Content>
 <MsgId>1234567890123456</MsgId>
 </xml>';

$m = new Message($message);
var_dump($m->getToUser());
var_dump($m->getMessageType());
var_dump($m);

exit;

$classes = array();
foreach (Constants::$messageTypeNames as $type) {
    if ($type == Constants::EVENT_MESSAGGE_TYPE_NAME) {
        foreach (Constants::$eventTypeNames as $eventType) {
            $preix = null;
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
        }
        array_push($classes, 'WXLib\\Message\\Event\\' . ucfirst(strtolower($preix)) . 'EventMessage');
    } else {
        array_push($classes, 'WXLib\\Message\\Common\\' . ucfirst(strtolower($type)) . 'CommonMessage');
    }
}

$d = new DecoratorCreater();
$d->addClasses($classes);
var_dump($d->create());
exit;



?>