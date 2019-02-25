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
        // TODO: Implement query() method.
        Log::error('result: '.$rtnData['result']);
    }
    
    public static function cluster($rtnData) {
        // TODO: Implement cluster() method.
        // if
    }
}