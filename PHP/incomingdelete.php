<?php
session_start();
$no=$_SESSION['no'];
include_once("conn.php");

$sql="delete from tbincoming where IncomingNo='".$no."'";
$result = mysql_query($sql);
$sql_a="delete from tbcheck where IncomingNo='".$no."'";
$result1= mysql_query($sql_a);


echo"<script>window.location='http://wms:8888/PHP/incomingconfig.php';</script>";





?>