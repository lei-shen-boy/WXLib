<?php
/**
 * 演示如何使用WXLib\User\Groups
 */
require_once 'Vendor/autoload.php';

use WXlib\User\Groups;

/**
 * 查询分组列表
 */
$groupList = Groups::getList();
var_dump($groupList);
/*
 * 输出：
array(1) {
  ["groups"]=>
  array(3) {
    [0]=>
    array(3) {
      ["id"]=>
      int(0)
      ["name"]=>
      string(9) "未分组"
      ["count"]=>
      int(69)
    }
    [1]=>
    array(3) {
      ["id"]=>
      int(1)
      ["name"]=>
      string(9) "黑名单"
      ["count"]=>
      int(0)
    }
    [2]=>
    array(3) {
      ["id"]=>
      int(2)
      ["name"]=>
      string(9) "星标组"
      ["count"]=>
      int(0)
    }
  }
} 
 */

/**
 * 创建分组，分组名称为'groupName'
 */
$res = Groups::create('groupName');
var_dump($res);
/*
 * 输出：
array(1) {
  ["group"]=>
  array(2) {
    ["id"]=>
    int(100)
    ["name"]=>
    string(4) "test"
  }
}
 */

/**
 * 修改分组名,将id为100的分组名成改为'newGroupName'
 */
$res = Groups::update(100, 'newGroupName');
var_dump($res);
/*
 * 输出：
array(2) {
  ["errcode"]=>
  int(0)
  ["errmsg"]=>
  string(2) "ok"
}
 */

/**
 * 移动用户分组,将openId为'dfsasdfas'的用户移到分组id为100的分组
 */
$res = Groups::moveUser('dfsasdfas', 100);
var_dump($res);
/*
 * 输出：
array(2) {
  ["errcode"]=>
  int(0)
  ["errmsg"]=>
  string(2) "ok"
} 
 */
?>