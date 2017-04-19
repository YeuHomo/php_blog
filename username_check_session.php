<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/18
 * Time: 10:12
 */
    session_start();
    if($_SESSION['username'] == ''){
        header('location:login.php');
        return;
    }

?>