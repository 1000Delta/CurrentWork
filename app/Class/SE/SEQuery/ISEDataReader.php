<?php
/**
 * Created by PhpStorm.
 * User: 13975
 * Date: 2019/1/31
 * Time: 21:53
 */

namespace SE\SEQuery;


interface ISEDataReader {
    
    public function search(): void;
    
    public function read();
}