<?php
/**
 * 演示如何使用WXLib\User\User
 */
require_once 'Vendor/autoload.php';

use WXlib\User\User;

var_dump(User::getOauthUrl('apid1', 'safa', 'scope1'));

?>