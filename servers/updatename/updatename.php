<?php
  include_once('../fn.php');

  $id = $_GET['id'];
  $rename = $_GET['rename'];

  $sql = "update categories set name = '$rename' where id = '$id'";

  $result = my_exec($sql);

  if($result===true){
    echo json(['message'=>'修改成功!','code'=>200]);
  }else{
    echo json(['message'=>'修改失败!','code'=>400]);
  }
?>

