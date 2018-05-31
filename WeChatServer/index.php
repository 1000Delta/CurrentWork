<?php
require "class/DBC.php";
require "class/WeChatServe.php";


$token = 'weixin';    //接入token

$server = new WeChatServe($token);

if (isset($_GET['echostr'])) {

    $server->portal();

} else {

    $server->processMsg(file_get_contents("php://input"));
}


