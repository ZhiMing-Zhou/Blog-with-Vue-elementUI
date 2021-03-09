<?php
  include_once('../fn.php');

  $title=$_POST['title'];
  $create_day=$_POST['create_day'];
  $content = $_POST['content'];
  $status=$_POST['status'];
  $cat_id=$_POST['cat_id'];

  $sql = "insert into blogs (title,create_day,content,status,cat_id) values ('$title','$create_day','$content',' $status','$cat_id')";

  $result = my_exec($sql);

  if($result===true){
    echo json(['message'=>'添加成功!','code'=>200]);
  }else{
    echo json(['message'=>'添加失败!','code'=>400]);
  }
?>