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


</style>
    <script type="text/javascript">

        // 隔行换色
        window.onload = function(){ //页面所有元素加载完毕
            var item  =  document.getElementById("tb");			//获取id为tb的元素(table)
            var tbody =  item.getElementsByTagName("tbody")[0];	//获取表格的第一个tbody元素
            var tds =   tbody.getElementsByTagName("td");	        //获取tbody元素下的所有td元素
            for(var i=0;i < tds.length;i++){//循环tr元素
                if(i%2==0){        //取模. (取余数.比如 0%2=0 , 1%2=1 , 2%2=0 , 3%2=1)
                    tds[i].style.backgroundColor = "#B2FFFD"; // 改变 符合条件的td元素 的背景色.

                }
            }
        }

    </script>
</head>
        <body>
      <div id="print">
          <form name="frm1"  action="lablecsv.php"  method="post" enctype="multipart/form-data">
          <input type="submit" value="导出" />
          </form>
          <table  id="tb" >
            <thead>
            <tr style="background-color: #9ec4ff">
                <td>地址码</td>
                <td>地址码</td>
                <td>地址码</td>
                <td>地址码</td>

            </tr>
            </thead>

            <tbody>
            <?php

            include_once("conn.php");
            include_once("PageClass.php");
            $page=$_GET['page'];
            $sql_d="select Adress,sum(Count) as count from tbmaster group by Adress";

            $result13=mysql_query($sql_d);
            $rowcount2=mysql_num_rows($result13);
            for($k=0;$k<$rowcount2;$k++){
            $row5=mysql_fetch_array($result13);

            $adress=$row5['Adress'];

            $count3=$row5['count'];
            if($count3>0){

                $sql_e="update tbmaster set Print=0 where Adress='".$adress."'";
                $result14=mysql_query($sql_e) or die (mysql_error());;

            }
            }
            $sql="select * from tbmaster where count<=0 and Print=1 group by Adress asc";
            $query=mysql_query($sql);
            $totail=mysql_num_rows($query);
            $number = 40;//每页显示条数
            $my_page=new PageClass($totail,$number,$page,'?page={page}');//参数设定：总记录，每页显示的条数，当前页，连接的地址

            $sql_p = "SELECT * FROM tbmaster WHERE count<=0 and Print=1 group by Adress order by Adress asc LIMIT ".$my_page->page_limit.",".$my_page->myde_size;

            $result = mysql_query($sql_p);


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
                    if(($i%4)==0){
                        echo "<tr></tr>";
                    }
                    ?>




    <td id="td"><?php echo $row['Adress']?></td>
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