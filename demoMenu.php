<?php
/**
 * 演示如何使用WXLib\Message\Message来接收消息，发送响应消息
 */
require_once 'Vendor/autoload.php';

use WXLib\Menu\Menu;
use WXLib\Menu\Button;
use WXLib\Constants;

try {
	

$menu = new Menu();
$menu->addButton(array(
        'type' => 'click',
        'name' => '今日歌曲',
        'key' => 'V1001_TODAY_MUSIC'
));

$b1 = new Button();
$b1->setName('name1');
$b1->setKey('key1');
$b1->setType(Constants::MENU_CLICK_BUTTON_TYPE_NAME);
$menu->addButton($b1);

$b2 = new Button();
$b2->setName('name2');
$b2->setUrl('url2');
$b2->setType(Constants::MENU_VIEW_BUTTON_TYPE_NAME);
$menu->addButton($b2);

$button3Id = $menu->addButtonName('button3');
$b3_1 = new Button();
$b3_1->setName('name3_1');
$b3_1->setUrl('url3_1');
$b3_1->setType(Constants::MENU_VIEW_BUTTON_TYPE_NAME);
$menu->addSubButton($button3Id, $b3_1);



var_dump($menu->toArray());
} catch (Exception $e) {
    var_dump($e);
}
?>