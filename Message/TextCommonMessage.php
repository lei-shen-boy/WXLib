<?php
/**
 * 接收文本消息|回复文本消息
 */
require_once 'AbstractCommonMessage.php';

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
        $this->setContent($message['Content'] ? $message['Content'] : '');
    }
    
    public function toString()
    {
        $tpl = parent::toString();
        return sprintf($tpl, '<Content><![CDATA[' . $this->content . ']]></Content>');
    }
}
?>