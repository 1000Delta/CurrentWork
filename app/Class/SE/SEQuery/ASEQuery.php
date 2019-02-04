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
     * ASEQuery constructor.
     * @param ISEData $data
     */
    public function __construct(ISEData $data) {
    
        $this->data = $data;
    }
    
    public function add($data): int {
        // TODO: Implement add() method.
        if ($this->index != '' && $this->type != '') {
        
            SECore::get()->getLink()->post('/'.$this->index.'/'.$this->type, [
                // todo 数据对象转化成数组json问题
                // 'json' =>
            ]);
            
        } else {
        
            throw new UnexpectedValueException('未指定索引或数据类型');
        }
    }
    
    public function mod($id, $data): void {
        // TODO: Implement mod() method.
    }
}