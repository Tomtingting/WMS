<?php
session_start();
$no=$_SESSION['no'];
include_once("conn.php");

$sql="select * from tbincoming where IncomingNo='".$no."'";
//echo $sql;
$result = mysql_query($sql);

$rowcount=mysql_num_rows($result);

$print=0;
for($i=0;$i<$rowcount;$i++){
    $row=mysql_fetch_array($result);

    $sql_p="INSERT INTO tbmaster(ItemId,Count,LotNo,Adress,BoxCount,Print) VALUES('".$row['ItemId']."',".$row['QTY'].",'".$row['Lot']."','".$row['Adress']."','".$row['Boxcount']."','".$print."')";
    //echo $sql_p;

    $result1=mysql_query($sql_p) or die (mysql_error());
    $state=1;
    $sql_s="update tbincoming set state='".$state."'";
    mysql_query("set names utf8");
    $result1=mysql_query($sql_s) or die (mysql_error());
    }

?>