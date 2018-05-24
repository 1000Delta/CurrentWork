<?php

if (isset($_GET['echostr'])) {

    $token = 'weixin';    //接入token
    $info = [$_GET['nonce'], $_GET['timestamp'], $token];
    $echostr = $_GET['echostr'];

    sort($info, SORT_STRING);
    $hashcode = sha1(implode($info));

    if ($hashcode === $_GET['signature']) {

        echo $echostr;
        exit;
    }
} else {

    $rawData = file_get_contents("php://input");
    if($rawData != '') {

        $data = new SimpleXMLElement($rawData, LIBXML_NOCDATA);
        $getMsgType = $data->MsgType;
        if (strtolower($getMsgType) === 'text') {

            $getUserName = $data->FromUserName;
            $getMyName = $data->ToUserName;
            $getCreateTime = $data->CreateTime;
            $getContent = $data->Content;
            $getMsgId = $data->MsgId;
            $msgType = 'text';
            $timeStamp = time();
            $str = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[%s]]></MsgType>
                    <Content><![CDATA[内容是\"%s\"，时间是\"%s\"]]></Content>
                    </xml>";

            echo sprintf($str, $getUserName, $getMyName, $timeStamp, $msgType, $getContent, $getCreateTime);
            exit;
        } else {

            echo "";
        }
    }

}


