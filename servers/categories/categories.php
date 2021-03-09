<?php
  include_once('../fn.php');
  
  $sql="select * from categories";

  $data=my_query($sql);

  $res=[
    'code'=>200,
    'data'=>$data 
  ];

  if($data===false){
    echo json(['code'=>400,'message'=>'未找到数据']);
  }else{
    echo json($res);
  }
?>