<?php
  include_once('../fn.php');

  $id = $_GET['id'];

  $sql = "delete from categories where id = '$id'";

  $result = my_exec($sql);
  
  if($result===true){
    echo json(['message'=>'删除成功!','code'=>200]);
  }else{
    echo json(['message'=>'删除失败!','code'=>400]);
  }
?>