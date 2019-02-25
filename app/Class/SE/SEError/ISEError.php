<?php
/**
 * Created by PhpStorm.
 * User: 13975
 * Date: 2019/2/19
 * Time: 13:23
 */

namespace SE\SEError;


use SE\SEQuery\SEData\ISEData;

interface ISEError {
    
    /**
     * 处理查询中出现的错误信息
     * @param $rtnData array 出现错误的返回数据数组
     * @return void
     */
    public static function query($rtnData);
    
    /**
     * 处理集群出现的错误
     * @param $rtnData ISEData 出现错误的返回数据对象
     * @return void
     */
    public static function cluster($rtnData);
}