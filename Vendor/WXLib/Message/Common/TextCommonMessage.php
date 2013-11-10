<?php
/**
 * 接收文本消息|回复文本消息
 */
namespace WXLib\Message\Common;

class TextCommonMessage extends AbstractCommonMessage
{
    protected $content;
    
    public function setContent($content)
    {
        $this->content = $content;
        
        return $this;
    }
    
    public function getContent()
    {
        return $this->content;
    }
    
    public function init($message)
    {
        parent::init($message);
        $this->setContent(isset($message['Content']) ? $message['Content'] : '');
    }
    
    public function toString()
    {
        $tpl = parent::toString();
        return sprintf($tpl, '<Content><![CDATA[' . $this->content . ']]></Content>');
    }
}
?>