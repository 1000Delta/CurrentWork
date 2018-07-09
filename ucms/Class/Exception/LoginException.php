<?php
/**
 * Created by PhpStorm.
 * User: 13975
 * Date: 2018/6/8
 * Time: 19:42
 */

namespace Exception;


class LoginException extends \Exception {

    public function errorLogin() {
        
        $errorMsg = 'Error!';
        $errorMsg .= $this->getMessage();
        return $errorMsg;
    }
}