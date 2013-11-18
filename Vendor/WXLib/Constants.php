<?php 
namespace WXLib;
class Constants
{
    /**
     * 消息类型值
     */
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
    
    /**
     * 事件类型值
     */
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
    
    /**
     * 消息字段名称
     */
    const TO_USER_NAME_FIELD = 'ToUserName';
    const FROM_USER_NAME_FIELD = 'FromUserName';
    const CREATE_TIME_FIELD = 'CreateTime';
    const MESSAGE_TYPE_FIELD = 'MsgType';
    const MESSAGE_ID_FIELD = 'MsgId';
    const MEDIA_ID_FIELD = 'MediaId';
    const CONTENT_FIELD = 'Content';
    const PIC_URL_FIELD = 'PicUrl';
    const FORMAT_FIELD = 'Format';
    const THUMN_MEDIA_ID_FIELD = 'ThumbMediaId';
    const SCALE_FIELD = 'Scale'; // 地图缩放大小
    const LABLE_FIELD = 'Label'; // 地理位置信息
    const TITLE_FIELD = 'Title';
    const DESCRIPTIO_FIELD = 'Description';
    const URL_FIELD = 'Url';
    const HQ_MUSIC_URL = 'HQMusicUrl';
    const ITEM_FIELD = 'item';
    const RECOGNITION_FIELD = 'Recognition';
    const EVENT_FIELD = 'Event';
    const EVENT_KEY_FIELD = 'EventKey';
    const TICKET_FIELD = 'Ticket';
    const LATITUDE_FIELD = 'Latitude'; // 地理位置纬度
    const LONGITUDE_FIELD  = 'Longitude'; // 地理位置经度
    const PRECISION_FIELD = 'Precision'; // 地理位置精度
    
    // 接收|回复文本消息字段
    const TEXT_CONTENT_FIELD = self::CONTENT_FIELD;
    
    // 接收|回复图片消息字段
    const IMAGE_PIC_URL_FIELD = self::PIC_URL_FIELD;
    const IMAGE_MEDIA_ID_FIELD = self::MEDIA_ID_FIELD;
    
    // 接收|回复语音消息字段
    const VOICE_FORMAT_FIELD = self::FORMAT_FIELD;
    const VOICE_RECOGNITION_FIELD = self::RECOGNITION_FIELD;
    
    // 接收|回复视频消息字段
    const VIDEO_THUMN_MEDIA_ID_FIELD = self::THUMN_MEDIA_ID_FIELD;
    const VIDEO_MEDIA_ID_FIELD = self::MEDIA_ID_FIELD;
    
    // 接收地理位置消息字段
    const LOCATION_X_FIELD = 'Location_X';
    const LOCATION_Y_FIELD = 'Location_Y';
    const LOCATION_SCALE_FIELD = self::SCALE_FIELD; // 地图缩放大小
    const LOCATION_LABLE_FIELD = self::LABLE_FIELD; // 地理位置信息
    
    // 接收链接消息字段
    const LINK_TITLE_FIELD = self::TITLE_FIELD;
    const LINK_DESCRIPTIO_FIELD = self::DESCRIPTIO_FIELD;
    const LINK_URL_FIELD = self::URL_FIELD;
    
    // 回复音乐消息字段
    const MUSIC_TITLE_FIELD = self::TITLE_FIELD;
    const MUSIC_DESCRIPTIO_FIELD = self::DESCRIPTIO_FIELD;
    const MUSIC_URL_FIELD = 'MusicURL';
    const MUSIC_HQ_MUSIC_URL = self::HQ_MUSIC_URL; 
    const MUSIC_THUMN_MEDIA_ID_FIELD = self::THUMN_MEDIA_ID_FIELD;
    
    // 回复图文消息字段
    const ARTICLE_COUNT_FIELD  = 'ArticleCount';
    const ARTICLES_FIELD = 'Articles'; 
    const NEWS_ARTICLE_COUNT = self::ARTICLE_COUNT_FIELD;
    const NEWS_ARTICLES_FIELD = self::ARTICLES_FIELD;
    const NEWS_TITLE_FIELD = self::TITLE_FIELD;
    const NEWS_DESCRIPTIO_FIELD = self::DESCRIPTIO_FIELD;
    const NEWS_PIC_URL_FIELD = self::PIC_URL_FIELD;
    const NEWS_URL_FIELD = self::URL_FIELD;
    const NEWS_ITEM_FIELD = self::ITEM_FIELD;
    const ARTICLE_TITLE_FIELD = self::TITLE_FIELD;
    const ARTICLE_DESCRIPTION_FIELD = self::DESCRIPTIO_FIELD;
    const ARTICLE_PIC_URL_FIELD = self::PIC_URL_FIELD;
    const ARTICLE_URL_FIELD = self::URL_FIELD;
    
    /**
     * 客服消息类型
     */
    const CS_TEXT_MESSAGE_TYPE_NAME = self::TEXT_MESSAGE_TYPE_NAME;
    const CS_IMAGE_MESSAGE_TYPE_NAME = self::IMAGE_MESSAGE_TYPE_NAME;
    const CS_VOICE_MESSAGGE_TYPE_NAME = self::VOICE_MESSAGGE_TYPE_NAME;
    const CS_VIDEO_MESSAGGE_TYPE_NAME = self::VIDEO_MESSAGGE_TYPE_NAME;
    const CS_MUSIC_MESSAGGE_TYPE_NAME = self::MUSIC_MESSAGGE_TYPE_NAME;
    const CS_NEWS_MESSAGGE_TYPE_NAME = self::NEWS_MESSAGGE_TYPE_NAME;
    static $csMessageTypeNames = array(
            self::CS_TEXT_MESSAGE_TYPE_NAME,
            self::CS_IMAGE_MESSAGE_TYPE_NAME,
            self::CS_VOICE_MESSAGGE_TYPE_NAME,
            self::CS_VIDEO_MESSAGGE_TYPE_NAME,
            self::CS_MUSIC_MESSAGGE_TYPE_NAME,
            self::CS_NEWS_MESSAGGE_TYPE_NAME,
    );
    
    /**
     * 客服消息字段名称
     */
    const CS_TO_USER_FIELD = 'touser';
    const CS_MESSAGE_TYPE_FIELD = 'msgtype';
    const CS_TEXT_FIELD = 'text';
    const CS_CONTENT_FIELD = 'content';
    const CS_MEDIA_ID_FIELD = 'media_id';
    const CS_THUMB_MEDIA_ID  = 'thumb_media_id';
    const CS_TITLE_FIELD = 'title';
    const CS_DESCRIPTION_FIELD = 'description';
    const CS_MUSIC_URL_FIELD = 'musicurl';
    const CS_HQ_MUSIC_URL_FIELD = 'hqmusicurl';
    const CS_ARTICLES_FIELD = 'articles';
    const CS_PIC_URL_FIELD = 'picurl';
    
    /**
     * 菜单按钮类型
     */
    const MENU_CLICK_BUTTON_TYPE_NAME = 'click';
    const MENU_VIEW_BUTTON_TYPE_NAME = 'view';
    
    /**
     * 菜单请求字段名称
     */
    const MENU_BUTTON_FIELD = 'button';
    const MENU_SUB_BUTTON_FIELD = 'sub_button';
    const MENU_BUTTON_TYPE_FIELD = 'type';
    const MENU_BUTTON_NAME_FIELD = 'name';
    const MENU_BUTTON_KEY_FIELD = 'key';
    const MENU_BUTTON_URL_FIELD = 'url';
    
    
    
    /**
     * 扫描带参数二维码事件，用户未关注时，进行关注后的事件推送, 此时的EventKey的值
     * 的前缀为qrscene_，后面为二维码的参数值
     */
    const SCAN_SUB_EVENT_KEY_VALUE_REFIX = 'qrscene_';
    
    static function isMessageTypeName($name)
    {
        return in_array($name, self::$messageTypeNames) ? true : false;
    }
    
    static function isCSMessageTypeName($name)
    {
        return in_array($name, self::$csMessageTypeNames) ? true : false;
    }
    
    static function isEventTypeName($name)
    {
        return in_array($name, self::$eventTypeNames) ? true : false;
    }
}
?>