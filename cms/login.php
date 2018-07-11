<?php
/** 登录模块
 * 验证用户名uid
 * 验证密码pass
 * 成功则建立session
 *
 * 返回值说明
 * status
 *  0 -> 未登录
 *  1 -> 已登录
 * error
 *  0 -> 未报错
 * -2 -> 参数不完整
 * -1 -> 连接数据库失败
 *  1 -> 用户名错误
 *  2 -> 密码错误
 */
$uid = strtolower($_GET['username']);
$pass = strtolower($_GET['password']);
$return = ['status' => 0, 'error' => 0];

$db = new \MyClass\Database\DBC(1, '127.0.0.1', 'test', 'test', 'test_cms');
if(!empty($db)) {

    if (!empty($uid) && !empty($pass)) {

        $state = $db->prepare('SELECT password FROM test_cms_user WHERE username=?');
        $state->bindParam(0, $uid);
        $state->execute();
//    $res = $db->select('test_cms_user', ['password'], 'WHERE username='.$uid);
        if ($res = $state->fetch()) {

            if ($res === $pass) {

                $lifetime = 1800;
                session_set_cookie_params($lifetime);
                session_start();
                $_SESSION['uid'] = $uid;
                $return['status'] = 1;
            } else {

                $return['error'] = 2;
            }
        } else {

            $return['error'] = 1;
        }
    } else {

        $return['error'] = -2;
    }
} else {

    $return['error'] = -1;
}

echo json_encode($return);