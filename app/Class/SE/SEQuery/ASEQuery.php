<?php
/**
 * Created by PhpStorm.
 * User: delta
 * Date: 18-11-22
 * Time: 上午12:27
 */

namespace SE\SEQuery;


use SE\SECore\SECore;
use SE\SEError\SEError;

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
     * ASEQuery constructor.
     * @param $index string
     * @param $type string
     */
    public function __construct($index, $type) {

        $this->index = $index;
        $this->type = $type;
    }

    public function add($data) {

        if ($this->notNull()) {
        
            $response = SECore::get()->getLink()->post(
                '/'.$this->index.'/'.$this->type, [
                 'json' => get_object_vars($data)
            ]);
            $result = $response->getBody();
            $json = json_decode($result, true);
            if ($json['result'] != 'created') {

                SEError::query($json);
            }
        } else {
        
            throw new \InvalidArgumentException('实例未指定针对的索引或数据类型');
        }
    }
    
    public function mod($id, $data): void {

        if ($this->notNull()) {

            $response = SECore::get()->getLink()->put(
                '/'.$this->index.'/'.$this->type.'/'.$id, [
                    'json' => get_object_vars($data)
            ]);
            $result = $response->getBody();
            $json = json_decode($result, true);
            if ($json['result'] != 'updated') {

                SEError::query($json);
            }
        } else {

            throw new \InvalidArgumentException('实例未指定针对的索引或数据类型');
        }
    }

    public function del($id) {
        if ($this->notNull()) {

            $result = SECore::get()->getLink()->delete('/'.$this->index.'/'.$this->type.'/'.$id)->getBody();
            $json = json_decode($result, true);
            // todo 待完善错误处理
            if ($json['result'] != 'deleted') {
            
                SEError::query($json);
            }
        } else {
    
            throw new \InvalidArgumentException('实例未指定针对的索引或数据类型');
        }
    }

    public function search($keyMap) {
        // TODO: Implement search() method.
        if ($this->notNull()) {
    
            $queryMap = [];
            foreach ($keyMap as $k => $v) {
        
                $queryMap[] =  ['match' => [$k => $v]];
            }
            $link = SECore::get()->getLink()->get($this->index.'/'.$this->type, [
                'json' => [
                    'query' => [
                        'dis_max' => [
                            'queries' => $queryMap
                        ]
                    ]
                ]
            ]);
            $data = json_decode($link->getBody());
        } else {
    
            throw new \InvalidArgumentException('实例未指定针对的索引或数据类型');
        }
    }

    /**
     * 封装写入参数判断逻辑
     * @return boolean 判断的结果
     */
    protected function notNull() {

        // 索引和类型参数不为空
        return $this->index != '' && $this->type != '';
    }
}