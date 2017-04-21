<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/19
 * Time: 15:12
 */

header('Content-type:text/json');

if($_POST) {

    $cate_id = $_POST['cate_id'] ? strip_tags($_POST['cate_id']) : '';
    $title = $_POST['title'] ? strip_tags($_POST['title']) : '';
    $author = $_POST['author'] ? strip_tags($_POST['author']) : '';
    $thumb = $_POST['thumb'] ? strip_tags($_POST['thumb']) : '';
    $content = $_POST['content'];

   // echo $cate_id.$title.$author.$thumb.$content;

    if ($cate_id == ''){
        $data = array('status'=>1,'message'=>'请选择分类');
        die(json_encode($data));
    }

    if ($title == ''){
        $data = array('status'=>2,'message'=>'请输入标题');
        die(json_encode($data));
    }

    if ($author == ''){
        $data = array('status'=>3,'message'=>'请输入作者');
        die(json_encode($data));
    }



//    if (strlen($content) <= 300){
//        $data = array('status'=>4,'message'=>'文章内容不得少于100字');
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


    $time = date("Y-m-d H:i:s");

    //$sql1 = "INSERT INTO blog_article(cate_id,art_title,art_thumb,art_content,art_time,art_editor) VALUES('{$cate_id}','asdad','asdad','ewqwq','{$time}','qweqe')";
    $sql1 = "INSERT INTO blog_article(cate_id,art_title,art_thumb,art_content,art_time,art_editor) VALUES('{$cate_id}','{$title}','{$thumb}','{$content}','{$time}','{$author}')";


    $result1 = mysqli_query($link,$sql1);

    if($result1){
        $data = array('status'=>0,'message'=>'文章添加成功！');
        die(json_encode($data));
    }else{
        $data = array('status'=>5,'message'=>'文章添加失败！');
        die(json_encode($data));
    }
}