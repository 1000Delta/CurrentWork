<?php
/**
 * Created by PhpStorm.
 * User: delta
 * Date: 19-2-6
 * Time: 下午5:10
 */

namespace SE\SEQuery;

interface SEDataReader {
    
    /**
     * 搜索接口
     * @param $size int 显示搜索结果数
     * @param $keyMap array 搜索字段与关键字组成的关联数组
     * @return array 搜索结果列表
     *
     * 提供搜索功能
     */
    public function search($size, $keyMap);
    
    /**
     * 分页搜索
     * @param $from int 搜索开始的位置
     * @param $size int 搜索显示的条目
     * @param $keyMap array 字段-关键字映射
     * @return array 搜索结果列表
     *
     * 提供分页搜索功能
     */
    public function pageSearch($from, $size, $keyMap);
}