<?php

require '../CodeLib/URL/URLBuilder.php';

$multiSMS = new MyClass\URL\URLProcessor('https://sms.yunpian.com/v2/sms/multi_send.json');

$data = [

    'apikey' => '',
    'mobile' => '',
    'text' => '',
];

$login = new MyClass\URL\URLProcessor('http://baidu.com');
print_r($login->exec());

