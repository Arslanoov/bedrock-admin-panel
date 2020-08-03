<?php

$key = file_get_contents('../web/.key');
$requestKey = $_GET['key'] ?? '';
if ($key === $requestKey) {
    echo system('chmod -R 777 /opt/mcpe-data/worlds');die;
}

http_response_code(403);
die('Access denied');