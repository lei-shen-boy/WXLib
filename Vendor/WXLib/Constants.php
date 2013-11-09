<?php 
namespace WXLib;
class Constants
{
    const TEXT_MESSAGE_TYPE_NAME = 'text';
    const IMAGE_MESSAGE_TYPE_NAME = 'image';
    const VOICE_MESSAGGE_TYPE_NAME = 'voice';
    const VIDEO_MESSAGGE_TYPE_NAME = 'video';
    const MUSIC_MESSAGGE_TYPE_NAME = 'music';
    const NEWS_MESSAGGE_TYPE_NAME = 'news';
    const EVENT_MESSAGGE_TYPE_NAME = 'event';
    static $messageTypeNames = array(
            self::TEXT_MESSAGE_TYPE_NAME,
            self::IMAGE_MESSAGE_TYPE_NAME,
            self::VOICE_MESSAGGE_TYPE_NAME,
            self::VIDEO_MESSAGGE_TYPE_NAME,
            self::MUSIC_MESSAGGE_TYPE_NAME,
            self::NEWS_MESSAGGE_TYPE_NAME,
            self::EVENT_MESSAGGE_TYPE_NAME
    );
    
    const SUBSCRIBE_EVENT_TYPE_NAME = 'subscribe';
    const UNSUBSCRIBE_EVENT_TYPE_NAME = 'unsubscribe';
    const SCAN_EVENT_TYPE_NAME = 'scan';
    const LOCATION_EVENT_TYPE_NAME = 'LOCATION';
    const MENU_EVENT_TYPE_NAME = 'CLICK'; 
    static $eventTypeNames = array(
            self::SUBSCRIBE_EVENT_TYPE_NAME,
            self::UNSUBSCRIBE_EVENT_TYPE_NAME,
            self::SCAN_EVENT_TYPE_NAME,
            self::LOCATION_EVENT_TYPE_NAME,
            self::MENU_EVENT_TYPE_NAME
    );
    
    
    
    static function isMessageTypeName($name)
    {
        return in_array($name, self::$messageTypeNames) ? true : false;
    }
    
    static function isEventTypeName($name)
    {
        return in_array($name, self::$eventTypeNames) ? true : false;
    }
}
?>