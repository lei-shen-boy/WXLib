WXLib
=====

微信公众平台开发包


环境要求
-----

PHP5.3及以上


项目结构
-----
WXLib/Test, 此目录下存放开放中用到的测试文件，可以忽略掉

WXLib/Vendor/WXLib, 是sdk本身，对微信开放平台的接口进行了封装，可以作为类库使用

WXLib/Vendor/PEAR, 是PEAR中HTTP_Request2的实现代码，整个WXLib开发包在向微信服务器发起请求时都是使用的HTTP_Request2

WXLib/Vendor/autoload.php, 开发者在这里设置WXLib在具体项目中使用时的路径

WXLib/Vendor/ClassLoader.php, 控制的文件自动加载

下面介绍开发包WXlib/vendor/WXLib里的目录结构：

------------WXLib/Basic, 对获取access_token, 媒体上传和下载进行了封装

------------WXLIb/Message, 对接收/回复消息进行了封装,对发送客服消息进行了封装

------------WXLIb/Message/Message.php, 公共接口类，所有和接收消息/响应消息有关的接口方法都封装在了里面



使用示例：
<?php
require_once 'Vendor/autoload.php';
use WXLib\Message\Message;

// 接收到事件消息
$xml = '<xml>
<ToUserName><![CDATA[toUser]]></ToUserName>
<FromUserName><![CDATA[FromUser]]></FromUserName>
<CreateTime>123456789</CreateTime>
<MsgType><![CDATA[event]]></MsgType>
<Event><![CDATA[subscribe]]></Event>
</xml>';

// 实例化
$m = new Message($xml);

// 获取消息类型
$messageType = $m->getMessageType();

// 判段是否是时间类型
var_dump($m->isEvent());

// 构造一个响应消息
$response = new Message();
$response->setToUser($toUser)
         ->setFromUser($fromUser)
         ->setToText() // 相当于->setMessageType(Message::TEXT_MESSAGE_TYPE_NAME)
         ->setContent('my response');
echo $response->toString();

Demo
-----
<a href="https://github.com/octans/WXLib/blob/master/Demo.php">WXLib/Demo.php</a>,演示接收微信服务器的通知消息并发送响应消息
