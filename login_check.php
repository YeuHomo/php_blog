<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/17
 * Time: 14:34
 */

//开启session
session_start();

//判断是否为POST提交，否则拒绝
if(!$_POST){
    echo '服务器异常，请稍后重试！';
    return ;
}

//获取表单信息
$username = $_POST['username']?strip_tags($_POST['username']) :'';
$password = $_POST['password']?strip_tags($_POST['password']) :'';
$code = $_POST['code']?strip_tags($_POST['code']) :'';

//echo $username.$password.$code;

//校验
if($username=='' || $password=='' ){
    echo '用户名或密码不能为空';
    return;
}

if($code==''){
    echo '验证码不能为空！';
    return;
}

//校验码校验
//将用户提交的验证码全部转换成大写，再校验
if($_SESSION['code'] != strtoupper($code)){
    echo "验证码错误！";
    return ;
}


//引入数据库操作
include 'mysql/mysql_conn.php';

//sql查找语句
$sql = "SELECT password FROM user WHERE username='$username'";


//执行sql语句
$result = mysqli_query($link,$sql);

$A = $result->fetch_row();
//如果查询不到结果的话，就返回
if($A == 0){
    echo '用户名不存在，请重试！';
    return ;
}
//
//var_dump($data);
////获取一条数据
//$data = mysqli_fetch_assoc($result);
//var_dump($data);
var_dump($A[0]);
echo '<br>';
var_dump(md5($password));
if(md5($password) != $A[0]){
    echo '账户名或密码不正确';
    return;
}

//登录成功后跳转到首页
header('location:index.html');

