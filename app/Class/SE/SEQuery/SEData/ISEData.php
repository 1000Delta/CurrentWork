<?php
/**
 * Created by PhpStorm.
 * User: 13975
 * Date: 2019/2/1
 * Time: 0:21
 */

namespace SE\SEQuery\SEData;

/**
 * Interface ISEData 数据对象接口
 * @package SE\SEQuery\SEData
 *
 * 所有数据操作对象均需要实现此接口
 * 细化数据类型由各实现抽象类进行完善
 */
interface ISEData {
    
    /**
     * 获取搜索映射
     * @param $key string 类型搜索关键字
     * @return array 字段-关键字映射
     */
    public static function getMap($key);
}