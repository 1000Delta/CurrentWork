<?php
/** 获取内容列表
 *
 * 流程
 * 1.开始会话
 * 检测SESSION超全局变量是否含有uid，若存在且不为空
 * 读取POST参数
 * class:int
 *
 * 数据表名：test_cms_content
 * 字段：
 * id 默认
 * name 姓名
 * sex 性别
 * department 院系
 * major 专业
 * phone 电话
 * intention1 意向
 * intention2
 * intention3
 * note 备注
 * status 状态
 *
 *
 */

session_start();

if (isset($_SESSION['uid']) && !empty($SESSION['uid'])) {
s
    $db = new \MyClass\Database\DBC(1, '127.0.0.1', 'test', 'test', 'test_cms');
    $class = strtolower($_GET['class']);

    $prepare = $db->prepare('SELECT * FROM test_cms_content WHERE class=?');
    $prepare->bindParam(1, $class);
    $prepare->execute();
    $res = $prepare->fetchAll(\MyClass\Database\DBC::FETCH_ASSOC_DBC);
    echo json_encode($res);
}