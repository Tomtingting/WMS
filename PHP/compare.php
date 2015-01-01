<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <style type="text/css">
        #incoming1{

            position: absolute;
            left:300px;
            top:0;
        }


    </style>
</head>
<body>
<div id="incoming">
    <table  id="tb" >

        <thead>

        <tr style="background-color: #9ec4ff">


            <td>部品名</td>
            <td>入库数量</td>


        </tr>
        </thead>
        <tbody>
<?php

include_once("conn.php");
$sql_tbincoming="select sum(QTY) from tbincoming group by ItemId";
$rs_tbincoming=mysql_query($sql_tbincoming);
$rt_tbincoming=mysql_num_rows($rs_tbincoming);
$sql_tbcheck="select sum(E) from tbcheck group by D";
$rs_tbcheck=mysql_query($sql_tbcheck);
$rt_tbcheck=mysql_num_rows($rs_tbcheck);
if($rt_tbincoming>$rt_tbcheck){


$sql="select ItemId,sum(QTY) as count from tbincoming where not exists(select D,sum(E) as count1 from tbcheck where tbincoming.ItemId=tbcheck.D  group by D) group by ItemId";
$query=mysql_query($sql);
$rowcount=mysql_num_rows($query);
if($rowcount==0){
?>
<p><br/>
    入库单数据与到货信息统计表数据一致！
    <?php
    }
    else if($rowcount>0){

    $i=0;
    ?><?php
    while($i<$rowcount){

        $row = mysql_fetch_array($query);
        if(($i%2)==0){
            echo "<tr></tr>";
        }
        ?>
<tr>

    <td id="td"><?php echo $row['ItemId']?></td>
    <td id="td"><?php echo $row['count']?></td>
</tr>
<?php
 $i++;
}

}
    }else{
        echo "数据错误";
    }
    ?>
        </tbody>


</table>
    <p>
        <?php

        ?>
    </p>
    </div>


</body>
</html>