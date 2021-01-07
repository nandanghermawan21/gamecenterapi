<?php
require("../vendor/autoload.php");
$openapi = \OpenApi\scan('../application/controllers');
header('Content-Type: application/x-json');
echo $openapi->toJSON();
