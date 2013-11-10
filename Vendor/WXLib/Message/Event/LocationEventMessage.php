<?php
/**
 * 上报地理位置事件
 *
 */
namespace WXLib\Message\Event;
use WXLib\Constants;
class LocationEventMessage extends AbstractEventMessage
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
        $this->setLatitude(isset($message[Constants::LATITUDE_FIELD]) ? $message[Constants::LATITUDE_FIELD] : '');
        $this->setLongitude(isset($message[Constants::LONGITUDE_FIELD]) ? $message[Constants::LONGITUDE_FIELD] : '');
        $this->setPrecision(isset($message[Constants::PRECISION_FIELD]) ? $message[Constants::PRECISION_FIELD] : '');
        $this->setEventToLocation();
    }
    
    public function toString()
    {
        $xmlStringTpl = parent::toString();
        return sprintf($xmlStringTpl,
                "
<Latitude>{$this->getLatitude()}</Latitude>
<Longitude>{$this->getLongitude()}</Longitude>
<Precision>{$this->getPrecision()}</Precision>"
                            );
    }
}
?>