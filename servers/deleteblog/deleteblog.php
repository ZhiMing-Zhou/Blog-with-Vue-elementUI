<?php
  include_once('../fn.php');

  $id = $_GET['id'];

  $sql="delete from blogs where id = '$id'";
  $sql2="select count(*) as 'total' from blogs";

  $result = my_exec($sql);
  $result2 = my_query($sql2);

  if($result===true){
    echo json(['message'=>'删除成功!','code'=>200,'total'=>$result2[0]['total']]);
  }else{
    echo json(['message'=>'删除失败!','code'=>400]);
  }
?>