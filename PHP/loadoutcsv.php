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
$order_sn = date('ymd').substr(time(),-5).substr(microtime(),2,5);$ddnumber=substr(date("ymdHis"),2,8).mt_rand(1000,9999);//生成随机出库单号
$uploadfile=$file['tmp_name'];
$status=0;//入库单状态
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
$row=1;//统计数据行数

$handle=fopen($uploadfile,'r');
while(!feof($handle) && $data=fgetcsv($handle,1000,',')){
    $arr_result=array();
    if($row==0){//第一行开始导入
        $row++;
        continue;
    }
    if($row>0 && !empty($data)){
        $num=count($data);
        for($i=0;$i<$num;$i++){
            array_push($arr_result,$data[$i]);
        }



        $sql="insert into tbcheckout (OutNo,E,G,R,T,U,V,W,X,Y,state) values ('$order_sn','$arr_result[4]','$arr_result[6]','$arr_result[17]','$arr_result[19]','$arr_result[20]','$arr_result[21]','$arr_result[22]','$arr_result[23]','$arr_result[24]','$status')";
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