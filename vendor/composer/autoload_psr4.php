<?php
$vendorDir = dirname(__DIR__);
$baseDir = dirname($vendorDir);

return array(
    'Firebase\\JWT\\' => array($vendorDir . '/firebase/php-jwt/src'),
    'App\\' => array($baseDir . '/src'),
);
