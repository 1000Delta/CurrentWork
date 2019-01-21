<?php

use GuzzleHttp\Client;

$url = '127.0.0.1:9200/<logstash-{now%2Fd-2d}>/_search>';


$client = new Client([
    'base_uri' => '127.0.0.1:9200',
    'time_out' => 5.0
]);
$response = $client->get('_cluster');
echo $response->getBody();