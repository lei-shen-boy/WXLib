<?php
namespace WXLib\Menu;

use WXLib\Constants;
use WXLib\Menu\ClickButton;
use WXLib\Menu\ViewButton;

class Button
{
    protected $instance;
    
    protected $options = array();
    
    public function __construct($button = null)
    {
        if ($button !== null && !is_array($button)) {
            throw new \Exception(sprintf(
                    'Expecting an array, received "%s"',
                    (is_object($button) ? get_class($button) : gettype($button))
            ));
        }
    
        if (isset($button) && is_array($button)) {
            $this->setInstance($button);
        }
    }
    
    protected function getButtonClass($type)
    {
        return 'WXLib\\Menu\\' . ucfirst(strtolower($type)) . 'Button';
    }
    
    protected function setInstance($button)
    {
        $className = self::getButtonClass($button[Constants::MENU_BUTTON_TYPE_FIELD]);
        
        $this->instance = new $className($button);
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
        if ($this->instance instanceof AbstractButton) {
            return true;
        }
    
        return false;
    }
    
    public function setType($type)
    {
        if ($this->instance instanceof AbstractButton) {
            if ($type == $this->getType()) {
                return $this;
            } else {
                throw new \Exception('It\'s not allowd to change a existed button type');
            }
        } else {
            $this->setOption(Constants::MENU_BUTTON_TYPE_FIELD, $type);
            $this->setInstance($this->options);
            return $this;
        }
    }
    
    public function getType()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->getType();
        } else {
            return $this->getOption(Constants::MENU_BUTTON_TYPE_FIELD);
        }
    }
    
    public function setName($name)
    {
        if ($this->isValidInstance()) {
            $this->getInstance()->setName($name);
        } else {
            $this->setOption(Constants::MENU_BUTTON_NAME_FIELD, $name);
        }
    
        return $this;
    }
    
    
    public function getName()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->getName();
        } else {
            return $this->getOption(Constants::MENU_BUTTON_NAME_FIELD);
        }
    }
    
    public function setKey($key)
    {
        if ($this->isValidInstance()) {
            $this->getInstance()->setKey($key);
        } else {
            $this->setOption(Constants::MENU_BUTTON_KEY_FIELD, $key);
        }
    
        return $this;
    }
    
    
    public function getKey()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->getKey();
        } else {
            return $this->getOption(Constants::MENU_BUTTON_KEY_FIELD);
        }
    }
    
    public function setUrl($url)
    {
        if ($this->isValidInstance()) {
            $this->getInstance()->setUrl($url);
        } else {
            $this->setOption(Constants::MENU_BUTTON_URL_FIELD, $url);
        }
    
        return $this;
    }
    
    
    public function getUrl()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->getUrl();
        } else {
            return $this->getOption(Constants::MENU_BUTTON_URL_FIELD);
        }
    }
    
    public function toArray()
    {
        if ($this->isValidInstance()) {
            return $this->getInstance()->toArray();
        } else {
            throw new \Exception('Please specify message type');
        }
    }
}
?>