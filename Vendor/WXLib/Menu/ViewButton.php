<?php
/**
 * 按钮
 */
namespace WXLib\Menu;

use WXLib\Constants;
class ViewButton extends AbstractButton
{
    /**
     * 菜单KEY值，用于消息接口推送，不超过128字节
     */
    protected $url;
    
    
    public function init($button)
    {
        parent::init($button);
        $this->setType(Constants::MENU_VIEW_BUTTON_TYPE_NAME);
        $this->setUrl(isset($button[Constants::MENU_BUTTON_URL_FIELD]) ? $button[Constants::MENU_BUTTON_URL_FIELD] : '');
    }
    
    public function toArray()
    {
        $res = parent::toArray();
        $res[Constants::MENU_BUTTON_URL_FIELD] = $this->getUrl();
        
        return $res;
    }
    
    public function setUrl($url)
    {
        $this->url = $url;
        
        return $this;
    }
    
    public function getUrl()
    {
        return $this->url;
        
    }
}
?>