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
       $client = new Client([
           'base_uri' => 'http://127.0.0.1:80'
       ]);
       print_r($client->get('/')->getBody());
    }
}
