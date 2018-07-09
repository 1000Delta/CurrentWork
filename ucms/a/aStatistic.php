<?php
/**
 * 数据统计抽象类
 * 数据表结构
 * data_statistic {
 *   id INT(20) PRIMARY_KEY AUTO_INCREMENT
 *   name VARCHAR(100)
 *   count INT(20)
 * }
 */

namespace CodeLib\a;

use MyClass\Database\DBC;

abstract class aStatistic {
    
    protected $db;
    protected $tableName;
    
    public function __construct(string $host, string $user, string $pass, string $dbName, string $tableName) {
        
        $this->db = new DBC(0, $host, $user, $pass, $dbName);
        $this->tableName = $tableName;
    }
    
    public function increase($dataName) {
        
        $result = $this->db->update($this->tableName, ['count' => 'count+1'], 'WHERE name='.strtolower($dataName));
        if ($result->rowCount()) {
            
            return 0;
        } else {
            
            return -1;
        }
    }
    
    public function decrease($dataName) {
        
        $result = $this->db->update($this->tableName, ['count' => 'count-1'], 'WHERE name='.strtolower($dataName));
        if ($result->rowCount()) {
            
            return 0;
        } else {
            
            return -1;
        }
    }
    
    public function getData($dataName) {
        
        $result = $this->db->select($this->tableName, ['count'], 'WHERE name='.$dataName);
        if ($data = $result->fetch()) {
            
            return [$dataName => $data[0]];
        } else {
            
            return -1;
        }
    }
    
    public function addData($dataName) {
        
        $result = $this->db->insert($this->tableName, [
            'name' => strtolower($dataName),
            'count' => 0
        ]);
        if ($result->rowCount()) {
            
            return 0;
        } else {
            
            return -1;
        }
    }
}