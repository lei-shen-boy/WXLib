<?php
/**
 * 发送新闻客服消息
 * @author huichaozh
 *
 */
require_once 'AbstractMediaCSMessage.php';
require_once 'Article.php';

class NewsCSMessage extends AbstractCSMessage
{
    const MESSAGE_TYPE = 'news';
    const ARTICLES_FIELD_NAME = 'articles';
    
    protected $articles = array();
    
    public function __construct($message = null, $accessToken = null)
    {
        $this->setMessageType(self::MESSAGE_TYPE);
        parent::__construct($message = null, $accessToken = null);
    }
    
    public function initFieldNames()
    {
        parent::initFieldNames();
        array_push($this->fieldNames, $this->getMessageType());
    }
    
    public function addArticle($article)
    {
        if ($article instanceof Article) {
            $this->articles[] = $article->toArray();
        } else {
            $this->articles[] = (new Article($article))->toArray();
        }
    }
    
    public function setDetailOptions()
    {
        $this->setOption($this->getMessageType(), array(
                self::ARTICLES_FIELD_NAME => $this->articles
        ));
    }
}
?>
