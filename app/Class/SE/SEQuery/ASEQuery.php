<?php
/**
 * Created by PhpStorm.
 * User: delta
 * Date: 18-11-22
 * Time: 上午12:27
 */

namespace SE\SEQuery;


use SE\SEQuery\SEData\ISEData;

/**
 * Class ASEQuery 数据请求器
 * @package SE\SEQuery
 *
 * 数据请求抽象类，实现数据写入接口和数据查询接口
 *
 */
abstract class ASEQuery implements ISEDataReader, ISEDataWriter {
    
    /**
     * @var ISEData 指定的数据对象类型
     */
    private $data;
    
    /**
     * ASEQuery constructor.
     * @param ISEData $data
     */
    public function __construct(ISEData $data) {
    
        $this->data = $data;
    }
}