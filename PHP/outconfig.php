<!DOCTYPE html>
<html>
<head>
    <title></title>

    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <link href="/Style/pages1.css" type="text/css" rel="stylesheet">
    <link href="/Style/dgstyle.css" type="text/css" rel="stylesheet">




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

            width: 100px;

            height: 30px;
            text-align:center;
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


<div>
    <?php

    include("phpmydatagrid.class.php");
    include("conn.php");
    $objGrid = new datagrid;


    $objGrid->conectadb("localhost","root","Fzlcc123","WMS");
    $objGrid->language("en");
    //最后一列显示的功能键，从左向右功能为“新增键”、“编辑键”、“删除键”、“浏览键”。
    $objGrid->buttons(true,true,true,true);
    //修改数值时产生的Form名称
    $objGrid->form('ItemId', true);
    //where
    $objGrid->where("");
    //可检索列名
    $objGrid->searchby("ItemId,Adress");
    //需要读取的表
    $objGrid->tabla("tboutlist");
    //索引值用于修改数据
    $objGrid->keyfield("ItemId");
    //分页显示行数
    $objGrid->datarows(10);
    //默认排序方式
    $objGrid->orderby("Adress", "ASC");
    //显示列设置，相关设置可参考phpmydatagrid.class.php
    $objGrid->FormatColumn("OutNo", "No", 30, 30, 0, "150", "center");
    $objGrid->FormatColumn("ItemId", "ItemId", 30, 30, 0, "150", "center");
    $objGrid->FormatColumn("Adress", "Adress", 30, 30, 0, "150", "center");
    $objGrid->FormatColumn("Count", "Count", 30, 30, 0, "50", "center");
    $objGrid->FormatColumn("Partment", "Part", 30, 30, 0, "150", "center");
    $objGrid->FormatColumn("LotNo", "LotNo", 30, 30, 0, "150", "center");

    $objGrid->checkable();
    $objGrid->setHeader();
    $objGrid->ajax('silent');
    echo '<html>
      <head><title>PHPDataGrid</title></head>
      <body><div align="center"><br />';
    //生成DataGrid
    $objGrid->grid();


    echo '</div></body></html>';
    ?>




    </div>




</html>
