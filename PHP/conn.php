<?php
$conn=mysql_connect("localhost","root","Fzlcc123");
if (!$conn)
{
    die('Could not connect;'.mysql_error());
}
mysql_select_db("WMS", $conn);
?>