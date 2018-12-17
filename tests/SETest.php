<?php
/**
 * Created by PhpStorm.
 * User: delta
 * Date: 18-12-14
 * Time: 下午6:03
 */

class SETest extends TestCase {

    public function testCore() {

        // 测试静态类对象是否存在
        $this->assertIsObject(\SE\SECore\SECore::get());
        $sec1 = \SE\SECore\SECore::get();
        $sec2 = \SE\SECore\SECore::get();
        // 测试单例是否实现
        $this->assertSame($sec1, $sec2);
        // 测试节点地址数据是否正确
        $this->assertNotNull($sec1->getNode());
        echo $sec1->getNode();
    }

    public function testMonitor() {

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

    public function testQuery() {

        $this->assertTrue(true);
    }
}