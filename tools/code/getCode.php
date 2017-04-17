<?php
/**
 * Created by PhpStorm.
 * User: ANPENGJI
 * Date: 2017/4/2
 * Time: 16:52
 */
//开启Session
session_start();
//创建验证码类
include ("Code.class.php");

$code = new Code();
//输出图像
$code->make();
//将code的值存到session中
$_SESSION['code']=$code->get();
