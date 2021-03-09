<?php
  include_once('../fn.php');

  $new_cat_name = $_GET['new_cat_name'];

  $sql = "insert into categories (name) values ('$new_cat_name')";

  $result = my_exec($sql);

  if($result===true){
    echo json(['message'=>'添加成功!','code'=>200]);
  }else{
    echo json(['message'=>'添加失败!','code'=>400]);
  }
?>