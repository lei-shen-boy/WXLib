<?php
/**
 * 分组管理接口
 *
 */
namespace WXlib\User;

use WXLib\Basic\Request;
use WXLib\Basic\RawBodyRequest;

class Groups
{
    
    /**
     * 查询分组
     * @return array
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
    public static function getList()
    {
        $request = new Request(array(
                'method' => 'GET',
                'url' => 'https://api.weixin.qq.com/cgi-bin/groups/get',
                
        ));

        return $request->send();
    }
    
    /**
     * 创建分组
     * @param string $groupName
     * @return array
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
    public static function create($groupName)
    {
        $apiOptions = array(
                'method' => 'POST',
                'url' => 'https://api.weixin.qq.com/cgi-bin/groups/create'
        );
        $rawBodyRequest = new RawBodyRequest($apiOptions);
        $groups = array(
                'group' => array(
                        'name' => $groupName
                )
        );
        $rawBodyRequest->setRawBody(json_encode($groups));
        
        return $rawBodyRequest->send();
    }
    
    /**
     * 修改分组名
     * @param int $groupId
     * @param string $newGroupName
     * @return array
array(2) {
  ["errcode"]=>
  int(0)
  ["errmsg"]=>
  string(2) "ok"
}
     */
    public static function update($groupId, $newGroupName)
    {
        $apiOptions = array(
                'method' => 'POST',
                'url' => 'https://api.weixin.qq.com/cgi-bin/groups/update'
        );
        $rawBodyRequest = new RawBodyRequest($apiOptions);
        $groups = array(
                'group' => array(
                        'id' => $groupId,
                        'name' => $newGroupName
                )
        );
        $rawBodyRequest->setRawBody(json_encode($groups));
        
        return $rawBodyRequest->send();
    }
    
    /**
     * 移动用户分组
     * @param string $openId
     * @param int $toGroupId
     * @return array
array(2) {
  ["errcode"]=>
  int(0)
  ["errmsg"]=>
  string(2) "ok"
}
     */
    public static function moveUser($openId, $toGroupId)
    {
        $apiOptions = array(
                'method' => 'POST',
                'url' => 'https://api.weixin.qq.com/cgi-bin/groups/members/update'
        );
        $rawBodyRequest = new RawBodyRequest($apiOptions);
        $groups = array(
                'openid' => $openId,
                'to_groupid' => $toGroupId
        );
        $rawBodyRequest->setRawBody(json_encode($groups));
        
        return $rawBodyRequest->send();
    }
}
?>