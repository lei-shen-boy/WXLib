<?php 
require_once 'Vendor/PEAR/HTTP/Request2.php';

try {
	// Explicitly set request method and use_brackets
$request = new HTTP_Request2('http://pear.php.net/bugs/search.php',
                             HTTP_Request2::METHOD_GET, array('use_brackets' => true));
$request->setConfig(array(
        'proxy_host'        => 'web-proxy.oa.com',
        'proxy_port'        => 8080,
));
$url = $request->getUrl();
$url->setQueryVariables(array(
    'package_name' => array('HTTP_Request2', 'Net_URL2'),
    'status'       => 'Open'
));
$url->setQueryVariable('cmd', 'display');

// This will output a page with open bugs for Net_URL2 and HTTP_Request2
$response = $request->send();

$requestRaw = $request->getHeaders();
$body = $response->getBody();
} catch (HTTP_Request2_Exception $e) {
	echo 'Error: ' . $e->getMessage();
}
?>