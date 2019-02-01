<?php
/**
 * Created by PhpStorm.
 * User: delta
 * Date: 18-12-27
 * Time: 下午8:08
 */

namespace SE\SEQuery;


interface ISEDataWriter {
    
    /**
     * 写入数据
     * @param $data
     * @return int 存入数据的索引
     */
    public function add($data): int;
    
    /**
     * @param $index int 需要修改的数据项索引
     * @param $data
     */
    public function mod($index, $data): void;
    
    public function del($index): void;
}