<?php
header('content-type:text/html;charset=utf-8');
header('Access-Control-Allow-Origin:*');

define('HOST', '127.0.0.1');
define('USER', 'root');
define('PASSWORD', 'root');
define('DATABASE', 'mikesblogs');


/**
 * 非查询语句执行
 * 
 */
function my_exec($sql)
{
  $link = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
  $ret = mysqli_query($link, $sql);
  if ($ret == false) {
    // echo 'sql execute failed';
  } else {
    // echo 'sql execute success';
  };
  mysqli_close($link);
  return $ret;
};


/**
 * 查询语句执行
 * 
 */
function my_query($sql)
{
  $link = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
  //查询语句获取到的是一个结果集，或者false
  $ret = mysqli_query($link, $sql);
  //获取结果集的条数
  $num = mysqli_num_rows($ret);
  if (!$ret || $num == 0) {
    // echo "未获取到数据";
    return false;
  }
  $data = [];
  for ($i = 0; $i < $num; $i++) {
    $data[] = mysqli_fetch_assoc($ret);
  };
  mysqli_close($link);
  return $data;
};

/**
 * 数据转JSON格式
 * 
 */
function json($data){
  $result = array(
    "data"=>$data
  );

  return json_encode($result);
}
?>