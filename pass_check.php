<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/18
 * Time: 11:24
 */

include 'username_check_session.php';

if(!$_POST){
    echo '服务器异常，请稍后重试！';
    return ;
}

$password_o = $_POST['password_o']?strip_tags($_POST['password_o']):'';
$password = $_POST['password']?strip_tags($_POST['password']):'';
$password_c = $_POST['password_c']?strip_tags($_POST['password_c']):'';

if($password_o ==''){
    echo '原始密码不得为空！';
    return;
}


if( $password =='' || $password_c == ''){
    echo '新密码和确认密码不得为空';
    return;
}

if(strlen($password)<6 || strlen($password)>20){
    echo "新密码必须为6到20位";
    return;
}

if($password != $password_c){
    echo "确认密码必须和新密码一致！";
    return ;
}

if($password_o == $password){
    echo "新密码和原始密码不得一致！";
    return ;
}

include "mysql/mysql_conn.php";

$sql = "SELECT password FROM blog_user WHERE username='{$_SESSION['username']}'";

$result = @mysqli_query($link,$sql);
$data=mysqli_fetch_assoc($result);

if( md5($password_o) != $data['password']){
    echo "原密码错误！";
    return;
}

$p = md5($password);
$sql2 = "UPDATE  blog_user SET password='{$p}' WHERE username='{$_SESSION['username']}'";
$result2 = @mysqli_query($link,$sql2);
if($result2) {
    echo "修改密码成功！";
    $_SESSION['username']='';

    echo "<script>
            var i=5;
           setInterval(function(){
               document.body.innerHTML='';
               document.write(--i +'s 后跳转到登录界面');
               if(i == 0){
                    top.location.href='login.php';
               }
           },1000);

           </script>";
}
else{
    echo "修改密码失败，请稍后重试！";
}