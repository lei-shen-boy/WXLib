<?php 
/**
 * 对接收微信服务器的通知消息，对发送响应消息，进行装饰器模式封装，提供统一的对外方法
 */
namespace WXLib\Message;

use WXLib\Constants;
use WXLib\Tool\DataParser;
use WXLib\Message\Common\TextCommonMessage;
use WXLib\Message\Common\ImageCommonMessage;
use WXLib\Message\Common\MusicCommonMessage;
use WXLib\Message\Common\VideoCommonMessage;
use WXLib\Message\Common\VoiceCommonMessage;
use WXLib\Message\Common\LinkCommonMessage;
use WXLib\Message\Common\LocationCommonMessage;
use WXLib\Message\Common\NewsCommonMessage;
use WXLib\Message\Event\SubEventMessage;
use WXLib\Message\Event\UNSubEventMessage;
use WXLib\Message\Event\ScanQREventMessage;
use WXLib\Message\Event\MenuEventMessage;
use WXLib\Message\Event\LocationEventMessage;

class Message extends Constants
{
    protected $instance;
    
    public function __construct($message) 
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
        
        $messageType = $messageArray['MsgType'];
        if (!Constants::isMessageTypeName($messageType)) {
            throw new \Exception('Invalid message type: ' . $messageType);
        }
        
        $this->setInstance($messageType, $messageArray);
    }
    
    public function setInstance($messageType, $messageArray = null)
    {
        if ($messageType == Constants::EVENT_MESSAGGE_TYPE_NAME) {
            $eventType = $messageArray['Event'];
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
        } else {
            $className = 'WXLib\\Message\\Common\\' . ucfirst(strtolower($messageType)) . 'CommonMessage';
        }
        
        $this->instance = new $className($messageArray);
    }
    
    public function setContent($content) {$this->instance->setContent($content); return $this;}
    public function getContent() {return $this->instance->getContent();}
    public function init($message) {$this->instance->init($message); return $this;}
    public function toString() {return $this->instance->toString();}
    public function setMessageId($messageId) {$this->instance->setMessageId($messageId); return $this;}
    public function getMessageId() {return $this->instance->getMessageId();}
    public function setToUser($user) {$this->instance->setToUser($user); return $this;}
    public function getToUser() {return $this->instance->getToUser();}
    public function setMessageType($messageType) {$this->instance->setMessageType($messageType); return $this;}
    public function getMessageType() {return $this->instance->getMessageType();}
    public function setFromUser($user) {$this->instance->setFromUser($user); return $this;}
    public function setCreateTime($time) {$this->instance->setCreateTime($time); return $this;}
    public function getFromUser() {return $this->instance->getFromUser();}
    public function getCreateTime() {return $this->instance->getCreateTime();}
    public function parseString($message) {$this->instance->parseString($message); return $this;}
    public function setPicUrl($picUrl) {$this->instance->setPicUrl($picUrl); return $this;}
    public function getPicUrl() {return $this->instance->getPicUrl();}
    public function setMediaId($mediaId) {$this->instance->setMediaId($mediaId); return $this;}
    public function getMediaId() {return $this->instance->getMediaId();}
    public function setVoiceFormat($voiceFormat) {$this->instance->setVoiceFormat($voiceFormat); return $this;}
    public function getVoiceFormat() {return $this->instance->getVoiceFormat();}
    public function setRecognition($recognition) {$this->instance->setRecognition($recognition); return $this;}
    public function getRecognition() {return $this->instance->getRecognition();}
    public function setThumbMediaId($thumbMediaId) {$this->instance->setThumbMediaId($thumbMediaId); return $this;}
    public function getThumbMediaId() {return $this->instance->getThumbMediaId();}
    public function setTitle($title) {$this->instance->setTitle($title); return $this;}
    public function getTitle() {return $this->instance->getTitle();}
    public function setDescription($description) {$this->instance->setDescription($description); return $this;}
    public function getDescription() {return $this->instance->getDescription();}
    public function setMusicUrl($musicUrl) {$this->instance->setMusicUrl($musicUrl); return $this;}
    public function getMusicUrl() {return $this->instance->getMusicUrl();}
    public function setHQMusicUrl($HQMusicUrl) {$this->instance->setHQMusicUrl($HQMusicUrl); return $this;}
    public function getHQMusicUrl() {return $this->instance->getHQMusicUrl();}
    public function addArticle($article) {$this->instance->addArticle($article); return $this;}
    public function setEventKey($eventKey) {$this->instance->setEventKey($eventKey); return $this;}
    public function getEventKey() {return $this->instance->getEventKey();}
    public function setEventSub() {$this->instance->setEventSub(); return $this;}
    public function setEventUnsub() {$this->instance->setEventUnsub(); return $this;}
    public function setEventScan() {$this->instance->setEventScan(); return $this;}
    public function setEventLocation() {$this->instance->setEventLocation(); return $this;}
    public function setEventMenu() {$this->instance->setEventMenu(); return $this;}
    public function setEvent($event) {$this->instance->setEvent($event); return $this;}
    public function getEvent() {return $this->instance->getEvent();}
}
?>