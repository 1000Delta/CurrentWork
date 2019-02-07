<?php
/**
 * Created by PhpStorm.
 * User: delta
 * Date: 18-11-22
 * Time: 上午12:27
 */

namespace SE\SEQuery;


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
    protected $index;
    
    /**
     * @var $type string 指定索引中的数据类型
     */
    protected $type;

    /**
     * @var ISEData 指定的数据对象类型
     */
    protected $data;

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

        if ($this->isWriter()) {
        
            $response = SECore::get()->getLink()->post(
                '/'.$this->index.'/'.$this->type, [
                 'json' => get_object_vars($data)
            ]);
            $result = $response->getBody();
            $json = json_decode($result, true);
            // todo 待完善错误处理
            if ($json['result'] != 'created') {

                throw new \ErrorException('操作有误');
            }
            
        } else {
        
            throw new \InvalidArgumentException('实例未指定针对的索引或数据类型');
        }
    }
    
    public function mod($id, $data): void {

        if ($this->isWriter()) {

            $response = SECore::get()->getLink()->put(
                '/'.$this->index.'/'.$this->type.'/'.$id, [
                    'json' => get_object_vars($data)
            ]);
            $result = $response->getBody();
            $json = json_decode($result, true);
            // todo 待完善错误处理
            if ($json['result'] != 'updated') {

                throw new \ErrorException('操作有误');
            }
        } else {

            throw new \InvalidArgumentException('实例未指定针对的索引或数据类型');
        }
    }

    public function del($id) {
        if ($this->isWriter()) {

            $result = SECore::get()->getLink()->delete('/'.$this->index.'/'.$this->type.'/'.$id)->getBody();
            $json = json_decode($result, true);
            // todo 待完善错误处理
            if ($json['result'] != 'deleted') {

                throw new \ErrorException('操作有误');
            }
        } else {

            throw new \InvalidArgumentException('实例未指定针对的索引或数据类型');
        }
    }

    public function search($key) {
        // TODO: Implement search() method.
    }

    /**
     * 封装写入参数判断逻辑
     * @return boolean 判断的结果
     */
    protected function isWriter() {

        return $this->index != '' & $this->type != '';
    }

    protected function getResultCode($result) {

        // todo 错误处理
        $result2code = [
            ''
        ];
    }
}