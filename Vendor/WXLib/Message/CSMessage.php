<?php
namespace WXLib\Message; 

use WXLib\Message\CustomerService\AbstractCSMessage;
use WXLib\Message\CustomerService\ImageCSMessage;
use WXLib\Message\CustomerService\TextCSMessage;
use WXLib\Message\CustomerService\VoiceCSMessage;
use WXLib\Message\CustomerService\VideoCSMessage;
use WXLib\Message\CustomerService\MusicCSMessage;
use WXLib\Message\CustomerService\NewsCSMessage;
use WXLib\Constants;

class CSMessage
{
    protected $instance;
    
    protected $options = array();
    
    public function __construct($message = null)
    {
        if (is_array($message)) {
            $messageArray = $message;
        } elseif ($message !== null) {
            throw new \Exception(sprintf(
                    'Expecting an array, received "%s"',
                    (is_object($message) ? get_class($message) : gettype($message))
            ));
        }
    
        if (isset($messageArray) && is_array($messageArray)) {
            $this->setInstance($messageArray);
        }
    }
    
    public function setInstance($messageArray = null)
    {
        if (!isset($messageArray[Constants::CS_MESSAGE_TYPE_FIELD])) {
            throw new \Exception('Please specify message type as a array element: $messageArray[\'msgtype\']');
        }
        if (!Constants::isCSMessageTypeName($messageArray[Constants::CS_MESSAGE_TYPE_FIELD])) {
            throw new \Exception('Invalid message type: ' . $messageArray['msgtype']);
        }
    
        $messageType = $messageArray[Constants::CS_MESSAGE_TYPE_FIELD];
        $className = 'WXLib\\Message\\CustomerService\\' . ucfirst(strtolower($messageType)) . 'CSMessage';
    
        $this->instance = new $className($messageArray);
    }
    
    protected function getInstance()
    {
        return $this->instance;
    }
    
    protected function isValidInstance()
    {
        if ($this->instance instanceof AbstractCSMessage) {
            return true;
        }
    
        return false;
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
    
    
    public function setContent($content)
    {
        if ($this->isValidInstance()) {
            $this->getInstance()->setContent($content);
        } else {
            $this->setOption(Constants::CS_CONTENT_FIELD, $content);
        }
    
        return $this;
    }
    
    
    public function getContent()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->getContent();
        } else {
            return $this->getOption(Constants::CS_CONTENT_FIELD);
        }
    }
    
    
    
    
    public function setToUser($user)
    {
        if ($this->isValidInstance()) {
            $this->getInstance()->setToUser($user);
        } else {
            $this->setOption(Constants::CS_TO_USER_FIELD, $user);
        }
    
        return $this;
    }
    
    public function getToUser()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->getToUser();
        } else {
            return $this->getOption(Constants::CS_TO_USER_FIELD);
        }
    }
    
    
    public function setMessageType($messageType)
    {
        if ($this->instance instanceof AbstractCSMessage) {
            if ($messageType == $this->getMessageType()) {
                return $this;
            } else {
                throw new \Exception('It\'s not allowd to change a existed message type');
            }
        } else {
            $this->setOption(Constants::CS_MESSAGE_TYPE_FIELD, $messageType);
            $this->setInstance($this->options);
            return $this;
        }
    }
    
    
    public function getMessageType()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->getMessageType();
        } else {
            return $this->getOption(Constants::CS_MESSAGE_TYPE_FIELD);
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
    
    
    public function send()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->send();
        } else {
            throw new \Exception('Please specify message type');
        }
    }
    
    public function setMediaId($mediaId)
    {
        if ($this->isValidInstance()) {
            $this->getInstance()->setMediaId($mediaId);
        } else {
            $this->setOption(Constants::CS_MEDIA_ID_FIELD, $mediaId);
        }
    
        return $this;
    }
    
    
    public function getMediaId()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->getMediaId();
        } else {
            return $this->getOption(Constants::CS_MEDIA_ID_FIELD);
        }
    }
    
    
    public function setThumbMediaId($thumbMediaId)
    {
        if ($this->isValidInstance()) {
            $this->getInstance()->setThumbMediaId($thumbMediaId);
        } else {
            $this->setOption(Constants::CS_THUMB_MEDIA_ID, $thumbMediaId);
        }
    
        return $this;
    }
    
    public function getThumbMediaId()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->getThumbMediaId();
        } else {
            return $this->getOption(Constants::CS_THUMB_MEDIA_ID);
        }
    }
    
    
    public function setTitle($title)
    {
        if ($this->isValidInstance()) {
            $this->getInstance()->setTitle($title);
        } else {
            $this->setOption(Constants::CS_TITLE_FIELD, $title);
        }
    
        return $this;
    }
    
    
    public function getTitle()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->getTitle();
        } else {
            return $this->getOption(Constants::CS_TITLE_FIELD);
        }
    }
    
    
    public function setDescription($description)
    {
        if ($this->isValidInstance()) {
            $this->getInstance()->setDescription($description);
        } else {
            $this->setOption(Constants::CS_DESCRIPTION_FIELD, $description);
        }
    
        return $this;
    }
    
    
    public function getDescription()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->getDescription();
        } else {
            return $this->getOption(Constants::CS_DESCRIPTION_FIELD);
        }
    }
    
    
    public function setMusicUrl($musicUrl)
    {
        if ($this->isValidInstance()) {
            $this->getInstance()->setMusicUrl($musicUrl);
        } else {
            $this->setOption(Constants::CS_MUSIC_URL_FIELD, $musicUrl);
        }
    
        return $this;
    }
    
    
    public function getMusicUrl()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->getMusicUrl();
        } else {
            return $this->getOption(Constants::CS_MUSIC_URL_FIELD);
        }
    }
    
    
    public function setHQMusicUrl($HQMusicUrl)
    {
        if ($this->isValidInstance()) {
            $this->getInstance()->setHQMusicUrl($HQMusicUrl);
        } else {
            $this->setOption(Constants::CS_HQ_MUSIC_URL_FIELD, $HQMusicUrl);
        }
    
        return $this;
    }
    
    
    public function getHQMusicUrl()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->getHQMusicUrl();
        } else {
            return $this->getOption(Constants::CS_HQ_MUSIC_URL_FIELD);
        }
    }
    
    public function addArticle()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->addArticle();
        } else {
            return $this->getOption(Constants::CS_ARTICLES_FIELD);
        }
    }
}
?>