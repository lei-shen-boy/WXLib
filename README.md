WXLib
=====

微信公众平台开发包

本开发包特点
-----
开发者不需要记微信接口里的任何字段，也不用担心某天某个接口的字段值发生改变后的代码维护，因为在本adk里都进行了封装，

接口方法的命名规则严格遵从了微信开放平台的接口文档，开发者在使用此sdk时，如果你的编辑器(zend studio, eclipse)支持代码提示功能,

那么你就能快速定位到要你需要使用的接口方法！



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
