WXLib
=====

微信公众平台开发包

本开发包特点
-----
开发者不需要记微信接口里的任何字段，也不用担心某天某个接口的字段值发生改变后的代码维护，因为在本adk里都进行了封装，接口方法的命名规则严格遵从了微信开放平台的接口文档，开发者在使用此sdk时，如果你的编辑器(zend studio, eclipse)支持代码提示功能,那么你就能快速定位到要你需要使用的接口方法！
<img src="http://fucklife.net/wp/wp-content/uploads/2013/11/3.jpg" />
<pre><code>   // 模拟收到微信平台的消息
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
</code></pre>
环境要求
-----

PHP5.3及以上

Demo
-----
<a href="https://github.com/octans/WXLib/blob/master/demo.php">WXLib/Demo.php</a>,演示接收微信服务器的通知消息并发送响应消息



公共接口类WXLIb/Message/Message.php：

-----WXLIb/Message/Message.php, 公共接口类，所有和接收消息/响应消息有关的接口方法都封装在了里面,可以方便的使用

项目结构
-----
WXLib/Test, 此目录下存放开放中用到的测试文件，可以忽略掉

WXLib/Vendor/WXLib, 是sdk本身，对微信开放平台的接口进行了封装，可以作为类库使用

WXLib/Vendor/PEAR, 是PEAR中HTTP_Request2的实现代码，整个WXLib开发包在向微信服务器发起请求时都是使用的HTTP_Request2

WXLib/Vendor/autoload.php, 开发者在这里设置WXLib在具体项目中使用时的路径

WXLib/Vendor/ClassLoader.php, 控制的文件自动加载
