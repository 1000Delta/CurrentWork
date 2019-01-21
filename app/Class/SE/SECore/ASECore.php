<?php
/**
 * Created by PhpStorm.
 * User: delta
 * Date: 18-11-22
 * Time: 上午12:32
 */

namespace SE\SECore;


abstract class ASECore {

    /**
     * @var $instance ASECore 唯一实例
     */
    protected static $instance;
    /**
     * @var $node string 节点地址
     */
    protected $node;

    /**
     * SECoreAbstract constructor.
     * @param $host string SE主节点地址
     */
    protected function __construct($host) {

        $this->node = $host;
    }
    
    public static abstract function get();

    /**
     * @return string Address of Elasticsearch main node.
     */
    public function getNode(): string {

        return $this->node;
    }
}