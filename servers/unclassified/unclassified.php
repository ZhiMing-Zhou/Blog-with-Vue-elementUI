<?php
  include_once('../fn.php');

  // 获取页码
  $pageNum=$_GET['pagenum'];
  // 获取条数
  $pageSize=$_GET['pagesize'];
  // 起始索引
  $start = ($pageNum-1)*$pageSize;

  $str = '';

  $sql="select id from categories";
  $result = my_query($sql);

  for($i=0; $i<count($result); $i++){
    $str=$str.$result[$i]['id'].',';
  }

  $str='('.substr($str,0,strlen($str)-1).')';

  $sql2="select * from blogs where cat_id not in $str limit $start,$pageSize";
  $result2 = my_query($sql2);

  
  // // 获取条数
  $sql3="select count(*) as  'total' from blogs where cat_id not in $str";
  $result3 = my_query($sql3);

  $res=[
    'code'=>200,
    'total'=>$result3[0]['total'],
    'data'=>$result2
  ];

  if($result2===false){
    echo json(['code'=>400,'message'=>'未找到匹配数据']);
  }else{
    echo json($res);
  }
?>