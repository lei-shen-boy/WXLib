<?php 
require_once 'Basic/Basic.php';

try {
    /*
    $accessToken = Basic::getAccessToken();
    echo $accessToken;
    */
    
    /*
    Basic::uploadImage('Data/image.jpg');
    */
    
    Basic::getMedia('Wyc9LgEDPGwpAFtLpmg2slG_fSyVElddk3q9n6GtzpsDNYTbB92nxVVsDecysoGo');
    
} catch (HTTP_Request2_Exception $e) {
	echo 'Error: ' . $e->getMessage();
}
?>