<?php 
require_once 'Message/TextCommonMessage.php';
require_once 'Message/NewsCommonMessage.php';
require_once 'Message/Article.php';
require_once 'Basic/AccessTokenRequest.php';
require_once 'Basic/MediaUploadRequest.php';
require_once 'Basic/MediaDownloadRequest.php';
require_once 'Message/TextCSMessage.php';
require_once 'Message/ImageCSMessage.php';
require_once 'Message/VoiceCSMessage.php';
require_once 'Message/VideoCSMessage.php';
require_once 'Message/MusicCSMessage.php';
require_once 'Message/NewsCSMessage.php';

try {
    $m = new NewsCSMessage();
    $a = new Article();
    $a->setTitle('title1');
    $a->setDescription('des1');
    $a->setUrl('url1');
    $a->setPicUrl('picurl');
    $m->addArticle($a);
    $m->addArticle('<xml><Title><![CDATA[title1]]></Title> 
<Description><![CDATA[description1]]></Description>
<PicUrl><![CDATA[picurl]]></PicUrl>
<Url><![CDATA[url]]></Url></xml> ');
    var_dump($m->toString());
    var_dump($m->send());
    exit;
    
    
    
    
    
    
    
    
    
    
    
    $m = new MusicCSMessage();
    $m->setToUser('abc');
    $m->setTitle('title1');
    $m->setDescription('description1');
    $m->setMusicUrl('musicurl1');
    $m->setHQMusicUrl('hqmusicurl');
    $m->setThumbMediaId('thumbmeidid');
    var_dump($m->toString());
    var_dump($m->send());
    exit;
    
    $m = new VideoCSMessage();
    $m->setToUser('abc');
    $m->setMediaId('12345');
    $m->setThumbMediaId('dfas');
    var_dump($m->toString());
    var_dump($m->send());
    exit;
    /*
    $m = new VoiceCSMessage();
    $m->setToUser('abc');
    $m->setMediaId('12345');
    var_dump($m->toString());
    var_dump($m->send());
    */
    $m = new ImageCSMessage();
    $m->setToUser('abc');
    $m->setMediaId('12345');
    var_dump($m->toString());
    var_dump($m->send());
    exit;
    $tcsm = new TextCSMessage();
    $tcsm->setToUser('OPENID');
    $tcsm->setContent('Hello World');
    var_dump($tcsm->toString());
    exit;    
    
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