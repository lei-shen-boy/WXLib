<?php
/**
 * 发送文本客服消息
 * @author huichaozh
 *
 */
namespace WXLib\Message\CustomerService;

use WXLib\Constants;
class TextCSMessage extends AbstractCSMessage
{
    protected $content;
    
    public function __construct($message = null, $accessToken = null)
    {
        $this->setMessageType(Constants::CS_TEXT_MESSAGE_TYPE_NAME);
        $this->setContent(isset($message[Constants::CS_CONTENT_FIELD]) ? $message[Constants::CS_CONTENT_FIELD] : '');
        parent::__construct($message = null, $accessToken = null);
    }
    
    public function initFieldNames()
    {
        parent::initFieldNames();
        array_push($this->fieldNames, Constants::CS_CONTENT_FIELD, $this->getMessageType());
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
        $this->setOption($this->getMessageType(), array(Constants::CS_CONTENT_FIELD => $this->getContent()));
    }
    
}
?>