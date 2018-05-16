<?php

if (isset($_POST['signature']) &&
    isset($_POST['timestamp']) &&
    isset($_POST['nonce']) &&
    isset($_POST['echostr'])) {

    $token = '';    //输入token
    $info = [$_POST['nonce'], $_POST['timestamp'], $token];
    $echostr = $_POST['echostr'];

    sort($info, SORT_STRING);
    $hashcode = sha1($info[0].$info[1].$info[2]);

    if ($hashcode === $_POST['signature']) return $echostr;
}

return '';