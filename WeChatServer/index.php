<?php
require '../MyClass/WeChatServe.php';
require '../MyClass/Database/DBC.php';


$token = 'weixin';    //接入token

$server = new MyClass\WeChatServe($token);

if (isset($_GET['echostr'])) {

    $server->portal();

} else {

    $server->processMsg(file_get_contents("php://input"));
}


