<?php

if (isset($_GET['signature']) &&
    isset($_GET['timestamp']) &&
    isset($_GET['nonce']) &&
    isset($_GET['echostr'])) {

    $token = '';    //接入token
    $info = [$_GET['nonce'], $_GET['timestamp'], $token];
    $echostr = $_GET['echostr'];

    sort($info, SORT_STRING);
    $hashcode = sha1(implode($info));

    if ($hashcode === $_GET['signature']) {

        echo $echostr;
        exit;
    }
}

echo '';