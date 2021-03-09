<?php
  include_once('../fn.php');

  $id=$_POST['id'];

  $title = $_POST['title'];

  $content = $_POST['content'];

  $sql = "update blogs set title = '$title' ,content = '$content' where id = '$id'";

  if(my_exec($sql)===true){
    echo json(['message'=>'修改成功','code'=>200]);
  }else{
    echo json(['message'=>'修改失败','code'=>400]);
  }
?>