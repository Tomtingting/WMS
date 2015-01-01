
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <title>WareHouse Management System</title>
    <link rel="stylesheet" type="text/css" href="/Style/login.css"/>

    <script src="/JS/login.js"></script>
</head>
<body>
<div id="container"><!--页面层容器-->
<div id="login">

    <form method="post"  action="/PHP/logincheck.php" id="myform" onsubmit="return check()" name="myform">


    <input  id="loginbutton" type="submit" value=""/>
    <input type="text" id="user" name="user" autofocus="autofocus"/>

    <input  id="password" type="password" name="password">


    </form>
   </div>
    </div>
</body>
</html>
