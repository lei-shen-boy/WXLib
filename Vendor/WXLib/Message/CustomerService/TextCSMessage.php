<?php
/**
 * 发送文本客服消息
 * @author huichaozh
 *
 */
namespace WXLib\Message\CustomerService;

class TextCSMessage extends AbstractCSMessage
{
    const CONTENT_FIELD_NAME = 'content';
    
    const MESSAGE_TYPE = 'text';
    
    protected $content;
    
    public function __construct($message = null, $accessToken = null)
    {
        $this->setMessageType(self::MESSAGE_TYPE);
        $this->setContent(isset($message['Content']) ? $message['Content'] : '');
        parent::__construct($message = null, $accessToken = null);
    }
    
    public function initFieldNames()
    {
        parent::initFieldNames();
        array_push($this->fieldNames, self::CONTENT_FIELD_NAME, $this->getMessageType());
    }
    
    public function setContent($content)
    {
        $this->content = $content;
        
        return $this;
    }
    
    public function getContent()
    {
        return $this->content;
    }
    
    public function setDetailOptions()
    {
        $this->setOption($this->getMessageType(), array(self::CONTENT_FIELD_NAME => $this->getContent()));
    }
    
}
?>