<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/20
 * Time: 16:09
 */

if($_POST){

    $id = $_POST['id']?strip_tags($_POST['id']):'';
    $cate_id = $_POST['cate_id']?strip_tags($_POST['cate_id']):'';
    $title = $_POST['title']?strip_tags($_POST['title']):'';
    $author = $_POST['author']?strip_tags($_POST['author']):'';
    $thumb = $_POST['thumb']?strip_tags($_POST['thumb']):'';
    $content = $_POST['content'];

    if($cate_id ==''){
        $data = array('status'=>1,'message'=>'请选择分类');
        die(json_encode($data));
    }

    if($title ==''){
        $data = array('status'=>2,'message'=>'标题不得为空');
        die(json_encode($data));
    }

    if($author ==''){
        $data = array('status'=>3,'message'=>'请填写作者');
        die(json_encode($data));
    }

//    if($thumb ==''){
//        $data = array('status'=>4,'message'=>'请上传图片');
//        die(json_encode($data));
//    }

//    if (strlen($content) <= 300){
//        $data = array('status'=>5,'message'=>'文章内容不得少于100字');
//        die(json_encode($data));
//    }

    //连接数据库
    include 'mysql/mysql_conn.php';

    if($thumb !='') {

        // 获得上传图片的类型
        $type = strtolower(pathinfo($thumb, PATHINFO_EXTENSION));

        if($type != 'jpg' && $type !='jpeg' && $type !='gif' && $type !='png'){
            $data = array('status'=>6,'message'=>'请上传正确格式的缩略图！');
            die(json_encode($data));
        }

    }


    $sql2 = "UPDATE blog_article SET art_title='{$title}',art_editor='{$author}',cate_id='{$cate_id}',art_thumb='{$thumb}',art_content='{$content}' WHERE id='{$id}'";
    $result2 = mysqli_query($link,$sql2);

    if($result2){
        $data = array('status'=>0,'message'=>'修改成功！');
        die(json_encode($data));
    }else{
        $data = array('status'=>7,'message'=>'修改失败！');
        die(json_encode($data));
    }

}