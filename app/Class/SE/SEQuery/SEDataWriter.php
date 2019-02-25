<?php
/**
 * Created by PhpStorm.
 * User: delta
 * Date: 18-12-27
 * Time: 下午8:08
 */

namespace SE\SEQuery;


use SE\SEQuery\SEData\ISEData;

interface SEDataWriter {
    
    /**
     * 数据写入器构造器
     * @param $index string 指定数据索引
     * @param $type string 制定索引中的数据类型
     * @return $this 写入器实例
     */
    public function __constructW($index, $type);

    /**
     * 写入数据
     * @param $data ISEData 数据对象
     * @return int 存入数据的索引
     */
    public function add($data);
    
    /**
     * 修改数据项
     * @param $id int 需要修改的数据项索引
     * @param $data ISEData 数据对象
     */
    public function mod($id, $data);
    
    /**
     * 删除数据
     * @param $id ISEData 数据对象
     */
    public function del($id);
}