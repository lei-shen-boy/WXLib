<?php
namespace WXLib\Menu;

use WXLib\Menu\Button;
use WXLib\Constants;
use WXLib\Basic\RawBodyRequest;
use WXLib\Basic\Request;
class Menu
{
    protected $buttonId = 0;
    
    protected $buttons = array();
    
    public function getButtonId()
    {
        return $this->buttonId;
    }
    
    public function incButtonId()
    {
        return $this->buttonId++;
    }
    
    /**
     * 添加一个一级click按钮
     */
    public function addButton($button)
    {
        if (($button instanceof AbstractButton) || ($button instanceof Button)) {
            $button = $button->toArray();
        } elseif (!is_array($button)) {
            throw new \Exception('Error:' . __METHOD__);
            
        } 
        $buttonId = $this->incButtonId();
        $this->buttons[$buttonId] = $button;
        
        return $buttonId;
    }
    
    /**
     * 添加一个一级按钮的名称
     */
    public function addButtonName($name)
    {
        $buttonId = $this->incButtonId();
        $this->buttons[$buttonId] = array(
                Constants::MENU_BUTTON_NAME_FIELD => $name,
                Constants::MENU_SUB_BUTTON_FIELD => array()
        );
        
        return $buttonId;
    }
    
    /**
     * 添加一个二级按钮
     * @param unknown $buttonId
     */
    public function addSubButton($buttonId, $button)
    {
        if ($button instanceof Button) {
            $button = $button->toArray();
        } elseif (!is_array($button)) {
            throw new \Exception('Error' . __METHOD__);
        }
        
        $this->buttons[$buttonId][Constants::MENU_SUB_BUTTON_FIELD][] = $button;
        
        return $this;
    }
    
    public function toArray()
    {
        $buttons = array();
        foreach ($this->buttons as $key => $val) {
            if (isset($val[Constants::MENU_BUTTON_NAME_FIELD]) && isset($val[Constants::MENU_SUB_BUTTON_FIELD])) {
                $buttons[] = array(
                        Constants::MENU_BUTTON_NAME_FIELD => $val[Constants::MENU_BUTTON_NAME_FIELD],
                        Constants::MENU_SUB_BUTTON_FIELD => $val[Constants::MENU_SUB_BUTTON_FIELD]
                        
                );
            } else {
                $buttons[] = $val;
            }
        }
        
        return array('button' => $buttons);
    }
    
    public function toString()
    {
        return json_encode($this->toArray());
    }
    
    /**
     * 自定义菜单创建接口
     */
    public function create()
    {
        $apiOptions = array(
                'method' => 'POST',
                'url' => 'https://api.weixin.qq.com/cgi-bin/menu/create'
        );
        $rawBodyRequest = new RawBodyRequest($apiOptions);
        $rawBodyRequest->setRawBody($this->toString());
        
        return $rawBodyRequest->send();
    }
    
    /**
     * 自定义菜单查询接口
     */
    public static function get()
    {
        $request = new Request(array(
                'method' => 'GET',
                'url' => 'https://api.weixin.qq.com/cgi-bin/menu/get',
                
        ));

        return $request->send();
    }
    
    /**
     * 自定义菜单删除接口
     */
    public static function delete()
    {
        $request = new Request(array(
                'method' => 'GET',
                'url' => 'https://api.weixin.qq.com/cgi-bin/menu/delete',
        
        ));
        
        return $request->send();
    }
}
?>