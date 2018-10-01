<?php

namespace App\Http\Controllers;

use App\Providers\TestProvider;
use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    private $test;
    
    public function __construct(\Test\TestClass $test) {
        
        $this->test = $test;
    }
    
    public function test($val = "") {
        
        if ($val === "") {
    
            return $this->test();
        } else {
            
            return $this->test($val);
        }
    }
}
