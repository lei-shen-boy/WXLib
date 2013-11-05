<?php
/**
 * 回复图文消息
 */
require_once 'AbstractCommonMessage.php';
require_once 'Article.php';

class NewsCommonMessage extends AbstractCommonMessage
{
    /**
     * 图文消息个数，限制为10条以内
     */
    protected $articleCount = 0;
    
    /**
     * 多条图文消息信息，默认第一个item为大图
     */
    protected $articles = array();
    
    protected function setArticleCount($articleCount)
    {
        $this->articleCount = $articleCount;
    }
    
    protected function getArticleCount()
    {
        return $this->articleCount;
    }
    
    public function addArticle($article)
    {
        $this->articles[] = new Article($article);
        $this->articleCount += 1;
    }
    
    public function toString()
    {
        $tpl = parent::toString();
        $return = sprintf($tpl, $this->getMyXmlPart());
        return $return;
    }
    
    protected function getMyXmlPart()
    {
        $articlesXml = '';
        foreach ($this->articles as $article) {
            $articlesXml .= '<item>' . $article->toString() . '</item>';
        }
        
        $xmlTpl = '<ArticleCount>%s</ArticleCount>
<Articles>
%s
</Articles>';
        
        $return = sprintf($xmlTpl, $this->getArticleCount(), $articlesXml);
        return $return;
        
    }
}
?>