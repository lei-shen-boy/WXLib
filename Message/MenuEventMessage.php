<?php
/**
 * 自定义菜单事件
 *
 */
class MenuEventMessage extends AbstractEventMessage
{
    /**
     * 地理位置纬度
     */
    protected $latitude;
    
    /**
     * 地理位置经度
     */
    protected $longitude;
    
    /**
     * 地理位置精度
     */
    protected $precision;
    
    
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
        
        return $this;
    }
    
    public function getLatitude()
    {
        return $this->latitude;
    }
    
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
        
        return $this;
    }
    
    public function getLongitude()
    {
        return $this->longitude;
    }
    
    public function setPrecision($precision)
    {
        $this->precision = $precision;
    
        return $this;
    }
    
    public function getPrecision()
    {
        return $this->precision;
    }
    
    public function init($message)
    {
        parent::init($message);
        $this->setLatitude($message['Latitude'] ? $message['Latitude'] : '');
        $this->setLongitude($message['Longitude'] ? $message['Longitude'] : '');
        $this->setPrecision($message['Precision'] ? $message['Precision'] : '');
    }
}
?>