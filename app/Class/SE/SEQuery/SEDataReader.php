<?php
/**
 * Created by PhpStorm.
 * User: delta
 * Date: 19-2-6
 * Time: 下午5:10
 */

namespace SE\SEQuery;

use SE\SEQuery\SEData\ISEData;

interface SEDataReader {

    /**
     * 查询器构造函数
     * @param $data ISEData 查询器实例
     * @return $this 查询器实例
     */
    public function __constructR($data);

    /**
     * 搜索接口
     * @param $key string 搜索关键字
     * @return array 搜索结果列表
     *
     * 提供搜索功能
     */
    public function search($key);
}