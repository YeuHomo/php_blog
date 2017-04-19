<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/18
 * Time: 16:17
 */


header('Content-type:text/json');
if($_GET){

    $parent = $_GET['cate_parent']?strip_tags($_GET['cate_parent']):'';
    $name = $_GET['cate_name']?strip_tags($_GET['cate_name']):'';
    $title = $_GET['cate_title']?strip_tags($_GET['cate_title']):'';

    if($name == ''){
        $data = array('status' =>1,'message' =>'分类名称不能为空');
        die(json_encode($data));
    }

    if($title == ''){
        $data = array('status' =>2,'message' =>'分类标题不得为空！');
        die(json_encode($data));
    }

    if($parent == ''){
        $parent=0;
    }

    if(strlen($name)>30){
        $data = array('status' =>3,'message' =>'分类名称不得超过30字！');
        die(json_encode($data));
    }

    if(strlen($title)>300){
        $data = array('status' =>4,'message' =>'分类标题不得超过300字！');
        die(json_encode($data));
    }

    //p =(int)($parent);

    include 'mysql/mysql_conn.php';
    $sql = "INSERT INTO blog_category(cate_name,cate_title,cate_pid) VALUES( '$name', '$title', '$parent')";
    $result = mysqli_query($link,$sql);

    if($result){
        $data = array('status'=>0,'message'=>'添加成功！');
        die(json_encode($data));

    }else{
        $data = array('status'=>5,'message'=>'添加失败！');
        die(json_encode($data));
    }

}


