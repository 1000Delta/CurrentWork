<?php

use GuzzleHttp\Client;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use SE\SECore\SECore;

class ExampleTest extends TestCase
{

    public function testExample()
    {
//        echo env('ES_HOST')."\n";
//        $client = new Client(['base_uri' => SECore::get()->getNode()]);
//        $responseHealth = $client->request('GET', '/_cluster/health');
//        echo $responseHealth->getBody();
//        $data = json_decode($responseHealth->getBody(), true);
//        print_r($data);
        $monitor = new \SE\SEMonitor\SEMonitor();
        printf("%d\n", $monitor->getRecentTime());
        // 先刷新再休眠会导致两次输出的更新时间相同
        // 先休眠再刷新则不会
        // 原因是刷新速度过快。。。在同一秒内
        sleep(1);
        $monitor->refresh();
        echo $monitor->getRecentTime();

        $this->assertTrue(true);
    }
}
