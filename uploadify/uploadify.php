<?php

// 定义要存储的路径
$targetFolder = '/uploads'; // Relative to the root
//校验 和客户端对比
$verifyToken = md5('unique_salt' . $_POST['timestamp']);

if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
    //临时文件
    $tempFile = $_FILES['Filedata']['tmp_name'];
    //要保存图片的文件夹路径
    $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder; // /root/uploads
    //写法格式 uploads

    $filename = time().$_FILES['Filedata']['name'];
    $targetFile = rtrim($targetPath,'/') . '/' . $filename;

    // 校验文件的类型
    $fileTypes = array('jpg','jpeg','gif','png'); // File extensions
    //pathinfo() 以数组的形式返回关于文件路径的信息
    $fileParts = pathinfo($filename);

    //in_array()函数中是否存在数组中指定的值。
    //extension获取文件后缀
    if (in_array(strtolower($fileParts['extension']),$fileTypes)) {
        //如果是图片文件 （临时文件夹，新文件夹）
        move_uploaded_file($tempFile,$targetFile);
        //返回图片存储的路径
        echo $targetFolder.'/'.$filename;
    } else {
        echo '图片格式不正确.';
    }
}

