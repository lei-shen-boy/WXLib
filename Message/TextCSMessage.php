<?php
/**
 * 发送客服消息
 * @author huichaozh
 *
 */
require_once 'AbstractCSMessage.php';

class TextCSMessage extends AbstractCSMessage
{
    const CONTENT_FIELD_NAME = 'content';
    
    protected $content;
    
    public function __construct($message = null)
    {
        parent::__construct($message);
    }
    
    public function initFieldNames()
    {
        parent::initFieldNames();
        array_push($this->fieldNames, self::CONTENT_FIELD_NAME);
    }
    
    public function setContent($content)
    {
        $this->content = $content;
        $this->setOption(self::MESSAGE_TYPE_FIELD_NAME, array(self::CONTENT_FIELD_NAME => $content));
        
        return $this;
    }
    
    public function getContent()
    {
        return $this->content;
    }
    
    /**
     *
     * @param array $message
     */
    public function init($message)
    {
        parent::init($message);
        $this->setMessageType(self::MESSAGE_TYPE);
        $this->setContent($message['Content'] ? $message['Content'] : '');
    }
}
?>