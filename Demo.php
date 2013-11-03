<?php 
require_once('./include.php');

/*
 * 解析接收到的消息到对象$messageInstance
 */

// 模拟测试用，真实环境使用$message = $GLOBALS["HTTP_RAW_POST_DATA"];
$message = '<xml>
 <ToUserName><![CDATA[toUser]]></ToUserName>
 <FromUserName><![CDATA[fromUser]]></FromUserName> 
 <CreateTime>1348831860</CreateTime>
 <MsgType><![CDATA[text]]></MsgType>
 <Content><![CDATA[this is a test]]></Content>
 <MsgId>1234567890123456</MsgId>
 </xml>';
$messageInstance = WXMessageManager::createMessageInstance($message);

/*
 * 做程序自己的逻辑，通过对象$messageInstance获取到消息的各个元素值
 */
$messageType = $messageInstance->getMessageType();
$toUser = $messageInstance->getToUser();
$responseToUser = 'toUser1';
$responseFromUser = 'fromUser1';
$responseMsgType = 'text';
$responseContent = 'content1';

/*
 * 程序完成自己的逻辑后，构建要回复的消息
 */
$responseArray = array(
	'ToUserName' => $responseToUser,
    'FromUserName' => $responseFromUser,
    'MsgType' => $responseMsgType,
    'Content' => $responseContent,
);
$messageInstance = WXMessageManager::createMessageInstance($responseArray);
$responseStr = $messageInstance->toString();
var_dump($responseStr);
exit;

?>