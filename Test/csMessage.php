<?php
require_once 'Vendor/autoload.php';
use WXLib\Message\CustomerService\TextCSMessage;
use WXLib\Message\CustomerService\ImageCSMessage;
use WXLib\Message\CustomerService\VoiceCSMessage;
use WXLib\Message\CustomerService\VideoCSMessage;
use WXLib\Constants;

$cs = new VideoCSMessage();
$cs->setToUser('okRh4jpfdctEli-p2VyJofM95v_Q');
$cs->setMessageType(Constants::VIDEO_MEDIA_ID_FIELD);
$cs->setMediaId('5khWmH1Oxed152sIDQZEKenkO3v6U1x6cqLQgIGi5Adf6OZT7REfzRb67TbcQaOS');
var_dump($cs->send());
exit;

$cs = new VoiceCSMessage();
$cs->setToUser('okRh4jpfdctEli-p2VyJofM95v_Q');
$cs->setMessageType(Constants::VOICE_MESSAGGE_TYPE_NAME);
$cs->setMediaId('5khWmH1Oxed152sIDQZEKenkO3v6U1x6cqLQgIGi5Adf6OZT7REfzRb67TbcQaOS');
var_dump($cs->send());
exit;

$cs = new ImageCSMessage();
$cs->setToUser('okRh4jpfdctEli-p2VyJofM95v_Q');
$cs->setMessageType(Constants::IMAGE_MESSAGE_TYPE_NAME);
$cs->setMediaId('UPWVF6sZlbR2amEUDXK5s-vROJq2snylMTKLhLpXpWwrIqtzGr-tyjJfSD7VlFZR');
var_dump($cs->send());
exit;


$cs = new TextCSMessage();
$cs->setToUser('okRh4jpfdctEli-p2VyJofM95v_Q');
$cs->setMessageType(Constants::TEXT_MESSAGE_TYPE_NAME);
$cs->setContent('my test from WXLib');
var_dump($cs->send());
?>