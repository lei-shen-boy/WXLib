<?php
/**
 * 接收链接消息
 */
require_once 'AbstractCommonMessage.php';

class LinkCommonMessage extends AbstractCommonMessage
{
    /**
     * @var string
     */
    protected $title;
    
    /**
     * @var string
     */
    protected $description;
    
    /**
     * @var string
     */
    protected $url;
    
    
    public function __construct($message = null)
    {
        $this->init(parent::__construct($message));
    }
    
    public function setTitle($title)
    {
        $this->title = $title;
        
        return $this;
    }
    
    public function getTitle()
    {
        return $this->title;
    }
    
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }
    
    public function getDescription()
    {
        return $this->description;
    }
    
    public function setUrl($url)
    {
        $this->url = $url;
    
        return $this;
    }
    
    public function getUrl()
    {
        return $this->url;
    }
    
    public function init($message)
    {
        parent::init($message);
        $this->setTitle($message['Title'] ? $message['Title'] : '');
        $this->setDescription($message['Description'] ? $message['Description'] : '');
        $this->setUrl($message['Url'] ? $message['Url'] : '');
    }
    
    public function toString()
    {
        $tpl = parent::toString();
        return sprintf($tpl, $this->getMyXmlPart());
    }
    
    protected function getMyXmlPart()
    {
        if ($this->getMessageId()) {
            $myXmlTpl = '<Title><![CDATA[%s]]></Title>
<Description><![CDATA[%s]]></Description>
<Url><![CDATA[%s]]></Url>';
            
            return sprintf($myXmlTpl, $this->getTitle(), $this->getDescription(), $this->getUrl());
        } else {
        }
    }
}
?>