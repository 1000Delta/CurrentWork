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
     * 获取单例
     * @return SECore|ASECore 本类的唯一实例
     *
     */
    public static function get() {

        if (!self::$instance instanceof self) {

            if (null !== env('ES_HOST')) {
    
                self::$instance = new self(env('ES_HOST'));
            } else {
                
                throw new \InvalidArgumentException('Invalid environment argument "ES_HOST" in "/.env".');
            }
        }
        return self::$instance;
    }
}