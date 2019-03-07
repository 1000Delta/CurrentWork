<?php
/**
 * Created by PhpStorm.
 * User: 13975
 * Date: 2019/2/19
 * Time: 13:53
 */

namespace SE\SEError;


use Illuminate\Support\Facades\Log;

class SEError implements ISEError {

    public static function query($rtnData) {

        Log::error('result: '.$rtnData['result'], $rtnData);
    }
    
    public static function search($rtnData) {

        Log::error('result: ', $rtnData);
        
    }
    
    public static function cluster($rtnData) {

        Log::error('result: '.$rtnData['result'], $rtnData);
    }
}