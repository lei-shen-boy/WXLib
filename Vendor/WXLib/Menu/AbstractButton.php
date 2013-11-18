<?php
/**
 * 一个按钮
 */
namespace WXLib\Menu;

use WXLib\Constants;
class AbstractButton
{
    /**
     * 按钮类型
     */
    protected $type;
    
    /**
     * 按钮名称
     */
    protected $name;
    
    public function __construct($button = null)
    {
        if (is_array($button)) {
            $this->init($button);
        } elseif ($button !== null) {
            throw new \Exception('Error:' . __METHOD__);
        }
    }
    
    public function init($button)
    {
        $this->setType($button[Constants::MENU_BUTTON_TYPE_FIELD] ? $button[Constants::MENU_BUTTON_TYPE_FIELD] : '');
        $this->setName($button[Constants::MENU_BUTTON_NAME_FIELD] ? $button[Constants::MENU_BUTTON_NAME_FIELD] : '');
    }
    
    public function toString()
    {
        return json_encode(self::toArray());
    }
    
    public function toArray()
    {
        $res = array(
                Constants::MENU_BUTTON_TYPE_FIELD => $this->getType(),
                Constants::MENU_BUTTON_NAME_FIELD => $this->getName(),
        );
        
        return $res;
        
        if ($this->getType() == Constants::MENU_CLICK_BUTTON_TYPE_NAME) {
            array_push($res, array(Constants::MENU_BUTTON_KEY_FIELD => $this->getKey()));
        } elseif ($this->getType() == Constants::MENU_VIEW_BUTTON_TYPE_NAME) {
            array_push($res, array(Constants::MENU_BUTTON_URL_FIELD => $this->getUrl()));
        }
        
        return $res;
    }
    
    public function setType($type)
    {
        if (!in_array($type, array(Constants::MENU_CLICK_BUTTON_TYPE_NAME, Constants::MENU_VIEW_BUTTON_TYPE_NAME))) {
            throw new \Exception('Error:' . __METHOD__);
        }
        $this->type = $type;
        
        return $this;
    }
    
    public function getType()
    {
        return $this->type;
        
    }
    
    public function setName($name)
    {
        $this->name = $name;
        
        return $this;
    }
    
    public function getName()
    {
        return $this->name;
    }
}
?>