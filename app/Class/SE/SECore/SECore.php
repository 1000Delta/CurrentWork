<?php
/**
 * Created by PhpStorm.
 * User: delta
 * Date: 18-11-22
 * Time: 上午12:19
 */

namespace SE\SECore;


class SECore extends ASECore {

    /**
     * @return SECore|ASECore 本类的唯一实例
     *
     */
    public static function get() {

        if (!self::$instance instanceof self) {

            self::$instance = new self(env('ES_HOST'));
        }
        return self::$instance;
    }
}