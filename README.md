WXLib
=====

微信公众平台开发包


环境要求
-----

PHP5.3及以上

Demo
-----
<a href="https://github.com/octans/WXLib/blob/master/demo.php">WXLib/Demo.php</a>,演示接收微信服务器的通知消息并发送响应消息



公共接口类WXLIb/Message/Message.php：

------------WXLIb/Message/Message.php, 公共接口类，所有和接收消息/响应消息有关的接口方法都封装在了里面,可以方便的使用

项目结构
-----
WXLib/Test, 此目录下存放开放中用到的测试文件，可以忽略掉

WXLib/Vendor/WXLib, 是sdk本身，对微信开放平台的接口进行了封装，可以作为类库使用

WXLib/Vendor/PEAR, 是PEAR中HTTP_Request2的实现代码，整个WXLib开发包在向微信服务器发起请求时都是使用的HTTP_Request2

WXLib/Vendor/autoload.php, 开发者在这里设置WXLib在具体项目中使用时的路径

WXLib/Vendor/ClassLoader.php, 控制的文件自动加载
