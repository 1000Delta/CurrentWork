<?php

use GuzzleHttp\Client;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use SE\SECore\SECore;
use SE\SEQuery\SEData\SEDataLink;

class TmpTest extends TestCase
{

    public function testExample()
    {
        
        $query = new \SE\SEQuery\SEQuery('link1', '123');
        assertTrue(true);
    }
}
