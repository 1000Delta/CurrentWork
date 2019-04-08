<?php
/**
 * Created by PhpStorm.
 * User: delta
 * Date: 18-11-22
 * Time: 上午12:27
 */

namespace SE\SEQuery;


use GuzzleHttp\Exception\ClientException;
use SE\SECore\SECore;
use SE\SEError\SEError;
use SE\SEQuery\SEData\SEDataLink;

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
        
        // 检测参数有效性，连接到ES引擎
        $errMsg = '';
        // 索引检测
        try {
            // 类型检测
            $link = SECore::get()->getLink()->get('/'.$index.'/_mapping');
            $data = json_decode($link->getBody(), true);
            if (!array_key_exists($type, $data['link']['mappings'])) {
                
                $errMsg = '索引中指定类型不存在! ';
            }
        } catch (ClientException $e) {
    
            $errMsg = "索引无效: \n".$e->getMessage();
        }
        // 错误时抛出异常强行结束请求器构建
        if ($errMsg !== '') {
    
            throw new \RuntimeException($errMsg);
        }
    }

    public function add($data) {

        if ($this->notNull()) {
        
            // 检测数据是否匹配类型
            if (!SEDataLink::isMatch($data)) {
                
                throw new \InvalidArgumentException('传入数据与数据类型不匹配');
            }
            $response = SECore::get()->getLink()->post(
                '/'.$this->index.'/'.$this->type, [
                 'json' => $data
            ]);
            $result = $response->getBody();
            $json = json_decode($result, true);
            if ($json['result'] != 'created') {

                SEError::query($json);
                return;
            }
        } else {
        
            throw new \InvalidArgumentException('实例未指定针对的索引或数据类型');
        }
    }
    
    public function mod($id, $data): void {

        
        if ($this->notNull()) {

            $response = SECore::get()->getLink()->put(
                '/'.$this->index.'/'.$this->type.'/'.$id, [
                    'json' => $data
            ]);
            $result = $response->getBody();
            $json = json_decode($result, true);
            if ($json['result'] != 'updated') {

                SEError::query($json);
                return;
            }
        } else {

            throw new \InvalidArgumentException('实例未指定针对的索引或数据类型');
        }
    }

    public function del($id) {
        if ($this->notNull()) {

            $result = SECore::get()->getLink()->delete('/'.$this->index.'/'.$this->type.'/'.$id)->getBody();
            $json = json_decode($result, true);
            if ($json['result'] != 'deleted') {
            
                SEError::query($json);
                return;
            }
        } else {
    
            throw new \InvalidArgumentException('实例未指定针对的索引或数据类型');
        }
    }
    
    public function search(int $size, string $key) {
    
        // 简化分页搜索，仅返回第一页结果
        return $this->pageSearch(0, $size, $key);
    }
    
    public function pageSearch(int $from, int $size, string $key) {

        if ($this->notNull()) {
        
            // 将 搜索字段=>关键字 映射修改成搜索需要的格式
            // 使用 SEDataLink 类型的静态方法
            $queryMap = SEDataLink::getSearchMap($key);
            // 最佳字段查询优化dis_max
            $link = SECore::get()->getLink()->get($this->index.'/'.$this->type.'/_search?from='.$from.'&size='.$size, [
                'json' => [
                    'query' => [
                        'dis_max' => [
                            'queries' => $queryMap
                        ]
                    ]
                ]
            ]);
            $data = json_decode($link->getBody(), true);
            if (!array_key_exists('hits', $data)) {
                // 返回成功查询的完整结果，由控制器进行后续处理
                return $data['hits'];
                
            } else {
            
                // 记录错误数据
                SEError::query($data);
            }
        } else {
        
            throw new \InvalidArgumentException('实例未指定针对的索引或数据类型');
        }
        // 错误结果默认抛出空数组
        return [];
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