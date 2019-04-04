<?php
/**
 * Created by PhpStorm.
 * User: 13975
 * Date: 2019/2/2
 * Time: 16:20
 */

namespace SE\SEQuery\SEData;


final class SEDataLink implements ISEData {

    private static $keyList = [
        'keyword' => '',
        'title' => '',
        'url' => '',
        'intro' => '',
        'content' => '',
        'tags' => '',
        'note' => ''
    ];
    
    public static function getSearchMap($key) {

       $keymap = [];
       foreach (self::$keyList as $k => $v) {
           
           $keymap[] = ['match' => [$k => $key]];
       }
        return $keymap;
    }
    
    public static function getKeyMap() {
        
        return self::$keyList;
    }
    
    public static function isMatch($keyMap) {
    
        // 数据项数匹配
        if (count($keyMap) !== count(self::$keyList)) {
            
            return false;
        }
        
        // 数据项名称匹配
        if (count(array_diff_key(self::$keyList, $keyMap)) !== 0) {
            
            return false;
        }
       return true;
    }
}