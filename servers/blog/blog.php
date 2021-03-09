<?php
  include_once('../fn.php');

  $id = $_GET['id'];

  $sql = "select * from blogs where id = $id";

  $result = my_query($sql);

  $res=[
    'code'=>200,
    'data'=>$result 
  ];

  if($result===false){
    echo json(['code'=>400,'message'=>'未找到数据']);
  }else{
    echo json($res);
  }
?>  