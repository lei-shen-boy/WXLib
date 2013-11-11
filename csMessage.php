<?php
/**
 * 演示如何使用WXLib\Message\CSMessage
 */
require_once 'Vendor/autoload.php';

use WXLib\Message\CSMessage;
use WXLib\Constants;

$cs = new CSMessage();
$cs->setToUser('okRh4jpfdctEli-p2VyJofM95v_Q');
$cs->setMessageType(Constants::CS_TEXT_FIELD);
$cs->setContent('my test from WXLib');
var_dump($cs->send());














?>