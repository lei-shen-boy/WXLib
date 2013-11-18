<?php
namespace WXLib\Menu;

use WXLib\Menu\Button;
use WXLib\Constants;
class Menu
{
    protected static $buttonId = 0;
    
    protected $buttons = array();
    
    public function getButtonId()
    {
        return self::$buttonId;
    }
    
    public function incButtonId()
    {
        return self::$buttonId++;
    }
    
    /**
     * 添加一个一级click按钮
     */
    public function addButton($button)
    {
        if (($button instanceof AbstractButton) || ($button instanceof Button)) {
            $this->buttons[$this->incButtonId()] = $button;
        } elseif (is_array($button)) {
            $this->buttons[$this->incButtonId()] = new Button($button);
        } else {
            throw new \Exception('Error:' . __METHOD__);
        }
        
        return $this->getButtonId();
    }
    
    /**
     * 添加一个一级按钮的名称
     */
    public function addButtonName($name)
    {
        $this->buttons[$this->incButtonId()] = array(
                Constants::MENU_BUTTON_NAME_FIELD => $name,
                'subButtons' => array()
        );
        
        return $this->getButtonId();
    }
    
    /**
     * 添加一个二级按钮
     * @param unknown $buttonId
     */
    public function addSubButton($buttonId, $button)
    {
        $this->buttons[$buttonId]['subButtons'][] = $button;
        
        return $this;
    }
    
    public function toArray()
    {
        var_dump($this->buttons);
        $menu = array();
        foreach ($this->buttons as $key => $val) {
            if ($val instanceof Button) {
                $menu['button'][] = $val->toArray();
            }
        }
        var_dump($menu);
    }
}
?>