WXLib
=====

微信公众平台开发包

本开发包特点
-----
开发者不需要记微信接口里的任何字段，也不用担心某天某个接口的字段值发生改变后的代码维护，因为在本sdk里都进行了封装，接口方法的命名规则严格遵从了微信开放平台的接口文档，开发者在使用此sdk时，如果你的编辑器(zend studio, eclipse)支持代码提示功能,那么你就能快速定位到要你需要使用的接口方法！

<img src="http://fucklife.net/wp/wp-content/uploads/2013/11/3.jpg" />
#####
演示接收微信服务器的通知消息并发送响应消息:<br/>
<pre><code>
// 模拟收到微信平台的消息
$message = 'xmlString from weixin server';

// 使用接口消息初始化WXLib\Message\Message实例
$received = new Message($message);

// 如果只想接受某类型的消息，比如只处理文本消息
if ($received->isText()) {
    // @todo
}

// 使用Message提供的get方法获取消息的每个字段值
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
#####
演示发送客服图文消息:<br/>
<pre><code>
// 发送图文消息
$a = new Article();
$a->setTitle('title1')
  ->setDescription('des1')
  ->setUrl('url1')
  ->setPicUrl('picurl');
$cs = new CSMessage();
$cs->setToUser('tosuer')
   ->setToNews(); // 设置消息类型为图文
   ->addArticle($a);
   ->send();
</code></pre>
环境要求
-----

PHP5.3及以上

Demo
-----
<a href="https://github.com/octans/WXLib/blob/master/demo.php">WXLib/Demo.php</a>,演示接收微信服务器的通知消息并发送响应消息



公共接口类
-----
WXLib/Message/Message.php, 封装了和接收消息/响应消息有关的接口方法，该类会根据消息类型去实例化相应的class,所有细节部分对使用者都是透明的<br/>
WXLib/Message/CSMessage.php, 封装了和发送客服消息有关的接口方法，该类会根据消息类型去实例化相应的class,所有细节部分(获取token, 调用微信接口等)对使用者都是透明的<br/>
WXLib/User/Groups.php, 封装了管理用户分组的接口方法<br/>
WXLib/User/User.php, 封装了获取用户信息，获取关注列表，和oauth有关的接口

项目结构
-----
WXLib/Test, 此目录下存放开放中用到的测试文件，可以忽略掉<br/>
WXLib/Vendor/WXLib, 是sdk本身，对微信开放平台的接口进行了封装，可以作为类库使用<br/>
WXLib/Vendor/PEAR, 是PEAR中HTTP_Request2的实现代码，整个WXLib开发包在向微信服务器发起请求时都是使用的HTTP_Request2<br/>
WXLib/Vendor/autoload.php, 开发者在这里设置WXLib在具体项目中使用时的路径<br/>
WXLib/Vendor/ClassLoader.php, 控制的文件自动加载<br/>
