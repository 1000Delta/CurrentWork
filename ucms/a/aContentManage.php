<?php
/**
 * 内容管理基类
 */

namespace CodeLib\a;

use CodeLib\i\iCURD;
use MyClass\Database\DBC;

abstract class aContentManage implements iCURD {
    
    protected $database;
    
    public function __construct(string $address, string $user, string $pass, string $dbName) {
        
        $this->database = new DBC(1, $address, $user, $pass, $dbName);
        $this->database->connect();
    }
    
    abstract protected function paramCheck(&$data);
    
    abstract public function create($data);
    
    abstract public function update($data);
    
    abstract public function read($index);
    
    abstract  public function delete($index);
}