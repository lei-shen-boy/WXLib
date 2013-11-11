<?php 
require_once '../Vendor/autoload.php';

use WXLib\Message\Article;
use WXLib\Message\CustomerService\NewsCSMessage;
use WXLib\Message\CustomerService\MusicCSMessage;
use WXLib\Message\CustomerService\VoiceCSMessage;
use WXLib\Message\CustomerService\VideoCSMessage;
use WXLib\Message\CustomerService\ImageCSMessage;
use WXLib\Message\CustomerService\TextCSMessage;

use WXLib\Message\Common\TextCommonMessage;
use WXLib\Message\Common\ImageCommonMessage;
use WXLib\Message\Common\MusicCommonMessage;
use WXLib\Message\Common\VideoCommonMessage;
use WXLib\Message\Common\VoiceCommonMessage;
use WXLib\Message\Common\LinkCommonMessage;
use WXLib\Message\Common\LocationCommonMessage;
use WXLib\Message\Common\NewsCommonMessage;

use WXLib\Message\Event\ScanQREventMessage;

use WXLib\Basic\Token\AccessToken;
use WXLib\Basic\Media\MediaUploadRequest;

try {
    
    $m = new MediaUploadRequest('voice', '../data/test.mp3');
    var_dump($m->upload());
    exit;
    
    $m = new MediaUploadRequest('image', '../data/test.jpg');
    var_dump($m->upload());
    exit;
    
    $t = new AccessToken();
    var_dump($t->get());
    
    
    $m = new ScanQREventMessage('<xml><ToUserName><![CDATA[toUser]]></ToUserName>
<FromUserName><![CDATA[FromUser]]></FromUserName>
<CreateTime>123456789</CreateTime>
<MsgType><![CDATA[event]]></MsgType>
<Event><![CDATA[subscribe]]></Event>
<EventKey><![CDATA[qrscene_123123]]></EventKey>
<Ticket><![CDATA[TICKET]]></Ticket>
</xml>');
    var_dump($m->toString());
    
    $m = new TextCommonMessage('<xml>
 <ToUserName><![CDATA[toUser]]></ToUserName>
 <FromUserName><![CDATA[fromUser]]></FromUserName> 
 <CreateTime>1348831860</CreateTime>
 <MsgType><![CDATA[text]]></MsgType>
 <Content><![CDATA[this is a test]]></Content>
 <MsgId>1234567890123456</MsgId>
 </xml>');
    var_dump($m->toString());
    
    $m = new ImageCommonMessage('<xml>
 <ToUserName><![CDATA[toUser]]></ToUserName>
 <FromUserName><![CDATA[fromUser]]></FromUserName>
 <CreateTime>1348831860</CreateTime>
 <MsgType><![CDATA[image]]></MsgType>
 <PicUrl><![CDATA[this is a url]]></PicUrl>
 <MediaId><![CDATA[media_id]]></MediaId>
 <MsgId>1234567890123456</MsgId>
 </xml>');
    var_dump($m->toString());
    
    $m = new VoiceCommonMessage('<xml>
<ToUserName><![CDATA[toUser]]></ToUserName>
<FromUserName><![CDATA[fromUser]]></FromUserName>
<CreateTime>1357290913</CreateTime>
<MsgType><![CDATA[voice]]></MsgType>
<MediaId><![CDATA[media_id]]></MediaId>
<Format><![CDATA[Format]]></Format>
<MsgId>1234567890123456</MsgId>
</xml>');
    var_dump($m->toString());
    
    $m = new LocationCommonMessage('<xml>
<ToUserName><![CDATA[toUser]]></ToUserName>
<FromUserName><![CDATA[fromUser]]></FromUserName>
<CreateTime>1351776360</CreateTime>
<MsgType><![CDATA[location]]></MsgType>
<Location_X>23.134521</Location_X>
<Location_Y>113.358803</Location_Y>
<Scale>20</Scale>
<Label><![CDATA[位置信息]]></Label>
<MsgId>1234567890123456</MsgId>
</xml>');
    var_dump($m->toString());
    
    
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
    //var_dump($m->send());
    
    $m = new MusicCSMessage();
    $m->setToUser('abc');
    $m->setTitle('title1');
    $m->setDescription('description1');
    $m->setMusicUrl('musicurl1');
    $m->setHQMusicUrl('hqmusicurl');
    $m->setThumbMediaId('thumbmeidid');
    var_dump($m->toString());
    //var_dump($m->send());
    
    $m = new VideoCSMessage();
    $m->setToUser('abc');
    $m->setMediaId('12345');
    $m->setThumbMediaId('dfas');
    var_dump($m->toString());
    //var_dump($m->send());

    $m = new VoiceCSMessage();
    $m->setToUser('abc');
    $m->setMediaId('12345');
    var_dump($m->toString());
    //var_dump($m->send());

    $m = new ImageCSMessage();
    $m->setToUser('abc');
    $m->setMediaId('12345');
    var_dump($m->toString());
    //var_dump($m->send());

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