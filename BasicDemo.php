<?php 
require_once 'Basic/Basic.php';

try {
    $accessToken = Basic::getAccessToken();
    echo $accessToken;
    
} catch (HTTP_Request2_Exception $e) {
	echo 'Error: ' . $e->getMessage();
}
?>