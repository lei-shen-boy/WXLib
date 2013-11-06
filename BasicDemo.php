<?php 
require_once 'Basic/Basic.php';
require_once 'Message/TextCommonMessage.php';
require_once 'Message/NewsCommonMessage.php';
require_once 'Message/Article.php';
require_once 'Basic/AccessTokenRequest.php';
require_once 'Basic/MediaUploadRequest.php';
require_once 'Basic/MediaDownloadRequest.php';

try {
    $mediaId = '8oochr_tuLm6rx_n-gsMKejTfwyHNjY704vrRJRvDBs9dpbLdb-1XBlei7Bm83Xo';
    
    $media = new MediaDownloadRequest($mediaId);
    $res  = $media->download('data/test.jpg');
    var_dump($res);
    exit;
    
    
    
    
    
    
    $token = new AccessTokenRequest();
    var_dump($token->send());
    exit;
    
    $news = new NewsCommonMessage(array(
            'ToUserName' => 'ToUserName1',
            'FromUserName' => 'FromUserName1',
            'CreateTime' => 'CreateTime1',
            'MsgType' => 'news',
    ));
    $news->addArticle('<xml><Title><![CDATA[title1]]></Title> 
<Description><![CDATA[description1]]></Description>
<PicUrl><![CDATA[picurl]]></PicUrl>
<Url><![CDATA[url]]></Url></xml> ');
    var_dump($news->toString());
    exit;
    
    
    /*
    $accessToken = Basic::getAccessToken();
    echo $accessToken;
    */
    
    /*
    Basic::uploadImage('Data/image.jpg');
    */
    
    /*
    Basic::getMediaUrl('Wyc9LgEDPGwpAFtLpmg2slG_fSyVElddk3q9n6GtzpsDNYTbB92nxVVsDecysoGo');
    */
    
    $message = ' <xml>
 <ToUserName><![CDATA[toUser]]></ToUserName>
 <FromUserName><![CDATA[fromUser]]></FromUserName> 
 <CreateTime>1348831860</CreateTime>
 <MsgType><![CDATA[text]]></MsgType>
 <Content><![CDATA[this is a test]]></Content>
 <MsgId>1234567890123456</MsgId>
 </xml>';
    $messageObj = new TextCommonMessage($message);
    var_dump($messageObj);
    var_dump($messageObj->toString());
} catch (HTTP_Request2_Exception $e) {
	echo 'Error: ' . $e->getMessage();
}
?>