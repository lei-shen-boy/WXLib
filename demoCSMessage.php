<?php
/**
 * 演示如何使用WXLib\Message\CSMessage
 */
require_once 'Vendor/autoload.php';

use WXLib\Message\CSMessage;
use WXLib\Constants;
use WXLib\Message\Article;

// 发送图文消息
$cs = new CSMessage();
$cs->setToUser('tosuer')
   ->setToNews();
$a = new Article();
$a->setTitle('title1')
  ->setDescription('des1')
  ->setUrl('url1')
  ->setPicUrl('picurl');
$cs->addArticle($a);
var_dump($cs->toString());
var_dump($cs->send());
//var_dump($cs->send());
/*
 * 输出：
string(129) "{"touser":"tosuer","msgtype":"news","news":{"articles":[{"title":"title1","description":"des1","url":"url1","picurl":"picurl"}]}}"
  array(2) {
  ["errcode"]=>
  int(0)
  ["errmsg"]=>
  string(2) "ok"
 */


// 发送音乐消息
$cs = new CSMessage();
$cs->setToUser('okRh4jpfdctEli-p2VyJofM95v_Q');
$cs->setMessageType(Constants::CS_MUSIC_MESSAGGE_TYPE_NAME);
$cs->setTitle('title1');
$cs->setDescription('description');
$cs->setMusicUrl('musicurl');
$cs->setHQMusicUrl('hqmusicurl');
$cs->setThumbMediaId('fsadf');
var_dump($cs->toString());
var_dump($cs->send());
/*
 * 输出：
string(187) "{"touser":"okRh4jpfdctEli-p2VyJofM95v_Q","msgtype":"music","music":{"title":"title1","description":"description","musicurl":"musicurl","hqmusicurl":"hqmusicurl","thumb_media_id":"fsadf"}}"
  array(2) {
  ["errcode"]=>
  int(0)
  ["errmsg"]=>
  string(2) "ok"
 */
?>