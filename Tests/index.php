<?php
include __DIR__ . '/../vendor/autoload.php';

use \Danidoble\GF\Dd as dd;

echo json_encode(dateFormats());

//echo json_encode(dd::dateFormats());

var_dump(dd::recursiveScanDir(__DIR__.'/../'));