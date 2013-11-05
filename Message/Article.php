<?php
/**
 * 一条图文消息
 */
class Article
{
    /**
     * 图文消息标题
     */
    protected $title;
    
    /**
     * 图文消息描述
     */
    protected $description;
    
    /**
     * 图片链接，支持JPG、PNG格式，较好的效果为大图360*200，小图200*200
     */
    protected $picUrl;
    
    /**
     * 点击图文消息跳转链接
     */
    protected $url;
    
    public function __construct($article = null)
    {
        if (is_array($article)) {
            $this->init($article);
        } elseif (is_string($article)) {
            $this->init((array)simplexml_load_string($article, 'SimpleXMLElement', LIBXML_NOCDATA));
        } elseif ($article !== null) {
            throw new Exception('Error:' . __METHOD__);
        }
    }
    
    public function init($article)
    {
        $this->setTitle($article['Title'] ? $article['Title'] : '');
        $this->setDescription($article['Description'] ? $article['Description'] : '');
        $this->setPicUrl($article['PicUrl'] ? $article['PicUrl'] : '');
        $this->setUrl($article['Url'] ? $article['Url'] : '');
    }
    
    public function toString()
    {
        $xmlTpl = '<Title><![CDATA[%s]]></Title>
<Description><![CDATA[%s]]></Description>
<PicUrl><![CDATA[%s]]></PicUrl>
<Url><![CDATA[%s]]></Url>';
        return sprintf($xmlTpl, $this->getTitle(), $this->getDescription(), $this->getPicUrl(), $this->getUrl());
    }
    
    public function setTitle($title)
    {
        $this->title = $title;
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
    
    public function setPicUrl($picUrl)
    {
        $this->picUrl = $picUrl;
        
        return $this;
    }
    
    public function getPicUrl()
    {
        return $this->picUrl;
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
}
?>