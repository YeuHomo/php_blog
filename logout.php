<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/18
 * Time: 10:28
 */


//不能没有登录用户直接退出
//引入session
include 'username_check_session.php';
$_SESSION['username'] = '';
//if($_SESSION['username'] == ''){
//    echo $_SESSION['username'];
//}
//跳转到登录界面
header('location:login.php');

