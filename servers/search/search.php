<?php
  include_once('../fn.php');

  // 获取页码
  $pageNum=$_GET['pagenum'];
  // 获取条数
  $pageSize=$_GET['pagesize'];
  // 获取搜索关键字
  $key=$_GET['key'];
  // 起始索引
  $start = ($pageNum-1)*$pageSize;


  $sql="select * from blogs where content like '%$key%' limit $start,$pageSize";
  $sql2="select count(*) as  'total' from blogs where content like '%$key%'";

  $data=my_query($sql);
  $data2=my_query($sql2);

  $res=[
    'code'=>200,
    'total'=>$data2[0]['total'],
    'data'=>$data
  ];

  if($data===false){
    echo json(['code'=>400,'message'=>'未找到匹配数据']);
  }else{
    echo json($res);
  }
?>