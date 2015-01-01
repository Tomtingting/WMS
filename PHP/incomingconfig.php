<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link href="/Style/pages1.css" type="text/css" rel="stylesheet">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>

    <style type="text/css">
        #incoming{
            position:absolute;
           top:100px;
           left:0;
            width: 800px;

        }
        tr td{

            width: 100px;

            height: 30px;
            text-align:center;
        }
        #title{
            position: absolute;
            top:68px;
            left:220px;
            font-size:15px;

        }
        #title1{
            position: absolute;
            top:0;
            left:10px;
            font-size:15px;

        }
        #text{
            position: absolute;
            top:0;
            left:0;
            font-size: 15px;
        }
        #config{
           position: absolute;
            top:80px;
            left:650px;
            font-size: 15px;
            float: right;
            display:none;

        }
        #sub{
            float: left;
        }
        .file-box{ position:relative;top:10px;left:150px;}
        .txt{  solid #cdcdcd; font-size: 15px;position: absolute;top:45px;left: 0;}
        .btn{ background-color:#FFF; border:1px solid #CDCDCD;height:25px; width:50px;position:relative;left: 80px;top:48px;}
        .file{ position:absolute; top:30px; left:200px; height:30px;filter:alpha(opacity:0);opacity: 0;width:280px }
        .check{position: absolute;
              top:130px;
            left:640px;
            width: 800px;
        }
        .check1{position: absolute;
            top:130px;
            left:850px;
            width: 800px;
        }
        /*css3隔行换色*/

        /*tr:nth-child（odd）{*/

        /*background: ＃cad9ea;*/

        /*}*/
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
        function compare()
        {
            document.frm3.action="incomingcompare.php";

        }
        function incomingdelete()
        {
            document.frm2.action="incomingdelete.php";
            document.frm2.submit();
        }
    </script>



</head>

<body>


<div id="title1">
    <p >选择需确认入库单：</p>
    <p >到货信息统计表导入：</p>


</div>

<div class="file-box">
    <form name="frm1" action="loadcsv.php"  method="POST" enctype="multipart/form-data">
        <input type="text" name="t1" id="t1" onchange="dochange(this.value)">
        <input type='text' name='textfield' id='textfield' class='txt' />
        <input type='button' class='btn'  value='浏览...' />
        <input type="file" name="filename" class="file" id="fileField" size="28" onchange="document.getElementById('textfield').value=this.value" />
        <input type="submit" name="submit" class="btn" value="导入" />
    </form>

</div>

<div id="incoming">
<table  id="tb" >

    <thead>

    <tr style="background-color: #9ec4ff">


        <td>选择单号</td>
        <td>入库单号</td>

        <td>操作</td>

 </tr>
    </thead>
    <tbody>
    <?php

    include_once("conn.php");
    include_once("PageClass.php");
    $page=$_GET['page'];
    $sql="select * from tbincoming where state=0 GROUP by IncomingNo";
    $query=mysql_query($sql);
    $totail=mysql_num_rows($query);
    $number = 10;//每页显示条数
    $my_page=new PageClass($totail,$number,$page,'?page={page}');//参数设定：总记录，每页显示的条数，当前页，连接的地址
    //echo $sql;

    $sql_p = "select IncomingNo from tbincoming where state=0 GROUP by IncomingNo LIMIT ".$my_page->page_limit.",".$my_page->myde_size;

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


        <form name="frm2"  action="incomingcompare.php" method="post">
<tr>
                <td id="td"><input type="radio" name="r1" id="r1" onclick="doradio()"  value=<?php echo $row['IncomingNo']?>></td>
                <td id="td"><?php echo $row['IncomingNo']?></td>




                <td id="td"><input type="submit"  name="btn" value="对比" onclick="window.location("wms:8888/PHP/incomingcompare.php")"/></td>




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

