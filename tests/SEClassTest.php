<?php

use SE\SECore\SECore;
use SE\SEQuery\SEData\SEDataLink;
use SE\SEQuery\SEQuery;

/**
 * Created by PhpStorm.
 * User: delta
 * Date: 18-12-14
 * Time: 下午6:03
 */

class SEClassTest extends TestCase {
    
    public function testSECore() {
        
        // 测试静态类对象是否存在
        $this->assertIsObject(SECore::get());
        $core = SECore::get();
        $sec2 = SECore::get();
        // 测试单例是否实现
        $this->assertSame($core, $sec2);
        // 测试节点地址数据是否正确
        $this->assertNotNull($core->getNode());
        
        return $core;
    }
    
    /**
     * @depends testSECore
     */
    public function testSEMonitor() {
        
        $monitor = new \SE\SEMonitor\SEMonitor();
        // 返回数据非空检查
        $this->assertNotNull($monitor->getClusterName());
        $this->assertNotNull($monitor->getNodeList());
        $this->assertNotNull($monitor->getNodeNum());
        $this->assertNotNull($monitor->getStatus());
        // 数据刷新时间检查
        $time1 = $monitor->getRecentTime();
        $this->assertNotNull($time1);
        // 刷新过快，需要延时至少一秒
        sleep(1);
        $time2 = $monitor->refresh()->getRecentTime();
        
        $this->assertNotEquals($time1, $time2);
    }
    
    public function testSEData() {
        
        // 模拟数据数组测试
        $data = [
            'keyword' => 'key',
            'title' => 'title',
            'url' => 'www.baidu.com',
            'intro' => 'no introduction',
            'content' => 'This is content',
            'tags' => ['tag1', 'tag2'],
            'note' => 'None'
        ];
        // 测试数据键名是否匹配
        $this->assertTrue(SEDataLink::isMatch($data));
        // 测试关键字生成数据是否成功
        $this->assertCount(count($data), SEDataLink::getSearchMap('theKey'));
    }
    
    /** 测试 SECore 类
     * @depends testSECore
     */
    public function testSEQuery() {
        
        // 构建查询json组
        $queryMap = SEDataLink::getSearchMap('我');
        // 查询
        $query = new SEQuery('link', 'webPage');
        $res = $query->search(5, '我');
        // 字段存在性断言
        $this->assertArrayHasKey('total', $res, '结果总数数组');
        $this->assertArrayHasKey('max_score', $res, '结果相关性最大值');
        $this->assertArrayHasKey('hits', $res, '查询结果数组');
    }
    
    public function testSESetting() {
        
        self::assertTrue(true);
    }
    
    /**
     * @depends testSECore
     */
    public function testSEError() {
        
        $query = new SEQuery('my_store', 'products');
        // $query->
        
        // \SE\SEError\SEError::query($data);
        
        self::assertTrue(true);
    }
}
