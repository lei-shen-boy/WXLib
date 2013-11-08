<?php
/**
 * 发送客服消息
 * @author huichaozh
 *
 */
namespace WXLib\Message\CustomerService;

interface AbstractCSMessageInterface
{
    public function setToUser($user);
    
    public function getToUser();
    
    public function setMessageType($messageType);
    
    public function getMessageType();
    
    public function toString();
}
?>