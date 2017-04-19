<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/18
 * Time: 16:41
 */
header('Content-type:text/json');
if($_GET){



        $id = $_GET['id'];

        if($id == '' ){
            $data = array('status' =>2,'message' =>'请选择删除的项！');
            die(json_encode($data));
        }

        include 'mysql/mysql_conn.php';
        $sql1 = "SELECT * FROM blog_category WHERE id='{$id}'";
        $result1 = @mysqli_query($link,$sql1);

        if($result1->num_rows <= 0){
            $data = array('status'=>3,'message'=>'数据不存在！');
            die(json_encode($data));
        }

        $sql = "DELETE FROM blog_category WHERE id='{$id}'";

        $result = @mysqli_query($link,$sql);

        if($result){
            $data = array('status'=>0,'message'=>'删除成功！');
            die(json_encode($data));

        }else{
            $data = array('status'=>1,'message'=>'删除失败！');
            die(json_encode($data));
        }
}
