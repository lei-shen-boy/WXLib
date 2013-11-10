<?php
/**
 * 演示接收微信服务器的通知消息并发送响应消息
 */
require_once 'Vendor/autoload.php';
use WXLib\Message\Message;
use WXLib\Constants;


// 模拟收到微信平台的消息
$message = '<xml>
 <ToUserName><![CDATA[toUser]]></ToUserName>
 <FromUserName><![CDATA[fromUser]]></FromUserName>
 <CreateTime>1348831860</CreateTime>
 <MsgType><![CDATA[text]]></MsgType>
 <Content><![CDATA[this is a test]]></Content>
 <MsgId>1234567890123456</MsgId>
 </xml>';

// 使用接口消息初始化WXLib\Message\Message实例
$received = new Message($message);

// 如果只想接受某类型的消息，比如只处理文本消息
if ($received->isText()) {
    // @todo
}

// 获取消息的每个字段的值
$toUser = $received->getToUser();
$fromUser = $received->getFromUser();
$createTime = $received->getCreateTime();
$msgType = $received->getMessageType();
$content = $received->getContent();
$msgId = $received->getMessageId();

// 使用Message提供的set方法来设置设置要响应的消息，推荐使用这种方式
$response = new Message();
$response->setToUser($toUser)
->setFromUser($fromUser)
->setToText() // 相当于->setMessageType(Message::TEXT_MESSAGE_TYPE_NAME)
->setContent('my response');

// 输出xml格式的文本
echo $response->toString();

// 或者在实例化Message时就设置好消息信息
$response = new Message(array(
        Constants::FROM_USER_NAME_FIELD => $fromUser,
        Constants::TO_USER_NAME_FIELD => $toUser,
        Constants::CREATE_TIME_FIELD => time(),
        Constants::TEXT_CONTENT_FIELD => Message::TEXT_MESSAGE_TYPE_NAME,
        Constants::CONTENT_FIELD => 'my response',
));
echo $response->toString();
?>