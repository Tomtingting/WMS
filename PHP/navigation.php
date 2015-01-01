<?php
session_start();
include('PHP/conn.php');
$sql=mysql_query("select * from tbuser where Username='".$_SESSION['admin_name']."'");
$info=mysql_fetch_array($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
</head>
<body>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td height="26" align="right" text-align="left"><font color="#ffffff" fonr-size="30px" font-weight="900" line-height="50px" >当前登录用户：<?php echo $_SESSION['admin_name'];?></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                </tr>
</table>
</body>
</html>
