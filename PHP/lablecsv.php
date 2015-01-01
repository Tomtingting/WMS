<?
include_once("conn.php");
$result = mysql_query("SELECT Adress FROM tbmaster WHERE count=0 order by Adress asc");
$str = "地址码\n";
$str = iconv('utf-8','gb2312',$str);
while($row=mysql_fetch_array($result))
{
    $r = iconv('utf-8','gb2312',$row['Adress']); //中文转码

    $str .= $r."\n"; //用引文逗号分开
}
$filename = 'Address'.'.csv'; //设置文件名
export_csv($filename,$str); //导出
function export_csv($filename,$data)
{
    header("Content-type:text/csv");
    header("Content-Disposition:attachment;filename=".$filename);
    header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
    header('Expires:0');
    header('Pragma:public');
    echo $data;
}
$result1=mysql_query("delete from tbmaster where count=0");
?>