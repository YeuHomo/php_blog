<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/17
 * Time: 14:34
 */

//开启session
session_start();
header('Content-type:text/json');
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
    $data = array('status' =>1,'message' =>'用户名或密码不能为空');
    die(json_encode($data));
}

if($code==''){
    $data = array('status' =>2,'message' =>'验证码不能为空！');
    die(json_encode($data));
}

//校验码校验
//将用户提交的验证码全部转换成大写，再校验
if($_SESSION['code'] != strtoupper($code)){
    $data = array('status' =>3,'message' =>'验证码错误！');
    die(json_encode($data));
}


//引入数据库操作
include 'mysql/mysql_conn.php';

//sql查找语句
$sql = "SELECT password FROM blog_user WHERE username='$username'";


//执行sql语句
$result = @mysqli_query($link,$sql);

$A = $result->fetch_row();
//如果查询不到结果的话，就返回
if($A == 0){
    $data = array('status' =>4,'message' =>'用户名不存在，请重试！');
    die(json_encode($data));
}

//$data = mysqli_fetch_assoc($result);

if(md5($password) != $A[0]){
    $data = array('status' =>5,'message' =>'账户名或密码不正确');
    die(json_encode($data));

}else {
    $_SESSION['username'] = $username;
    $data = array('status' => 0, 'message' => '登录成功');
    die(json_encode($data));
}

//登录成功后跳转到首页

