<?php
$xml = '<xml>
<ToUserName><![CDATA[toUser]]></ToUserName>
<FromUserName><![CDATA[fromUser]]></FromUserName>
<CreateTime>1348831860</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[this is a test]]></Content>
<MsgId><bb>2</bb>1234567890123456<asd>1</asd></MsgId>
</xml>';
//$xmlr = new XMLReader();
//$xmlr->XML($xml);
//while ($xmlr->read()) {
//
//    echo $xmlr->prefix,'---',$xmlr->value;
//}
//$sp = simplexml_load_string($xml);
//var_dump($sp->children());
$sp = new SimpleXMLElement($xml, LIBXML_NOCDATA);
var_dump($sp);

