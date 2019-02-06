<?php
/**
 * Created by PhpStorm.
 * User: delta
 * Date: 18-11-22
 * Time: 上午12:27
 */

namespace SE\SEQuery;


use http\Exception\UnexpectedValueException;
use SE\SECore\SECore;
use SE\SEQuery\SEData\ISEData;

/**
 * Class ASEQuery 数据请求器
 * @package SE\SEQuery
 *
 * 数据请求抽象类，实现数据写入接口和数据查询接口
 *
 */
abstract class ASEQuery implements SEDataReader, SEDataWriter {
    
    /**
     * @var $index string 需要读取数据的索引
     */
    private $index;
    
    /**
     * @var $type string 指定索引中的数据类型
     */
    private $type;
    /**
     * @var ISEData 指定的数据对象类型
     */
    private $data;

    /**
     *多态构造器
     * ASEQuery constructor.
     * 通过 func_get_args 和 call_user_func
     */
    public function __construct() {

        $a = func_get_args();
        $i = count($a);

        switch ($i) {

            case 1:

                call_user_func([$this, '__constructR'], $a);
                break;
            case 3:
                call_user_func([$this, '__constructW'], $a);
                break;
            default:
                throw new \InvalidArgumentException(
                    'Wrong arguments numbers.'
                );
        }
    }

    public function __constructW($index, $type, $data) {

        $this->index = $index;
        $this->type = $type;
        $this->data = $data;
    }

    public function __constructR($data) {

        $this->type = $data;
    }

    public function add($data) {

        if ($this->index != '' && $this->type != '') {
        
            SECore::get()->getLink()->post('/'.$this->index.'/'.$this->type, [
                 'json' => get_object_vars($data)
            ]);
            
        } else {
        
            throw new \InvalidArgumentException('实例未指定针对的索引或数据类型');
        }
    }
    
    public function mod($id, $data): void {
        // TODO: Implement mod() method.
    }
}