<?php
/**
 * 接收地理位置消息
 * @author Gavin
 *
 */
namespace WXLib\Message\Common;

class LocationCommonMessage extends AbstractCommonMessage
{
    /**
     * 地理位置维度
     * @var float
     */
    protected $locationX;
    
    /**
     * 地理位置精度
     * @var float
     */
    protected $locationY;
    
    /**
     * 地图缩放大小
     * @var int
     */
    protected $scale;
    
    /**
     * 地理位置信息
     * @var int
     */
    protected $label;
    
    public function setLocationX($locationX)
    {
        $this->locationX = $locationX;
        
        return $this;
    }
    
    public function getLocationX()
    {
        return $this->locationX;
    }
    
    public function setLocationY($locationY)
    {
        $this->locationY = $locationY;
    
        return $this;
    }
    
    public function getLocationY()
    {
        return $this->locationY;
    }
    
    public function setScale($scale)
    {
        $this->scale = $scale;
    
        return $this;
    }
    
    public function getScale()
    {
        return $this->scale;
    }
    
    public function setLabel($label)
    {
        $this->label = $label;
    
        return $this;
    }
    
    public function getLabel()
    {
        return $this->label;
    }
    
    
    
    public function init($message)
    {
        parent::init($message);
        $this->setLocationX($message['Location_X'] ? $message['Location_X'] : '');
        $this->setLocationY($message['Location_Y'] ? $message['Location_Y'] : '');
        $this->setScale($message['Scale'] ? $message['Scale'] : '');
        $this->setLabel($message['Label'] ? $message['Label'] : '');
    }
    
    public function toString()
    {
        $tpl = parent::toString();
        return sprintf($tpl, $this->getMyXmlPart());
    }
    
    protected function getMyXmlPart()
    {
        if ($this->getMessageId()) {
            $myXmlTpl = '<Location_X>%s</Location_X>
<Location_Y>%s</Location_Y>
<Scale>%s</Scale>
<Label><![CDATA[%s]]></Label>';
            
            return sprintf($myXmlTpl, $this->getLocationX(), $this->getLocationY(), $this->getScale(), $this->getLabel());
        } else {
        }
    }
}
?>