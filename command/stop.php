<?php

$key = file_get_contents('../web/.key');
$requestKey = $_GET['key'] ?? '';
if ($key === $requestKey) {
    echo system('sudo docker container stop mcpe');die;
}

http_response_code(403);
die('Access denied');