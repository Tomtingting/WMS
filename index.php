<?php
include("PHP/cklogin.php");
include("PHP/conn.php");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <title>WareHouse Management System</title>
    <link rel="stylesheet" type="text/css" href="/Style/mainmenu.css"/>

    <script src="/JS/menu.js">


    </script>


</head>

<body>

<div id="container"><!--页面层容器-->
    <div id="header">
        <div id="topTags">
            <ul>
            </ul>
        </div>
        <div id="dateside">

            <ul id="datetime">
                <script type=text/javascript>
                    today = new Date();
                    function initArray() {
                        this.length = initArray.arguments.length
                        for (var i = 0; i < this.length; i++)
                            this[i + 1] = initArray.arguments[i]
                    }
                    var d = new initArray(
                        "星期日",
                        "星期一",
                        "星期二",
                        "星期三",
                        "星期四",
                        "星期五",
                        "星期六",
                        "星期日");
                    document.write(
                        "<font color=#ffffff style='font-size:20px'>今天是：",
                        today.getFullYear(), "年",
                        today.getMonth() + 1, "月",
                        today.getDate(), "日 ",
                        d[today.getDay() + 1],
                        "</font>");
                    var displaymode = 0

                    if (displaymode == 0)
                        document.write(iframecode);
                    function jumpto(inputurl) {
                        if (document.getElementById && displaymode == 0)
                            document.getElementById("external").src = inputurl
                        else if (document.all && displaymode == 0)
                            document.all.external.src = inputurl
                        else {
                            if (!window.win2 || win2.closed)
                                win2 = window.open(inputurl)
                            else {
                                win2.location = inputurl
                                win2.focus()
                            }
                        }
                    }
                </script>
            </ul>
        </div>

        <ul id="user">
            <?php include("PHP/navigation.php"); ?>
        </ul>

    </div>
    <!--头部文件-->
    <div id="content"><!--内容部分-->

        <div id="main">

            <div id="welcome" class="content">
                <div align="center">
                    <iframe id="external"
                            style="width:900px;height:720px;position: relative;margin-top:0;right:50px;border: 0;"></iframe>
                </div>
            </div>
            <div id="c0" class="content">

            </div>
            <div id="c1" class="content">

            </div>
        </div>
        <!--主体部分-->

        <div id="sidebar">

            <ul class="menu">

                <li><a>入库管理</a>
                    <ul>

                        <li><a href="javascript:jumpto('/PHP/lableprint.php')">空货位打印</a></li>

                        <li><a href="javascript:jumpto('/PHP/incoming.php')">入库数据导入</a></li>
                        <li><a href="javascript:jumpto('/PHP/incomingconfig.php')">入库单确认</a></li>

                    </ul>
                </li>

                <li><a>出库管理</a>
                    <ul>
                        <li><a href="javascript:jumpto('/PHP/outing.php')">出库单导入</a></li>
                        <li><a href="#">出库单确认</a></li>
                    </ul>
                </li>
                <li><a>库存管理</a>
                    <ul>

                        <li><a href="javascript:jumpto('/PHP/itemsearch.php')">部品查询</a></li>
                        <li><a href="javascript:jumpto('/PHP/zjitemsearch.php')">部品中间在库查询</a></li>
                        <li><a href="javascript:jumpto('/PHP/pandian.php')">部品盘点</a></li>

                        <li><a href="javascript:jumpto('/PHP/zjsearch.php')">部品中间在库盘点</a></li>
                        <li><a href="javascript:jumpto('/PHP/zkupdate.php')">部品在库更新</a></li>
                        <li><a href="javascript:jumpto('/PHP/zjupdate.php')">部品中间在库更新</a></li>
                    </ul>
                </li>
                <li><a>部品状态管理</a></li>
                <li><a>系统管理</a>
                    <ul>
                        <li><a>用户修改</a></li>
                        <li><a>密码修改</a></li>
                    </ul>
                </li>
            </ul>

        </div>
        <!--侧边栏-->
    </div>
    <div id="footer">Fujikura Changchun Ltd.</div>
    <!--底部-->
</div>
</body>
</html>