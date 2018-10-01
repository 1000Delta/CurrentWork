<?php
/**
 * Created by PhpStorm.
 * User: 13975
 * Date: 2018/9/25
 * Time: 14:51
 */

namespace Test;

use http\Exception\InvalidArgumentException;
use Prophecy\Exception\Doubler\MethodNotFoundException;

interface TestInterface {
    
    public function test();
}

class TestClass {
    
    private $sub;
    public function __construct(TestInterface $test) {
        
        $this->sub = $test;
    }
    
    public function __call($name, $arguments) {
        // TODO: Implement __call() method.
        
        if ($name === "test") {
    
            switch (count($arguments)) {
        
                case 0:
                    return $this->test1();
                case 1:
                    return $this->test2($arguments[0]);
                default:
                    throw new InvalidArgumentException("参数数量错误: ".count($arguments));
            }
        }
        throw new MethodNotFoundException('无指定方法: '.$name, 'test', $name, $arguments);
    }
    
    private function test1() {
        
        return "This is TestClass::test()";
    }
    
    private function test2(int $val) {
        
        return $this->sub->test();
    }
}

class SubTestClass {
    
    public function test() {
        
        return "This is SubTestClass::test()";
    }
}