<?php
session_start();
header("Content-type:text/html;charset:utf-8");
//全局变量
date_default_timezone_set('PRC');
$succ_result=0;
$error_result=0;
$file=$_FILES['filename'];
$max_size="2000000"; //最大文件限制（单位：byte）
$fname=$file['name'];
$ftype=strtolower(substr(strrchr($fname,'.'),1));
//文件格式
$No=$_POST['t1'];
$uploadfile=$file['tmp_name'];
if($_SERVER['REQUEST_METHOD']=='POST'){
    if(is_uploaded_file($uploadfile)){
        if($file['size']>$max_size){
            echo "Import file is too large";
            exit;
        }
        if($ftype!='csv'){
            echo "Import file type is error";
            exit;
        }
    }else{
        echo "The file is not empty!";
        exit;
    }
}

require_once('conn.php');  //连接mysql数据库
$row=0;//统计数据行数

$handle=fopen($uploadfile,'r');
while(!feof($handle) && $data=fgetcsv($handle,1000,',')){
    $arr_result=array();
    if($row==1){//第三行开始导入
        $row++;
        continue;
    }
    if($row>0 && !empty($data)){
        $num=count($data);
        for($i=0;$i<$num;$i++){
            array_push($arr_result,$data[$i]);
        }



        $sql="insert into tbcheck (IncomingNo,D,E) values ('$No','".$arr_result[3]."','".$arr_result[4]."')";
        //echo $sql;
        mysql_query("set names utf8");
        $result=mysql_query($sql);
        if($result){
            echo ("<script>alert('插入成功.$row.条数据！！！');history.go(-1);</script>");
        }else{
            echo "插入失败！！！";
        }
    }
    $row++;
}
fclose($handle);

?>