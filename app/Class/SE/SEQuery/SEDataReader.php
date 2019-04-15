<?php
/**
 * Created by PhpStorm.
 * User: delta
 * Date: 19-2-6
 * Time: 下午5:10
 */

namespace SE\SEQuery;

interface SEDataReader {
    
    /** 搜索接口
     * @param int $size 显示搜索结果数
     * @param string $key 搜索字段与关键字组成的关联数组
     * @return array 搜索结果列表
     *
     * 提供搜索功能
     */
    public function search(int $size, string $key);
    
    /** 分页搜索
     * @param int $from 搜索开始的位置
     * @param int $size 搜索显示的条目
     * @param string $key 搜索关键字
     * @return array 搜索结果列表
     *
     * 提供分页搜索功能
     */
    public function pageSearch(int $from, int $size, string $key);
    
    /** 获取建议接口
     * @param string $key 需要获取建议的关键字
     * @return array 包含建议结果的数组
     *
     * 为提交的关键字获取搜索建议
     */
    public function suggest(string $key);
}