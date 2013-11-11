<?php
/**
 * 演示如何使用WXLib\Message\Message来接收消息，发送响应消息
 */
require_once 'Vendor/autoload.php';

use WXLib\Message\Message;
use WXLib\Message\Article;

// 接收关注事件消息
$xml = '<xml>
<ToUserName><![CDATA[toUser]]></ToUserName>
<FromUserName><![CDATA[arthur]]></FromUserName>
<CreateTime>123456789</CreateTime>
<MsgType><![CDATA[event]]></MsgType>
<Event><![CDATA[subscribe]]></Event>
</xml>';
$m = new Message($xml);
var_dump($m->getFromUser());
var_dump($m->getMessageType());
var_dump($m->isEvent()); // 判断是否是事件消息
var_dump($m->isSubEvent()); // 判断是否是关注事件消息
/* 
 * 输出：
string(6) "arthur"
string(5) "event"
bool(true)
bool(true)
 */

// 接收扫描后关注事件消息
$xml = '<xml><ToUserName><![CDATA[toUser]]></ToUserName>
<FromUserName><![CDATA[FromUser]]></FromUserName>
<CreateTime>123456789</CreateTime>
<MsgType><![CDATA[event]]></MsgType>
<Event><![CDATA[subscribe]]></Event>
<EventKey><![CDATA[qrscene_123123]]></EventKey>
<Ticket><![CDATA[TICKET]]></Ticket>
</xml>';
$m = new Message($xml);
var_dump($m->isScanSubEvent()); // 判断是否是扫描后关注事件
var_dump($m->getEventKey());
/*
 * 输出
bool(true)
string(14) "qrscene_123123"
 */

// 接收位置事件消息
$xml = '<xml>
<ToUserName><![CDATA[toUser]]></ToUserName>
<FromUserName><![CDATA[fromUser]]></FromUserName>
<CreateTime>123456789</CreateTime>
<MsgType><![CDATA[event]]></MsgType>
<Event><![CDATA[LOCATION]]></Event>
<Latitude>23.137466</Latitude>
<Longitude>113.352425</Longitude>
<Precision>119.385040</Precision>
</xml>';
$m = new Message($xml);
var_dump($m->getLatitude());
var_dump($m->getLongitude());
var_dump($m->isLocationEvent());
/*
 * 输出：
string(9) "23.137466"
string(10) "113.352425"
bool(true)
 */

// 置回复图片消息
$m = new Message();
$m->setToUser('touser1')
  ->setFromUser('fromusr1')
  ->setCreateTime(time())
  ->setToImage()
  ->setMediaId('mediaid1');
var_dump($m->toString());
/*
 * 输出：
string(237) "<xml>
<ToUserName><![CDATA[touser1]]></ToUserName>
<FromUserName><![CDATA[fromusr1]]></FromUserName>
<CreateTime>1384179647</CreateTime>
<MsgType><![CDATA[image]]></MsgType>
<Image>
<MediaId><![CDATA[mediaid1]]></MediaId>
</Image>
</xml>"
 */

// 回复图文消息
$a = new Article();
$a->setTitle('title1')
  ->setDescription('description1')
  ->setPicUrl('picurl')
  ->setUrl('url');
$m = new Message();
$m->setToUser('touser1')
  ->setFromUser('fromusr1')
  ->setCreateTime(time())
  ->setToNews()
  ->addArticle($a);
var_dump($m->toString());
/*
 * 输出：
string(395) "<xml>
<ToUserName><![CDATA[touser1]]></ToUserName>
<FromUserName><![CDATA[fromusr1]]></FromUserName>
<CreateTime>1384180547</CreateTime>
<MsgType><![CDATA[news]]></MsgType>
<ArticleCount>1</ArticleCount>
<Articles>
<item><Title><![CDATA[title1]]></Title>
<Description><![CDATA[description1]]></Description>
<PicUrl><![CDATA[picurl]]></PicUrl>
<Url><![CDATA[url]]></Url></item>
</Articles>
</xml>"
 */

?>