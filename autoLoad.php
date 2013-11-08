<?php 
function __autoload($class)
{
    if ($class == 'WXLib\Basic\HTTP_Request2') {
        require_once 'Vendor/PEAR/HTTP/Request2.php';
    } else {
    require_once $class.'.php';
        
    }
}
?>