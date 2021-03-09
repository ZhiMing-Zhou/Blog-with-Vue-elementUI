<?php
  include_once('../fn.php');

  $name=$_GET['name'];

  $password = $_GET['password'];

  $sql =  "select * from user where name = '$name'";

  $data = my_query($sql);

  if(empty($data)){
    $msg = '用户名或密码错误!';
    $res = [
      'msg'=>$msg,
      'code'=>400
    ];
    echo json($res);
  }else{
    $data=$data[0];
    if($password===$data['password']){
      $msg = '登陆成功!';
      $res = [
        'msg'=>$msg,
        'code'=>200
      ];
      echo json($res);
    }else{
      $msg = '用户名或密码错误!';
      $res = [
        'msg'=>$msg,
        'code'=>400
      ];
      echo json($res);
    }
  }
?>