<?php 
/**
 * 对接收微信服务器的通知消息，对发送响应消息，进行封装，提供统一的对外方法
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
    
    protected $options = array();
    
    public function __construct($message = null) 
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
        
        if (isset($messageArray) && is_array($messageArray)) {
            $this->setInstance($messageArray);
        }
    }
    
    public function setInstance($messageArray = null)
    {
        if (!isset($messageArray['MsgType'])) {
            throw new \Exception('Please specify message type as a array element: $messageArray[\'MsgType\']');
        }
        if (!Constants::isMessageTypeName($messageArray['MsgType'])) {
            throw new \Exception('Invalid message type: ' . $messageArray['MsgType']);
        }
        
        $messageType = $messageArray['MsgType'];
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
    
    protected function getInstance()
    {
        return $this->instance;
    }
    
    protected function setOption($field, $value)
    {
        $this->options[$field] = $value;
        
        return $this;
    }
    
    protected function getOption($field)
    {
        return $this->options[$field];
    }
    
    protected function isValidInstance()
    {
        if ($this->instance instanceof AbstractMessage) {
            return true;
        }
        
        return false;
    }
    
    public function setMessageType($messageType) 
    {
        if ($this->instance instanceof AbstractMessage) {
            if ($messageType == $this->getMessageType()) {
                return $this;
            } else {
                throw new \Exception('It\'s not allowd to change a existed message type');
            }
        } else {
            $this->setOption(Constants::MESSAGE_TYPE_FIELD, $messageType);
            $this->setInstance($this->options);
            return $this;
        }
    }
    
    public function setContent($content)
    {
        if ($this->isValidInstance()) {
            $this->getInstance()->setContent($content);
        } else {
            $this->setOption(Constants::CONTENT_FIELD, $content);
        }
    
        return $this;
    }
    
    
    public function getContent()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->getContent();
        } else {
            return $this->getOption(Constants::CONTENT_FIELD);
        }
    }
    
    
    public function toString()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->toString();
        } else {
            throw new \Exception('Please specify message type');
        }
    }
    
    public function setMessageId($messageId)
    {
        if ($this->isValidInstance()) {
            $this->getInstance()->setMessageId($messageId);
        } else {
            $this->setOption(Constants::MESSAGE_ID_FIELD, $messageId);
        }
    
        return $this;
    }
    
    
    public function getMessageId()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->getMessageId();
        } else {
            return $this->getOption(Constants::MESSAGE_ID_FIELD);
        }
    }
    
    
    public function setToUser($user)
    {
        if ($this->isValidInstance()) {
            $this->getInstance()->setToUser($user);
        } else {
            $this->setOption(Constants::TO_USER_NAME_FIELD, $user);
        }
    
        return $this;
    }
    
    
    public function getToUser()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->getToUser();
        } else {
            return $this->getOption(Constants::TO_USER_NAME_FIELD);
        }
    }
    
    public function getMessageType()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->getMessageType();
        } else {
            return $this->getOption(Constants::MESSAGE_TYPE_FIELD);
        }
    }
    
    
    public function setFromUser($user)
    {
        if ($this->isValidInstance()) {
            $this->getInstance()->setFromUser($user);
        } else {
            $this->setOption(Constants::FROM_USER_NAME_FIELD, $user);
        }
    
        return $this;
    }
    
    
    public function setCreateTime($time)
    {
        if ($this->isValidInstance()) {
            $this->getInstance()->setCreateTime($time);
        } else {
            $this->setOption(Constants::CREATE_TIME_FIELD, $time);
        }
    
        return $this;
    }
    
    
    public function getFromUser()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->getFromUser();
        } else {
            return $this->getOption(Constants::FROM_USER_NAME_FIELD);
        }
    }
    
    
    public function getCreateTime()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->getCreateTime();
        } else {
            return $this->getOption(Constants::CREATE_TIME_FIELD);
        }
    }
    
    
    public function setPicUrl($picUrl)
    {
        if ($this->isValidInstance()) {
            $this->getInstance()->setPicUrl($picUrl);
        } else {
            $this->setOption(Constants::PIC_URL_FIELD, $picUrl);
        }
    
        return $this;
    }
    
    
    public function getPicUrl()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->getPicUrl();
        } else {
            return $this->getOption(Constants::PIC_URL_FIELD);
        }
    }
    
    
    public function setMediaId($mediaId)
    {
        if ($this->isValidInstance()) {
            $this->getInstance()->setMediaId($mediaId);
        } else {
            $this->setOption(Constants::MEDIA_ID_FIELD, $mediaId);
        }
    
        return $this;
    }
    
    
    public function getMediaId()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->getMediaId();
        } else {
            return $this->getOption(Constants::MEDIA_ID_FIELD);
        }
    }
    
    
    public function setVoiceFormat($voiceFormat)
    {
        if ($this->isValidInstance()) {
            $this->getInstance()->setVoiceFormat($voiceFormat);
        } else {
            $this->setOption(Constants::VOICE_FORMAT_FIELD, $voiceFormat);
        }
    
        return $this;
    }
    
    
    public function getVoiceFormat()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->getVoiceFormat();
        } else {
            return $this->getOption(Constants::VOICE_FORMAT_FIELD);
        }
    }
    
    
    public function setRecognition($recognition)
    {
        if ($this->isValidInstance()) {
            $this->getInstance()->setRecognition($recognition);
        } else {
            $this->setOption(Constants::RECOGNITION_FIELD, $recognition);
        }
    
        return $this;
    }
    
    
    public function getRecognition()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->getRecognition();
        } else {
            return $this->getOption(Constants::RECOGNITION_FIELD);
        }
    }
    
    
    public function setThumbMediaId($thumbMediaId)
    {
        if ($this->isValidInstance()) {
            $this->getInstance()->setThumbMediaId($thumbMediaId);
        } else {
            $this->setOption(Constants::THUMN_MEDIA_ID_FIELD, $thumbMediaId);
        }
    
        return $this;
    }
    
    
    public function getThumbMediaId()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->getThumbMediaId();
        } else {
            return $this->getOption(Constants::THUMN_MEDIA_ID_FIELD);
        }
    }
    
    
    public function setTitle($title)
    {
        if ($this->isValidInstance()) {
            $this->getInstance()->setTitle($title);
        } else {
            $this->setOption(Constants::TITLE_FIELD, $title);
        }
    
        return $this;
    }
    
    
    public function getTitle()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->getTitle();
        } else {
            return $this->getOption(Constants::TITLE_FIELD);
        }
    }
    
    
    public function setDescription($description)
    {
        if ($this->isValidInstance()) {
            $this->getInstance()->setDescription($description);
        } else {
            $this->setOption(Constants::DESCRIPTIO_FIELD, $description);
        }
    
        return $this;
    }
    
    
    public function getDescription()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->getDescription();
        } else {
            return $this->getOption(Constants::DESCRIPTIO_FIELD);
        }
    }
    
    
    public function setMusicUrl($musicUrl)
    {
        if ($this->isValidInstance()) {
            $this->getInstance()->setMusicUrl($musicUrl);
        } else {
            $this->setOption(Constants::MUSIC_URL_FIELD, $musicUrl);
        }
    
        return $this;
    }
    
    
    public function getMusicUrl()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->getMusicUrl();
        } else {
            return $this->getOption(Constants::MUSIC_URL_FIELD);
        }
    }
    
    
    public function setHQMusicUrl($HQMusicUrl)
    {
        if ($this->isValidInstance()) {
            $this->getInstance()->setHQMusicUrl($HQMusicUrl);
        } else {
            $this->setOption(Constants::MUSIC_HQ_MUSIC_URL, $HQMusicUrl);
        }
    
        return $this;
    }
    
    
    public function getHQMusicUrl()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->getHQMusicUrl();
        } else {
            return $this->getOption(Constants::MUSIC_HQ_MUSIC_URL);
        }
    }
    
    
    public function addArticle($article)
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->addArticle($article);
        } else {
            return $this->getOption(Constants::ARTICLES_FIELD);
        }
    }
    
    
    public function setEventKey($eventKey)
    {
        if ($this->isValidInstance()) {
            $this->getInstance()->setEventKey($eventKey);
        } else {
            $this->setOption(Constants::EVENT_KEY_FIELD, $eventKey);
        }
    
        return $this;
    }
    
    
    public function getEventKey()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->getEventKey();
        } else {
            return $this->getOption(Constants::EVENT_KEY_FIELD);
        }
    }
    
    public function setTicket($ticket)
    {
        if ($this->isValidInstance()) {
            $this->getInstance()->setTicket($ticket);
        } else {
            $this->setOption(Constants::TICKET_FIELD, $ticket);
        }
    
        return $this;
    }
    
    public function getTicket()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->getTicket();
        } else {
            return $this->getOption(Constants::TICKET_FIELD);
        }
    }
    
    public function setLatitude($latitude)
    {
        if ($this->isValidInstance()) {
            $this->getInstance()->setLatitude($latitude);
        } else {
            $this->setOption(Constants::LATITUDE_FIELD, setLatitude);
        }
        
        return $this;
    }
    
    public function getLatitude()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->getLatitude();
        } else {
            return $this->getOption(Constants::LATITUDE_FIELD);
        }
    }
    
    public function setLongitude($longitude)
    {
        if ($this->isValidInstance()) {
            $this->getInstance()->setLongitude($longitude);
        } else {
            $this->setOption(Constants::LONGITUDE_FIELD, $longitude);
        }
    }
    
    public function getLongitude()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->getLongitude();
        } else {
            return $this->getOption(Constants::LONGITUDE_FIELD);
        }
    }
    
    public function setPrecision($precision)
    {
        if ($this->isValidInstance()) {
            $this->getInstance()->setPrecision($precision);
        } else {
            $this->setOption(Constants::PRECISION_FIELD, $precision);
        }
    }
    
    public function getPrecision()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->getPrecision();
        } else {
            return $this->getOption(Constants::PRECISION_FIELD);
        }
    }
    
    
    public function setEventToSub()
    {
        if ($this->isValidInstance()) {
            $this->getInstance()->setEventSub();
        } else {
            $this->setOption(Constants::EVENT_FIELD, Constants::SUBSCRIBE_EVENT_TYPE_NAME);
        }
    
        return $this;
    }
    
    
    public function setEventToUnsub()
    {
        if ($this->isValidInstance()) {
            $this->getInstance()->setEventUnsub();
        } else {
            $this->setOption(Constants::EVENT_FIELD, Constants::UNSUBSCRIBE_EVENT_TYPE_NAME);
        }
    
        return $this;
    }
    
    
    public function setEventToScan()
    {
        if ($this->isValidInstance()) {
            $this->getInstance()->setEventScan();
        } else {
            $this->setOption(Constants::EVENT_FIELD, Constants::SCAN_EVENT_TYPE_NAME);
        }
    
        return $this;
    }
    
    
    public function setEventToLocation()
    {
        if ($this->isValidInstance()) {
            $this->getInstance()->setEventLocation();
        } else {
            $this->setOption(Constants::EVENT_FIELD, Constants::LOCATION_EVENT_TYPE_NAME);
        }
    
        return $this;
    }
    
    
    public function setEventToMenu()
    {
        if ($this->isValidInstance()) {
            $this->getInstance()->setEventMenu();
        } else {
            $this->setOption(Constants::EVENT_FIELD, Constants::MENU_EVENT_TYPE_NAME);
        }
    
        return $this;
    }
    
    
    public function setEvent($event)
    {
        if ($this->isValidInstance()) {
            $this->getInstance()->setEvent($event);
        } else {
            $this->setOption(Constants::EVENT_FIELD, $event);
        }
    
        return $this;
    }
    
    
    public function getEvent()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->getEvent();
        } else {
            return $this->getOption(Constants::EVENT_FIELD);
        }
    }
    
    /**
     * 是否是文本消息
     * @return boolean
     */
    public function isText()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->isText();
        } else {
            throw new \Exception('Please first specify message type');
        }
    }
    
    /**
     * 是否是图片消息
     * @return boolean
     */
    public function isImage()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->isImage();
        } else {
            throw new \Exception('Please first specify message type');
        }
    }
    
    /**
     * 是否是语音消息
     * @return boolean
     */
    public function isVoice()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->isVoice();
        } else {
            throw new \Exception('Please first specify message type');
        }
    }
    
    /**
     * 是否是视频消息
     * @return boolean
     */
    public function isVideo()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->isVideo();
        } else {
            throw new \Exception('Please first specify message type');
        }
    }
    
    /**
     * 是否是位置消息
     * @return boolean
     */
    public function isLocation()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->isLocation();
        } else {
            throw new \Exception('Please first specify message type');
        }
    }
    
    /**
     * 是否是事件消息
     * @return boolean
     */
    public function isEvent()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->isEvent();
        } else {
            throw new \Exception('Please first specify message type');
        }
    }
    
    /**
     * 是否是关注事件
     * @return boolean
     */
    public function isSubEvent()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->isSubEvent();
        } else {
            throw new \Exception('Please first specify message type');
        }
    }
    
    /**
     * 是否是扫描后关注事件
     * 新用户：如果用户还未关注公众号，则用户可以关注公众号，关注后微信会将带场景值关注事件推送给开发者
     * @throws \Exception
     * @return boolean
     */
    public function isScanSubEvent()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->isScanSubEvent();
        } else {
            throw new \Exception('Please first specify message type');
        }
    }
    
    /**
     * 是否是取消关注事件
     * @return boolean
     */
    public function isUnSubEvent()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->isUnSubEvent();
        } else {
            throw new \Exception('Please first specify message type');
        }
    }
    
    /**
     * 是否是扫描事件
     * @return boolean
     */
    public function isScanEvent()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->isScanEvent();
        } else {
            throw new \Exception('Please first specify message type');
        }
    }
    
    /**
     * 是否是位置事件
     * @return boolean
     */
    public function isLocationEvent()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->isLocationEvent();
        } else {
            throw new \Exception('Please first specify message type');
        }
    }
    
    /**
     * 是否是点击菜单事件
     * @return boolean
     */
    public function isMenuEvent()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->isMenuEvent();
        } else {
            throw new \Exception('Please first specify message type');
        }
    }
    
    /**
     * 设置为文本消息
     * @return boolean
     */
    public function setToText()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->setToText();
        } else {
            $this->setMessageType(Constants::TEXT_MESSAGE_TYPE_NAME);
        }
    
        return $this;
    }
    
    /**
     * 设置为图片消息
     * @return boolean
     */
    public function setToImage()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->setToImage();
        } else {
            $this->setMessageType(Constants::IMAGE_MESSAGE_TYPE_NAME);
        }
    
        return $this;
    }
    
    /**
     * 设置为语音消息
     * @return boolean
     */
    public function setToVoice()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->setToVoice();
        } else {
            $this->setMessageType(Constants::VOICE_MESSAGGE_TYPE_NAME);
        }
    
        return $this;
    }
    
    /**
     * 设置为视频消息
     * @return boolean
     */
    public function setToVideo()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->setToVideo();
        } else {
            $this->setMessageType(Constants::VIDEO_MESSAGGE_TYPE_NAME);
        }
    
        return $this;
    }
    
    /**
     * 设置为事件消息
     * @return boolean
     */
    public function setToEvent()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->setToEvent();
        } else {
            $this->setMessageType(Constants::EVENT_MESSAGGE_TYPE_NAME);
        }
    
        return $this;
    }
    
    /**
     * 设置为图文消息
     * @return boolean
     */
    public function setToNews()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->setNews();
        } else {
            $this->setMessageType(Constants::NEWS_MESSAGGE_TYPE_NAME);
        }
    
        return $this;
    }
    
   
}
?>