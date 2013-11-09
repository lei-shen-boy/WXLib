<?php
/**
 * 演示接收微信服务器的通知消息并发送响应消息
 */
require_once 'Vendor/autoload.php';
use WXLib\Message\Message;

/*
 * 模拟收到微信平台的接口消息
 */
$message = '<xml>
 <ToUserName><![CDATA[toUser]]></ToUserName>
 <FromUserName><![CDATA[fromUser]]></FromUserName>
 <CreateTime>1348831860</CreateTime>
 <MsgType><![CDATA[text]]></MsgType>
 <Content><![CDATA[this is a test]]></Content>
 <MsgId>1234567890123456</MsgId>
 </xml>';

/*
 * 使用接口消息初始化WXLib\Message\Message实例
 */
$received = new Message($message);

/*
 * 应用程序获取消息的每部分信息，并且处理自己的逻辑
 */
 $toUser = $received->getToUser();
 $fromUser = $received->getFromUser();
 $createTime = $received->getCreateTime();
 $msgType = $received->getMessageType();
 $content = $received->getContent();
 $msgId = $received->getMessageId();
 // @todo 应用程序自己的逻辑

/*
 * 设置要响应的消息
 */
// 将消息体作为数组实例化一个Message实例
/*
$response = new Message(array(
        'ToUserName' => $fromUser,
        'FromUserName' => $toUser,
        'CreateTime' => time(),
        'MsgType' => Message::TEXT_MESSAGE_TYPE_NAME,
        'Content' => 'my response',
));
echo $response->toString();
*/
 
// 或者使用Message提供的方法来设置消息体，推荐使用这种方式
$response = new Message();
$response->setToUser($toUser)
         ->setFromUser($fromUser)
         ->setMessageType(Message::TEXT_MESSAGE_TYPE_NAME)
         ->setContent('my response');
echo $response->toString();
?>