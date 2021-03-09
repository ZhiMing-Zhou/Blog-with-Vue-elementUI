<?php
  include_once('../fn.php');
  // 获取页码
  $pageNum=$_GET['pagenum'];
  // 获取条数
  $pageSize=$_GET['pagesize'];
  // 获取分类
  $catId=$_GET['catid'];

  // 起始索引
  $start = ($pageNum-1)*$pageSize;


  $sql="select * from blogs where cat_id = $catId LIMIT $start,$pageSize";
  $sql2="select count(*) as 'total' from blogs where cat_id = $catId";

  $data=my_query($sql);
  $data2=my_query($sql2);

  $res=[
    'code'=>200,
    'total'=>$data2[0]['total'],
    'data'=>$data
  ];

  if($data===false){
    echo json(['code'=>400,'message'=>'未找到数据']);
  }else{
    echo json($res);
  }
?>