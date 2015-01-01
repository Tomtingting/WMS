<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link href="/Style/pages.css" type="text/css" rel="stylesheet">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>

    <style type="text/css">
        tr td{

            width: 200px;

            height: 30px;
            text-align:center;
        }
        #result{
            position:absolute;
            top:100px;
            left:0;

            height: 500px;
            overflow:hidden；
        }
        #frm{
            position: absolute;

        }
    </style>
    <script type="text/javascript">

        // 隔行换色
        window.onload = function(){ //页面所有元素加载完毕
            var item  =  document.getElementById("tb");			//获取id为tb的元素(table)
            var tbody =  item.getElementsByTagName("tbody")[0];	//获取表格的第一个tbody元素
            var trs =   tbody.getElementsByTagName("tr");	        //获取tbody元素下的所有tr元素
            for(var i=0;i < trs.length;i++){//循环tr元素
                if(i%2==0){        //取模. (取余数.比如 0%2=0 , 1%2=1 , 2%2=0 , 3%2=1)
                    trs[i].style.backgroundColor = "#B2FFFD"; // 改变 符合条件的tr元素 的背景色.

                }
            }
        }
        function toggle(targetid){
            if (document.getElementById){
                target=document.getElementById(targetid);
                if (target.style.display=="block"){
                    target.style.display="none";
                } else {
                    target.style.display="block";
                }
            }
        }
</script>

</head>

<body>
<form name="frm1"    method="post" enctype="multipart/form-data">
    <p>部品名称：</p>
    <input type='text' name='textfield' id='textfield' class='txt' />

    <input type="submit" name="submit" class="btn" value="查询" />
</form>


<div id="result" style="">


<table id="tb">
   <thead>
   <tr style="background-color: #9ec4ff">
       <td>部品名称</td>
       <td>在库数量</td>
       <td>LotNo</td>
       <td>地址码</td>

   </tr>
   </thead>
<tbody>
<?php
session_start();
include_once("conn.php");
include_once("PageClass.php");
$item=$_POST['textfield'];


$page=$_GET['page'];
$sql="select * from tbmaster where ItemId='".$item."'";
$query=mysql_query($sql);
$totail=mysql_num_rows($query);
$number = 10;//每页显示条数
$my_page=new PageClass($totail,$number,$page,'?page={page}');//参数设定：总记录，每页显示的条数，当前页，连接的地址
//echo $sql;

$sql_p = "select * from tbmaster where ItemId='".$item."'  LIMIT ".$my_page->page_limit.",".$my_page->myde_size;

$result = mysql_query($sql_p);
//echo $sql_p;


$rowcount=mysql_num_rows($result);
if($rowcount==0){
?>
<p><br/>
    没有找到记录！！
    <?php
    }
    else if($rowcount>0){

    $i=0;
    ?><?php
    while($i<$rowcount){

    $row = mysql_fetch_array($result);

    if(($i%2)==0){
        echo "<tr></tr>";
    }
    ?>
        <tr>

            <td id="td"><?php echo $row['ItemId']?></td>
            <td id="td"><?php echo $row['Count']?></td>
            <td id="td"><?php echo $row['LotNo']?></td>
            <td id="td"><?php echo $row['Adress']?></td>

        </tr>



<?php


$i++;
}
?>
</tbody>
</table>
    <p>
        <?php
        }
        ?>
    </p>
    <?php
    echo $my_page->myde_write1();//输出分页

    ?>
</div>
</html>