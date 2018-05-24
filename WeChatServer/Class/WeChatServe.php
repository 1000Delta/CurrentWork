<?php
/**
 * Created by PhpStorm.
 * User: 13975
 * Date: 2018/5/24
 * Time: 18:24
 */
require_once "../class/DBC.php";

class WeChatServe
{

    private $token;

    public function __construct(string $token) {

        $this->token = $token;
    }

    public function portal()
    {

        $info = [$_GET['nonce'], $_GET['timestamp'], $this->token];
        $echostr = $_GET['echostr'];

        sort($info, SORT_STRING);
        $hashcode = sha1(implode($info));

        if ($hashcode === $_GET['signature']) {

            echo $echostr;
            exit;
        }
    }

    public function processMsg(string $rawData) {

        $data = simplexml_load_string($rawData);
        $server = $data->ToUserName;
        $user = $data->FromUserName;
        $createTime = $data->CreateTime;
        $msgtype = $data->Msgtype;
        $msgId = $data->MsgId;


        return '';
    }

    private function replyMsg(string $msgType) { //回复信息，调用内部方法

        return;
    }

    private function replyText(string $data) { //回复图文消息


    }

    private function replyImage(string $data) { //回复图片消息

    }

    private function replyVoice(string $data) { //回复语音消息

    }

    private function replyVideo(string $data) { //回复视频消息

    }

    private function replyMusic(string $data) { //回复音乐消息

    }

    private function replyNews(string $data) { //回复图文消息

    }
}