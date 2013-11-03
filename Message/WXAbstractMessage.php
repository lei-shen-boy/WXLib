<?php 
abstract class WXAbstractMessage
{
    /**
     * To use field
     * @var string
     */
    protected $toUser = '';
    
    /**
     * Message Type
     * @var string
     */
    protected $messageType = '';
    
    public function setToUser($user)
    {
        $this->toUser = $user;
        
        return $this;
    }
    
    public function setMessageType($messageType)
    {
        $this->messageType = $messageType;
        
        return $this;
    }
    
    public function getToUser() 
    {
        return $this->toUser;
    }
    
    public function getMessageType()
    {
        return $this->messageType;
    }
}
?>