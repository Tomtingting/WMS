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
$uploadfile=$file['tmp_name'];

if($_SERVER['REQUEST_METHOD']=='POST'){
    if(is_uploaded_file($uploadfile)){
        if($file['size']>$max_size){
            echo "Import file is too large";
            exit;
        }
        if($ftype!='xlsx'){
            echo "Import file type is error";
            exit;
        }
    }else{
        echo "The file is not empty!";
        exit;
    }
}
require_once('conn.php');  //连接mysql数据库

//调用phpexcel类库
require_once 'Classes/PHPExcel.php';
require_once 'Classes/PHPExcel/IOFactory.php';
require_once 'Classes/PHPExcel/Reader/Excel5.php';

$objReader = PHPExcel_IOFactory::createReader('Excel5');//use excel2003 和  2007 format

$objPHPExcel = PHPExcel_IOFactory::load($uploadfile);//改成这个写法就好了

$sheet = $objPHPExcel->getSheet(0);
$highestRow = $sheet->getHighestRow(); // 取得总行数
$highestColumn = $sheet->getHighestColumn(); // 取得总列数
$arr_result=array();
$strs=array();


//循环读取excel文件,读取一条,插入一条
for($j=2;$j<=$highestRow;$j++)
{
    unset($arr_result);
    unset($strs);
    for($k='A';$k<=$highestColumn;$k++)
    {
        $arr_result  .=$objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue().',';//读 取单元格
    }
    //explode:函 数把字符串分割为数组。
    $strs =explode(",",$arr_result);
    //var_dump ($strs);
    //die();

    $sql ="update tbmaster set Count='".$strs[2]."',LotNo='".$strs[3]."' where ItemId='".$strs[1]."' and Adress='".$strs[0]."'";
    //echo $sql."<br/>";

    mysql_query("set names utf8");
    $result=mysql_query($sql) or die (mysql_error());

    $insert_num=mysql_affected_rows();
    if($insert_num>0){
        $succ_result+=1;

    }else{
        $error_result+=1;
    }

}

echo ("<script>alert('更新成功.$succ_result.条数据！！！');history.go(-1);</script>");
echo "插入失败".$error_result."条数据！！！";

?>