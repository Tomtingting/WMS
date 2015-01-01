<!DOCTYPE html>
<html>
<head>
    <title></title>

    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>

    <style type="text/css">
        .file-box{ position:relative;top:100px;left:150px;width:800px}
        .txt{ height:30px; border:1px solid #cdcdcd; width:300px;}
        .btn{ background-color:#FFF; border:1px solid #CDCDCD;height:30px; width:100px;}
        .file{ position:absolute; top:50px; left:50px;filter:alpha(opacity:0);opacity: 0;height:30px;width:350px }

    </style>




</head>

<body>
<div class="file-box">
    <form name="frm1"  action="zkexcel.php"  method="post" enctype="multipart/form-data">
        <p>部品在库导入：</p>
        <input type='text' name='textfield' id='textfield' class='txt' />
        <input type='button' class='btn'  value='浏览...' />
        <input type="file" name="filename" class="file" id="fileField" size="28" onchange="document.getElementById('textfield').value=this.value" />
        <input type="submit" name="submit" class="btn" value="导入" />
    </form>


</div>





</html>