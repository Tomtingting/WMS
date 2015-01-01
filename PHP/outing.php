<!DOCTYPE html>
<html>
<head>
    <title></title>

    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <link href="/Style/pages1.css" type="text/css" rel="stylesheet">
    <style type="text/css">
        .file-box{ position:relative;top:20px;left:20px;width:800px}
        .txt{ height:30px; border:1px solid #cdcdcd; width:300px;}
        .btn{ background-color:#FFF; border:1px solid #CDCDCD;height:30px; width:100px;}
        .file{ position:absolute; top:50px; left:50px;filter:alpha(opacity:0);opacity: 0;height:30px;width:350px }
        #outing{
            position:absolute;
            top:100px;
            left:20px;
            width: 800px;

        }
        tr td{

            width: 00px;

            height: 30px;
            text-align:center;
        }
        #bt{
            position: absolute;
            top:120px;
            left:300px;
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

        function dochange(str)
        {
            var obj=document.getElementsByTagName("input");
            for(var i=0;i<obj.length;i++)
                if(obj[i].type=="radio" && obj[i].value==str)
                    obj[i].checked=true;
        }
        function doradio(){
            var obj=document.getElementsByTagName("input");
            for(var i=0;i<obj.length;i++)
                if(obj[i].type=="radio" && obj[i].checked)
                    document.all.t1.value=obj[i].value
        }
    </script>



</head>

<body>
<div class="file-box">
    <form name="frm1"  action="loadoutcsv.php"  method="post" enctype="multipart/form-data">
        <p>FIFO出库单导入：</p>
        <input type='text' name='textfield' id='textfield' class='txt' />
        <input type='button' class='btn'  value='浏览...' />
        <input type="file" name="filename" class="file" id="fileField" size="28" onchange="document.getElementById('textfield').value=this.value" />
        <input type="submit" name="submit" class="btn" value="导入" />
    </form>


</div>

<div id="outing">
    <table  id="tb">

        <thead>



        <tr style="background-color: #9ec4ff">

            <p>选择要打印出库单：</p>
            <td>选择单号</td>
            <td>出库单号</td>
            <td>操作</td>


        </tr>
        </thead>
        <tbody>
        <?php
        session_start();


        include_once("conn.php");
        include_once("PageClass.php");
        $page=$_GET['page'];
        $sql="select * from tbcheckout where state=0 GROUP by OutNo";
        $query=mysql_query($sql);
        $totail=mysql_num_rows($query);
        $number = 10;//每页显示条数

        $my_page=new PageClass($totail,$number,$page,'?page={page}');//参数设定：总记录，每页显示的条数，当前页，连接的地址
        //echo $sql;

        $sql_p = "select OutNo from tbcheckout where state=0 GROUP by OutNo LIMIT ".$my_page->page_limit.",".$my_page->myde_size;

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

            <form name="frm2"  action="outupdate.php"  method="post" enctype="multipart/form-data">
                <tr>
                    <td id="td"><input onclick="doradio()" type="radio" name="r1" value=<?php echo $row['OutNo']?>></td>
                    <td id="td"><?php echo $row['OutNo']?></td>
                    <td id="td"><input type="submit" value="分解入库单" onclick="window.location("wms:8888/PHP/outupdate.php")"></td>

                </tr>
            </form>


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



</body>

</html>