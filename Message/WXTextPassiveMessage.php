<?php
class WXTextPassiveMessage extends WXAbstractPassiveMessage
{
    protected $content;
    
    public function __construct($message = null)
    {
        $this->init(parent::__construct($message));
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