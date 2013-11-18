<?php
/**
 * 按钮
 */
namespace WXLib\Menu;

use WXLib\Constants;
class ClickButton extends AbstractButton
{
    /**
     * 菜单KEY值，用于消息接口推送，不超过128字节
     */
    protected $key;
    
    
    public function init($button)
    {
        parent::init($button);
        $this->setType(Constants::MENU_CLICK_BUTTON_TYPE_NAME);
        $this->setKey(isset($button[Constants::MENU_BUTTON_KEY_FIELD]) ? $button[Constants::MENU_BUTTON_KEY_FIELD] : '');
    }
    
    public function toArray()
    {
        $res = parent::toArray();
        $res[Constants::MENU_BUTTON_KEY_FIELD] = $this->getKey();
        
        return $res;
    }
    
    public function setKey($key)
    {
        $this->key = $key;
        
        return $this;
    }
    
    public function getKey()
    {
        return $this->key;
        
    }
}
?>