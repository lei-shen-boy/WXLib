<?php
require_once 'ClassLoader.php';

$vendorDir = dirname(__FILE__);
$baseDir = dirname($vendorDir);

$nameSpacePaths = array(
        'WXLib' => $vendorDir,
);
$classLoader = new ClassLoader();
foreach ($nameSpacePaths as $prefix => $path) {
    $classLoader->add($prefix, $path);
}
$classLoader->register();

$includePaths = array(
        $vendorDir . DIRECTORY_SEPARATOR . 'PEAR',
);
set_include_path(get_include_path() . PATH_SEPARATOR . implode(PATH_SEPARATOR, $includePaths));


?>