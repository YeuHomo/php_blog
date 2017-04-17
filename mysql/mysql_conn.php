<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/17
 * Time: 14:51
 */

//声明输出数据的字符集
header("Content-type:text/html;charset=utf-8");

//数据库配置链接           主机名     用户名  密码 数据库
$link = @mysqli_connect('localhost','root','','blog') or die("数据库连接失败，请稍后重试");

//设置mysql返回的数据字符集
mysqli_query($link,'set names utf8');