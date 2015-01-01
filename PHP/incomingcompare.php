<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <style>
        tr td{

            width: 300px;

            height: 30px;
            text-align:center;
        }
        #frm1{
            display:block;
            position: absolute;

        }
#frm2{
    position: absolute;
    left:50px;
}
        #frm3{
position: absolute;
            left:100px;
        }
        input{
            font-size: 10px;
        }
        #config{
            position: absolute;
            top:30px;

        }
     .check1{
         position: absolute;
         top:50px;
     }
        .bt{
            width: 50px;
            height: 20px;
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
            </script>
</head>
<body>
<div id="config">
    <form action="incomingconfig.php" id="frm1">
    <input type="submit" value="返回" class="bt" onclick="window.location("wms:8888/PHP/incomingconfig.php")">
    </form>
    <form action="incomingdelete.php" method="post" id="frm2">
        <input type="submit" value="删除" class="bt"  onclick="window.location("wms:8888/PHP/incomingdelete.php")">
    </form>
    <form action="incomingupdate.php" method="post" id="frm3">
        <input type="submit" value="确认入库" class="bt"  onclick="window.location("wms:8888/PHP/incomingupdate.php")">
        </form>
</div>
<div class="check1">
    <table id="tb">
        <thead>

        <tr style="background-color: #9ec4ff">

        <td>部品名称</td>
        <td>数量</td>
        </tr>
        </thead>
        <tbody>
        <?php
        session_start();

        $No=$_POST['r1'];
        $_SESSION['no']=$No;
        include_once("conn.php");

        $sql="select b.* from(select ItemId,sum(QTY) as count from tbincoming where IncomingNo='".$No."' group by ItemId)a right join (select D,sum(E) as count1 from tbcheck where IncomingNo='".$No."' group by D)b on a.ItemId=b.D and a.count=b.count1 where a.ItemId is null ";
        $result = mysql_query($sql);
        //echo $sql;
        $rowcount=mysql_num_rows($result);
        if($rowcount==0){
        ?>
        <p><br/>
            入库单数据与到货信息统计表数据一致，请点击确认入库！！
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

                        <td id="td"><?php echo $row['D']?></td>
                        <td id="td"><?php echo $row['count1']?></td>
                    </tr>
                    <?php
                    $i++;
                }
                ?>

            <?
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>