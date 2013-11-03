<?php
class WXMessageManager
{
    protected $messageInstance;
    
    public static function createMessageInstance($message = null)
    {
        if (is_string($message)) {
            $message = (array)simplexml_load_string($message, 'SimpleXMLElement', LIBXML_NOCDATA);
        } elseif ($message !== null && !is_array($message)) {
            throw new Exception(sprintf(
                    'Expecting a string or array, received "%s"',
                    (is_object($message) ? get_class($message) : gettype($message))
            ));
        }
        
        switch ($message['MsgType']) {
        	case 'text':
        	    return new WXTextPassiveMessage($message);
        	    break;
        	case 'image':
        	    return new WXImagePassiveMessage($message);
        	    break;
        }
    }
    
}
?>