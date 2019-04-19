<?php

use GuzzleHttp\Client;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use SE\SECore;
use SE\SEQuery\SEData;
use SE\SEQuery\SEQuery;

class TmpTest extends TestCase
{

    public function testExample()
    {
        
        // $queryMap = SEData\SEDataLink::getSearchMap('我');
        $query = new SEQuery('link', 'webPage');
        $res = $query->search(5, '我');
        print_r($res);
        self::assertTrue(true);
    }
}
