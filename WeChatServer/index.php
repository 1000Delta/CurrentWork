<?php
require '../CodeLib/MyClass/WeChat/WeChatServe.php';
require '../CodeLib/MyClass/Database/DBC.php';


$token = 'weixin';    //接入token

$server = new MyClass\WeChat\WeChatServe($token);

if (isset($_GET['echostr'])) {

    $server->portal();

} else {

    $server->processMsg(file_get_contents("php://input"));
}


