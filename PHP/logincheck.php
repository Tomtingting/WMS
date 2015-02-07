<?php
  session_start();
 include_once("conn.php");
 $username=$_POST["user"];
 $pwd=$_POST["password"];
 $result=mysql_query("select * from tbuser where UserId='$username' and password='$pwd'");
 $info=mysql_fetch_array($result);

if($info==true){
    echo"<script>window.location='http://127.0.0.1:8888/index.php';</script>";
    $count=$info['logincount'];
    $count++;
    $date=date('Y-m-d H-i-s');
    $sql=mysql_query("update tbuser set logincount='$count',logindate='$date' where UserId='$username'");
    $_SESSION['admin_name']=$info['Username'];


 }else{
     echo"<script language='javascript'>alert('Username is Wrong');history.back();</script>";
     exit;
 }
?>