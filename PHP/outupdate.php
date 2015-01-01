<!DOCTYPE html>
<html>
<head>
    <title></title>

    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>

    <style type="text/css">

    </style>
    <script type="text/javascript">


    </script>
</head>

<body>
<div id="bt">
    <p>出库单分解完成，请点击打印按钮！</p>

    <form  action="outprint.php" method="post" enctype="multipart/form-data">

        <input type="submit" name="btn" value="打印" onclick="window.open("wms:8888/PHP/outprint.php")"/>
    </form>

</div>
</body>
</html>








<?php
/*
插入tboutlist表，并更新数据库数据


*/

session_start();


$No=$_POST['r1'];
$_SESSION['no']=$No;
include("conn.php");

$datetime=date("Y-m-d H:i:s");//获取当前时间
$sql_p="select OutNo,G,E,R,T,U,V,W,X,Y from tbcheckout where OutNo='".$No."' group by G,E,T,R";
//echo $sql_p;
$result=mysql_query($sql_p);

$print1=0;
$state=1;
$rowcount1=mysql_num_rows($result);
for($j=0;$j<$rowcount1;$j++){
    $row=mysql_fetch_array($result);
    $outno=$row['OutNo'];
    $itemid=$row['G'];
    $partment=$row['E'];
    $partno=$row['PartNo'];
    $lotno=$row['T'];
    $count=$row['U'];
    $lotno1=$row['V'];
    $count1=$row['W'];
    $lotno2=$row['X'];
    $count2=$row['Y'];
    if(empty($lotno1)){
        $sql="INSERT INTO tboutlist(OutNo,ItemId,Count,Partment,LotNo,PartNo,Sysdata,Print) VALUES('".$row['OutNo']."','".$row['G']."','".$row['U']."','".$row['E']."','".$row['T']."','".$row['R']."','".$datetime."','".$print1."')";
        //echo $sql;
        mysql_query("set names utf8");
        $result1=mysql_query($sql) or die (mysql_error());
        $sql20="update tbcheckout set state='".$state."' where OutNo='".$No."' and G='".$itemid."' and E='".$partment."'";
        $result31=mysql_query($sql20);
    }
    elseif(empty($lotno2)){
        $sql="INSERT INTO tboutlist(OutNo,ItemId,Count,Partment,LotNo,PartNo,Sysdata,Print) VALUES('".$row['OutNo']."','".$row['G']."','".$row['U']."','".$row['E']."','".$row['T']."','".$row['R']."','".$datetime."','".$print1."')";
        //echo $sql;
        mysql_query("set names utf8");
        $result1=mysql_query($sql) or die (mysql_error());
        $sql1="INSERT INTO tboutlist(OutNo,ItemId,Count,Partment,LotNo,PartNo,Sysdata,Print) VALUES('".$row['OutNo']."','".$row['G']."','".$row['W']."','".$row['E']."','".$row['V']."','".$row['R']."','".$datetime."','".$print1."')";
        //echo $sql;
        mysql_query("set names utf8");
        $result1=mysql_query($sql1) or die (mysql_error());
        $sql20="update tbcheckout set state='".$state."' where OutNo='".$No."' and G='".$itemid."' and E='".$partment."'";
        $result31=mysql_query($sql20);
    }
    else{
        $sql="INSERT INTO tboutlist(OutNo,ItemId,Count,Partment,LotNo,PartNo,Sysdata,Print) VALUES('".$row['OutNo']."','".$row['G']."','".$row['U']."','".$row['E']."','".$row['T']."','".$row['R']."','".$datetime."','".$print1."')";
        //echo $sql;
        mysql_query("set names utf8");
        $result1=mysql_query($sql) or die (mysql_error());
        $sql1="INSERT INTO tboutlist(OutNo,ItemId,Count,Partment,LotNo,PartNo,Sysdata,Print) VALUES('".$row['OutNo']."','".$row['G']."','".$row['W']."','".$row['E']."','".$row['V']."','".$row['R']."','".$datetime."','".$print1."')";
        //echo $sql;
        mysql_query("set names utf8");
        $result1=mysql_query($sql1) or die (mysql_error());
        $sql2="INSERT INTO tboutlist(OutNo,ItemId,Count,Partment,LotNo,PartNo,Sysdata,Print) VALUES('".$row['OutNo']."','".$row['G']."','".$row['Y']."','".$row['E']."','".$row['X']."','".$row['R']."','".$datetime."','".$print1."')";
        //echo $sql;
        mysql_query("set names utf8");
        $result1=mysql_query($sql2) or die (mysql_error());
        $sql20="update tbcheckout set state='".$state."' where OutNo='".$No."' and G='".$itemid."' and E='".$partment."'";
        $result31=mysql_query($sql20);
    }



}
/*
 判断中间库是否支出&&更新中间在库库存
 */
$print=1;

$sql33="select ItemId,sum(Count)as count from tboutlist where OutNo='".$No."' group by ItemId";

$result19=mysql_query($sql33);
$rowcount3=mysql_num_rows($result19);
for($i=0;$i<$rowcount3;$i++){

    $row9=mysql_fetch_array($result19);
    $e=$row9['ItemId'];
    $g=$row9['count'];

    $sql8="select * from tbzjzk where ItemId='".$e."'";

    $result20=mysql_query($sql8);
    $row10=mysql_fetch_array($result20);
    $rowcount4=mysql_num_rows($result20);
    if($rowcount4==0){
        $sql4="select Boxcount from tbmaster where ItemId='".$e."' group by ItemId";

        $result16=mysql_query($sql4);
        $row7=mysql_fetch_array($result16);
        $rowcount9=mysql_num_rows($result16);
        $boxcount=$row7['Boxcount'];
        $box=ceil($g/$boxcount);
        $zjcount=$boxcount*$box;
        $zccount1=$zjcount-$g;

        if($zccount1>=0){
        $sql6="INSERT INTO tboutprint(OutNo,ItemId,Adress1,Count1,Adress2,Count2,Adress3,Count3,Partment1,Ct1,Partment2,Ct2,Partment3,Ct3,Partment4,Ct4,Partment5,Ct5,Partment6,Ct6,Box,Count,Sysdata,Print) VALUES('".$No."','".$e."','','','','','','','','','','','','','','','','','','','".$box."','".$zjcount."','".$datetime."','".$print1."')";
        $result18=mysql_query($sql6);

        $sql7="INSERT INTO tbzjzk(ItemId,Count) VALUES('".$row9['ItemId']."','".$zccount1."')";
        $result18=mysql_query($sql7) or die (mysql_error());;
        /*
                   更新tboutprint数据库
                   */

        $sql9="select ItemId,sum(Count)as count,Partment,LotNo from tboutlist where OutNo='".$No."' and ItemId='".$row9['ItemId']."' group by ItemId,Partment ";

        $result22=mysql_query($sql9);
        $rowcount5=mysql_num_rows($result22);
        for($j=0;$j<$rowcount5;$j++){

            $row11=mysql_fetch_array($result22);
            $item=$row11['ItemId'];
            $ct=$row11['count'];
            $part=$row11['Partment'];
            $lot=$row11['LotNo'];


            switch ($j){
                case 0:
                    $sql12="update tboutprint set Partment1='".$part."',Ct1='".$ct."' where OutNo='".$No."' and ItemId='".$item."'";
                    $result24=mysql_query($sql12);
                    break;

                case 1:
                    $sql12="update tboutprint set Partment2='".$part."',Ct2='".$ct."' where OutNo='".$No."' and ItemId='".$item."'";
                    $result24=mysql_query($sql12);
                    break;

                case 2:
                    $sql12="update tboutprint set Partment3='".$part."',Ct3='".$ct."' where OutNo='".$No."' and ItemId='".$item."'";
                    $result24=mysql_query($sql12);
                    break;

                case 3:
                    $sql12="update tboutprint set Partment4='".$part."',Ct4='".$ct."' where OutNo='".$No."' and ItemId='".$item."'";
                    $result24=mysql_query($sql12);
                    break;

                case 4:
                    $sql12="update tboutprint set Partment5='".$part."',Ct5='".$ct."' where OutNo='".$No."' and ItemId='".$item."'";
                    $result24=mysql_query($sql12);
                    break;

                case 5:
                    $sql12="update tboutprint set Partment6='".$part."',Ct6='".$ct."' where OutNo='".$No."' and ItemId='".$item."'";
                    $result24=mysql_query($sql12);
                    break;
            }


        }
        /*
            更新tbmaster数据库
        */

        $sql13="select ItemId,sum(Count)as count,LotNo from tboutlist where OutNo='".$No."' and ItemId='".$row9['ItemId']."' group by ItemId,LotNo ";
        $result25=mysql_query($sql13);
        $rowcount6=mysql_num_rows($result25);

        for($z=0;$z<$rowcount6;$z++){


            $row14=mysql_fetch_array($result25);
            $a=$row14['ItemId'];
            $b=$row14['count'];
            $c=$row14['LotNo'];

            $sql17="select ItemId,Count,Adress,Boxcount from tbmaster  where ItemId='".$a."' and Count!=0 and Lotno='".$c."' and Count>0 Limit 1";
            $result21=mysql_query($sql17);
            $rowcount7=mysql_num_rows($result21);
            if($rowcount7==0){
                break;
            }

            $row11=mysql_fetch_array($result21);
            $m=$row11['ItemId'];
            $n=$row11['Adress'];
            $o=$row11['Count'];
            $s=$row11['Boxcount'];
            $h=$o-$zjcount;

            if($h<0 and abs($h)>=$s){
                $sql15="update tbmaster set Count=0,Print='".$print."' where ItemId='".$m."' and Adress='".$n."'";
                $result26=mysql_query($sql15);

                $sql18="update tboutprint set Adress1='".$n."',Count1='".$o."' where OutNo='".$No."' and ItemId='".$m."'";
                $result29=mysql_query($sql18);

                $sql14="select ItemId,Count,Adress,Boxcount from tbmaster  where ItemId='".$a."' and Count!=0 and Lotno='".$c."' and Count>0 Limit 1";
                $result27=mysql_query($sql14);
                $rowcount8=mysql_num_rows($result27);
                if($rowcount8==0){
                    break;
                }
                $row13=mysql_fetch_array($result27);
                $d=$row13['ItemId'];
                $q=$row13['Count'];
                $r=$row13['Adress'];
                $t=$row13['Boxcount'];
                $u=$q-abs($h);
                $box1=ceil(abs($h)/$t);
                $bcount=$t*$box1;
                $bu=$q-$bcount;
                if($u<0&&abs($u)>=$t){
                    $sql15="update tbmaster set Count=0,Print='".$print."' where ItemId='".$d."' and Adress='".$r."'";
                    $result26=mysql_query($sql15);

                    $sql18="update tboutprint set Adress2='".$r."',Count2='".$q."' where OutNo='".$No."' and ItemId='".$d."'";
                    $result29=mysql_query($sql18);

                    $sql14="select ItemId,Count,Adress,Boxcount from tbmaster  where ItemId='".$a."' and Count!=0 and Lotno='".$c."' and Count>0 Limit 1";
                    $result27=mysql_query($sql14);
                    $rowcount8=mysql_num_rows($result27);
                    if($rowcount8==0){
                        break;
                    }
                    $row18=mysql_fetch_array($result27);
                    $v=$row18['ItemId'];
                    $w=$row18['Count'];
                    $x=$row18['Adress'];
                    $y=$row18['Boxcount'];
                    $z1=$w-abs($u);
                    $box2=ceil(abs($u)/$y);
                    $bcount1=$y*$box2;
                    $bu1=$w-$bcount1;
                    if($z1<0&&abs($z1)>=$y){
                        $sql15="update tbmaster set Count=0,Print='".$print."' where ItemId='".$v."' and Adress='".$x."'";
                        $result26=mysql_query($sql15);
                        $sql18="update tboutprint set Adress3='".$x."',Count3='".$w."' where OutNo='".$No."' and ItemId='".$v."'";
                        $result29=mysql_query($sql18);
                        $sql14="select ItemId,Count,Adress,Boxcount from tbmaster  where ItemId='".$a."' and Count!=0 and Lotno='".$c."' and Count>0 Limit 1";
                        $result27=mysql_query($sql14);
                        $rowcount8=mysql_num_rows($result27);
                        if($rowcount8==0){
                            break;
                        }
                        $row17=mysql_fetch_array($result27);
                        $a1=$row17['ItemId'];
                        $a2=$row17['Count'];
                        $a3=$row17['Adress'];
                        $a4=$row17['Boxcount'];
                        $a5=$a2-abs($z1);
                        $a6=ceil(abs($z1)/$a4);
                        $a7=$a4*$a6;
                        $a8=$a2-$a7;
                        if($a5<0&&abs($a5)>=$a4){
                            $sql15="update tbmaster set Count=0,Print='".$print."' where ItemId='".$a1."' and Adress='".$a3."'";
                            $result26=mysql_query($sql15);
                            $sql18="update tboutprint set Adress4='".$a3."',Count4='".$a2."' where OutNo='".$No."' and ItemId='".$a1."'";
                            $result29=mysql_query($sql18);
                            $sql14="select ItemId,Count,Adress,Boxcount from tbmaster  where ItemId='".$a."' and Count!=0 and Lotno='".$c."' and Count>0 Limit 1";
                            $result27=mysql_query($sql14);
                            $rowcount8=mysql_num_rows($result27);
                            if($rowcount8==0){
                                break;
                            }
                            $row19=mysql_fetch_array($result27);
                            $b1=$row19['ItemId'];
                            $b2=$row19['Count'];
                            $b3=$row19['Adress'];
                            $b4=$row19['Boxcount'];
                            $b5=$b2-abs($a5);
                            $b6=ceil(abs($a5)/$b4);
                            $b7=$b4*$b6;
                            $b8=$b2-$b7;
                            if($b5<0&&abs($b5>=$b4)){
                                $sql15="update tbmaster set Count=0,Print='".$print."' where ItemId='".$b1."' and Adress='".$b3."'";
                                $result26=mysql_query($sql15);
                                $sql18="update tboutprint set Adress5='".$b3."',Count5='".$b2."' where OutNo='".$No."' and ItemId='".$b1."'";
                                $result29=mysql_query($sql18);
                                 }
                            elseif($b5>0&&abs($b5)>=$b4){
                                $sql19="update tbmaster set Count='".$b8."' where ItemId='".$b1."' and Adress='".$b3."'";
                                $result30=mysql_query($sql19);
                                $sql18="update tboutprint set Adress5='".$b3."',Count5='".$b7."' where OutNo='".$No."' and ItemId='".$b1."'";
                                $result29=mysql_query($sql18);
                                $sql31="select * from tbzjzk where ItemId='".$b1."'";
                                $result42=mysql_query($sql31);
                                $row21=mysql_fetch_array($result42);
                                $b9=$row21['Count'];
                                $b10=$b9+($b7-abs($a5));
                                $sql32="update tbzjzk set Count='".$b10."' where ItemId='".$b1."'";
                                $result43=mysql_query($sql32);

                            }
                            elseif($b5>0&&abs($b5)<$b4){
                                $sql19="update tbmaster set Count=0,print='".$print."'  where ItemId='".$b1."' and Adress='".$b3."'";
                                $result30=mysql_query($sql19);

                                $sql18="update tboutprint set Adress5='".$b3."',Count5='".$b2."' where OutNo='".$No."' and ItemId='".$b1."'";
                                $result29=mysql_query($sql18);
                                $sql31="select * from tbzjzk where ItemId='".$b1."'";
                                $result42=mysql_query($sql31);
                                $row21=mysql_fetch_array($result42);
                                $b9=$row21['Count'];
                                $b10=$b9+$b5;
                                $sql32="update tbzjzk set Count='".$b10."' where ItemId='".$b1."'";
                                $result43=mysql_query($sql32);
                            }
                            else{
                                $sql25="update tbmaster set Count='".$b5."',print='".$print."' where ItemId='".$b1."' and Adress='".$b3."'";
                                $result36=mysql_query($sql25);

                                $sql26="update tboutprint set Adress5='".$b3."',Count5='".$b2."' where OutNo='".$No."' and ItemId='".$b1."'";
                                $result37=mysql_query($sql26);
                            }

                                }

                        elseif($a5>0&&abs($a5)>=$a4){
                            $sql19="update tbmaster set Count='".$a8."' where ItemId='".$a1."' and Adress='".$a3."'";
                            $result30=mysql_query($sql19);
                            $sql18="update tboutprint set Adress4='".$a3."',Count4='".$a7."' where OutNo='".$No."' and ItemId='".$a1."'";
                            $result29=mysql_query($sql18);
                            $sql31="select * from tbzjzk where ItemId='".$a1."'";
                            $result42=mysql_query($sql31);
                            $row20=mysql_fetch_array($result42);
                            $a9=$row20['Count'];
                            $a10=$a9+($a7-abs($z));
                            $sql32="update tbzjzk set Count='".$a10."' where ItemId='".$a1."'";
                            $result43=mysql_query($sql32);

                        }
                        elseif($a5>0&&abs($a5)<$a4){
                            $sql19="update tbmaster set Count=0,print='".$print."'  where ItemId='".$a1."' and Adress='".$a3."'";
                            $result30=mysql_query($sql19);

                            $sql18="update tboutprint set Adress4='".$a3."',Count4='".$a2."' where OutNo='".$No."' and ItemId='".$a1."'";
                            $result29=mysql_query($sql18);
                            $sql31="select * from tbzjzk where ItemId='".$a1."'";
                            $result42=mysql_query($sql31);
                            $row20=mysql_fetch_array($result42);
                            $a9=$row20['Count'];
                            $a10=$a9+$a5;
                            $sql32="update tbzjzk set Count='".$a10."' where ItemId='".$a1."'";
                            $result43=mysql_query($sql32);
                        }
                        else{
                            $sql25="update tbmaster set Count='".$a5."',print='".$print."' where ItemId='".$a1."' and Adress='".$a3."'";
                            $result36=mysql_query($sql25);

                            $sql26="update tboutprint set Adress4='".$a3."',Count4='".$a2."' where OutNo='".$No."' and ItemId='".$a1."'";
                            $result37=mysql_query($sql26);
                        }
                    }
                    elseif($z1>0&&abs($z1)>=$y){
                        $sql19="update tbmaster set Count='".$bu1."' where ItemId='".$v."' and Adress='".$x."'";
                        $result30=mysql_query($sql19);
                        $sql18="update tboutprint set Adress3='".$x."',Count3='".$bcount1."' where OutNo='".$No."' and ItemId='".$v."'";
                        $result29=mysql_query($sql18);
                        echo $sql18;
                        $sql31="select * from tbzjzk where ItemId='".$v."'";
                        $result42=mysql_query($sql31);
                        $row16=mysql_fetch_array($result42);
                        $zjzkct2=$row16['Count'];
                        $zjct2=$zjzkct2+($bcount1-abs($u));
                        $sql32="update tbzjzk set Count='".$zjct2."' where ItemId='".$v."'";
                        $result43=mysql_query($sql32);

                    }
                    elseif($z1>0&&abs($z1)<$y){
                        $sql19="update tbmaster set Count=0,print='".$print."'  where ItemId='".$v."' and Adress='".$x."'";
                        $result30=mysql_query($sql19);

                        $sql18="update tboutprint set Adress3='".$x."',Count3='".$w."' where OutNo='".$No."' and ItemId='".$v."'";
                        $result29=mysql_query($sql18);
                        $sql31="select * from tbzjzk where ItemId='".$v."'";
                        $result42=mysql_query($sql31);
                        $row16=mysql_fetch_array($result42);
                        $zjzkct2=$row16['Count'];
                        $zjct2=$zjzkct2+$z1;
                        $sql32="update tbzjzk set Count='".$zjct2."' where ItemId='".$v."'";
                        $result43=mysql_query($sql32);
                    }
                    else{
                        $sql25="update tbmaster set Count='".$z1."',print='".$print."' where ItemId='".$v."' and Adress='".$x."'";
                        $result36=mysql_query($sql25);

                        $sql26="update tboutprint set Adress3='".$x."',Count3='".$w."' where OutNo='".$No."' and ItemId='".$v."'";
                        $result37=mysql_query($sql26);
                    }
                }
                elseif($u>0&&abs($u)>=$t){

                    $sql19="update tbmaster set Count='".$bu."' where ItemId='".$d."' and Adress='".$r."'";
                    $result30=mysql_query($sql19);

                    $sql18="update tboutprint set Adress2='".$r."',Count2='".$bcount."' where OutNo='".$No."' and ItemId='".$d."'";
                    $result29=mysql_query($sql18);
                    $sql29="select * from tbzjzk where ItemId='".$d."'";
                    $result40=mysql_query($sql29);
                    $row16=mysql_fetch_array($result40);
                    $zjzkct1=$row16['Count'];
                    $zjct1=$zjzkct1+($bcount-abs($h));
                    $sql30="update tbzjzk set Count='".$zjct1."' where ItemId='".$d."'";
                    $result41=mysql_query($sql30);

                }
                elseif($u>0&&abs($u)<$t){
                    $sql19="update tbmaster set Count=0,print='".$print."'  where ItemId='".$d."' and Adress='".$r."'";
                    $result30=mysql_query($sql19);

                    $sql18="update tboutprint set Adress2='".$r."',Count2='".$q."' where OutNo='".$No."' and ItemId='".$d."'";
                    $result29=mysql_query($sql18);
                    $sql29="select * from tbzjzk where ItemId='".$d."'";
                    $result40=mysql_query($sql29);
                    $row16=mysql_fetch_array($result40);
                    $zjzkct1=$row16['Count'];
                    $zjct1=$zjzkct1+$u;
                    $sql30="update tbzjzk set Count='".$zjct1."' where ItemId='".$d."'";
                    $result41=mysql_query($sql30);
                }
                else{
                    $sql23="update tbmaster set Count='".$u."',print='".$print."' where ItemId='".$d."' and Adress='".$r."'";
                    $result34=mysql_query($sql23);

                    $sql24="update tboutprint set Adress2='".$r."',Count2='".$q."' where OutNo='".$No."' and ItemId='".$d."'";
                    $result35=mysql_query($sql24);

                }
            }
            elseif($h>0&&abs($h)>=$s){


                $sql19="update tbmaster set Count='$h' where ItemId='".$m."' and Adress='".$n."'";
                $result30=mysql_query($sql19);

                $sql18="update tboutprint set Adress1='".$n."',Count1='".$zjcount."' where OutNo='".$No."' and ItemId='".$m."'";
                $result29=mysql_query($sql18);



            }
            elseif($h>0&&abs($h)<$s){
                $sql19="update tbmaster set Count=0,print='".$print."' where ItemId='".$m."' and Adress='".$n."'";
                $result30=mysql_query($sql19);

                $sql18="update tboutprint set Adress1='".$n."',Count1='".$o."' where OutNo='".$No."' and ItemId='".$m."'";
                $result29=mysql_query($sql18);
                $sql27="select * from tbzjzk where ItemId='".$m."'";
                $result38=mysql_query($sql27);
                $row15=mysql_fetch_array($result38);
                $zjzkct=$row15['Count'];
                $zjct=$zjzkct+$h;
                $sql28="update tbzjzk set Count='".$zjct."' where ItemId='".$m."'";
                $result39=mysql_query($sql28);
            }
            else{
                $sql21="update tbmaster set Count='".$h."',print='".$print."' where ItemId='".$m."' and Adress='".$n."'";
                $result32=mysql_query($sql21);

                $sql22="update tboutprint set Adress1='".$n."',Count1='".$o."' where OutNo='".$No."' and ItemId='".$m."'";
                $result33=mysql_query($sql22);
            }
        }

        }

 }
    else{
            $zjcount1=$row10['Count'];
            $zccount=$zjcount1-$g;

            if($zccount<0){
                /*
         更新tbzjzk数据库
         */

                $sql4="select Boxcount from tbmaster where ItemId='".$e."' group by ItemId";
                $result16=mysql_query($sql4);

                $row7=mysql_fetch_array($result16);
                $boxcount=$row7['Boxcount'];
                $box=ceil(abs($zccount)/$boxcount);
                $zjcount=$boxcount*$box;
                $zjcount2=$zjcount+$zjcount1-$g;
                $sql5="update tbzjzk set Count='$zjcount2' where ItemId='".$e."'";
                $result17=mysql_query($sql5);

                $sql6="INSERT INTO tboutprint(OutNo,ItemId,Adress1,Count1,Adress2,Count2,Adress3,Count3,Partment1,Ct1,Partment2,Ct2,Partment3,Ct3,Partment4,Ct4,Partment5,Ct5,Partment6,Ct6,Box,Count,Sysdata,Print) VALUES('".$No."','".$e."','','','','','','','','','','','','','','','','','','','".$box."','".$zjcount."','".$datetime."','".$print1."')";
                $result18=mysql_query($sql6);

                /*
                         更新tbmaster数据库
                     */

                $sql13="select ItemId,sum(Count)as count,LotNo from tboutlist where OutNo='".$No."' and print=0 and ItemId='".$e."' group by ItemId,LotNo ";
                $result25=mysql_query($sql13);
                $rowcount6=mysql_num_rows($result25);
                for($z=0;$z<$rowcount6;$z++){


                    $row14=mysql_fetch_array($result25);
                    $a=$row14['ItemId'];
                    $b=$row14['count'];
                    $c=$row14['LotNo'];


                    $sql17="select ItemId,Count,Adress,Boxcount from tbmaster  where ItemId='".$a."' and Count!=0 and Lotno='".$c."' and Count>0 Limit 1";

                    $result21=mysql_query($sql17);
                    $rowcount7=mysql_num_rows($result21);
                    if($rowcount7==0){
                        break;
                    }
                    $row11=mysql_fetch_array($result21);
                    $m=$row11['ItemId'];
                    $n=$row11['Adress'];
                    $o=$row11['Count'];
                    $s=$row11['Boxcount'];


                    $h=$o-$zjcount;

                    if($h<0 and abs($h)>=$s){
                        $sql15="update tbmaster set Count=0,Print='".$print."' where ItemId='".$m."' and Adress='".$n."'";
                        $result26=mysql_query($sql15);
                        $sql18="update tboutprint set Adress1='".$n."',Count1='".$o."' where OutNo='".$No."' and ItemId='".$m."'";
                        $result29=mysql_query($sql18);
                        $sql14="select ItemId,Count,Adress,Boxcount from tbmaster  where ItemId='".$a."' and Count!=0 and Lotno='".$c."' and Count>0 Limit 1";
                        $result27=mysql_query($sql14);
                        $rowcount8=mysql_num_rows($result27);
                        if($rowcount8==0){
                            break;
                        }
                        $row13=mysql_fetch_array($result27);
                        $d=$row13['ItemId'];
                        $q=$row13['Count'];
                        $r=$row13['Adress'];
                        $t=$row13['Boxcount'];
                        $u=$q-abs($h);
                        $box1=ceil(abs($h)/$t);
                        $bcount=$t*$box1;
                        $bu=$q-$bcount;
                        if($u<0&&abs($u)>=$t){
                            $sql15="update tbmaster set Count=0,Print='".$print."' where ItemId='".$d."' and Adress='".$r."'";
                            $result26=mysql_query($sql15);

                            $sql18="update tboutprint set Adress2='".$r."',Count2='".$q."' where OutNo='".$No."' and ItemId='".$d."'";
                            $result29=mysql_query($sql18);

                            $sql14="select ItemId,Count,Adress,Boxcount from tbmaster  where ItemId='".$a."' and Count!=0 and Lotno='".$c."' and Count>0 Limit 1";
                            $result27=mysql_query($sql14);
                            $rowcount8=mysql_num_rows($result27);
                            if($rowcount8==0){
                                break;
                            }
                            $row18=mysql_fetch_array($result27);
                            $v=$row18['ItemId'];
                            $w=$row18['Count'];
                            $x=$row18['Adress'];
                            $y=$row18['Boxcount'];
                            $z1=$w-abs($u);

                            $box2=ceil(abs($u)/$y);
                            $bcount1=$y*$box2;
                            $bu1=$w-$bcount1;
                            if($z1<0&&abs($z1)>=$y){
                                $sql15="update tbmaster set Count=0,Print='".$print."' where ItemId='".$v."' and Adress='".$x."'";
                                $result26=mysql_query($sql15);
                                $sql18="update tboutprint set Adress3='".$x."',Count3='".$w."' where OutNo='".$No."' and ItemId='".$v."'";
                                $result29=mysql_query($sql18);

                                $sql14="select ItemId,Count,Adress,Boxcount from tbmaster  where ItemId='".$a."' and Count!=0 and Lotno='".$c."' and Count>0 Limit 1";
                                $result27=mysql_query($sql14);
                                $rowcount8=mysql_num_rows($result27);
                                if($rowcount8==0){
                                    break;
                                }
                                $row17=mysql_fetch_array($result27);
                                $a1=$row17['ItemId'];
                                $a2=$row17['Count'];
                                $a3=$row17['Adress'];
                                $a4=$row17['Boxcount'];
                                $a5=$a2-abs($z1);
                                $a6=ceil(abs($z1)/$a4);
                                $a7=$a4*$a6;
                                $a8=$a2-$a7;
                                if($a5<0&&abs($a5)>=$a4){
                                    $sql15="update tbmaster set Count=0,Print='".$print."' where ItemId='".$a1."' and Adress='".$a3."'";
                                    $result26=mysql_query($sql15);
                                    $sql18="update tboutprint set Adress4='".$a3."',Count4='".$a2."' where OutNo='".$No."' and ItemId='".$a1."'";
                                    $result29=mysql_query($sql18);
                                    $sql14="select ItemId,Count,Adress,Boxcount from tbmaster  where ItemId='".$a."' and Count!=0 and Lotno='".$c."' and Count>0 Limit 1";
                                    $result27=mysql_query($sql14);
                                    $rowcount8=mysql_num_rows($result27);
                                    if($rowcount8==0){
                                        break;
                                    }
                                    $row19=mysql_fetch_array($result27);
                                    $b1=$row19['ItemId'];
                                    $b2=$row19['Count'];
                                    $b3=$row19['Adress'];
                                    $b4=$row19['Boxcount'];
                                    $b5=$b2-abs($a5);
                                    $b6=ceil(abs($a5)/$b4);
                                    $b7=$b4*$b6;
                                    $b8=$b2-$b7;
                                    if($b5<0&&abs($b5>=$b4)){
                                        $sql15="update tbmaster set Count=0,Print='".$print."' where ItemId='".$b1."' and Adress='".$b3."'";
                                        $result26=mysql_query($sql15);
                                        $sql18="update tboutprint set Adress5='".$b3."',Count5='".$b2."' where OutNo='".$No."' and ItemId='".$b1."'";
                                        $result29=mysql_query($sql18);
                                    }
                                    elseif($b5>0&&abs($b5)>=$b4){
                                        $sql19="update tbmaster set Count='".$b8."' where ItemId='".$b1."' and Adress='".$b3."'";
                                        $result30=mysql_query($sql19);
                                        $sql18="update tboutprint set Adress5='".$b3."',Count5='".$b7."' where OutNo='".$No."' and ItemId='".$b1."'";
                                        $result29=mysql_query($sql18);
                                        $sql31="select * from tbzjzk where ItemId='".$b1."'";
                                        $result42=mysql_query($sql31);
                                        $row21=mysql_fetch_array($result42);
                                        $b9=$row21['Count'];
                                        $b10=$b9+($b7-abs($a5));
                                        $sql32="update tbzjzk set Count='".$b10."' where ItemId='".$b1."'";
                                        $result43=mysql_query($sql32);

                                    }
                                    elseif($b5>0&&abs($b5)<$b4){
                                        $sql19="update tbmaster set Count=0,print='".$print."'  where ItemId='".$b1."' and Adress='".$b3."'";
                                        $result30=mysql_query($sql19);

                                        $sql18="update tboutprint set Adress5='".$b3."',Count5='".$b2."' where OutNo='".$No."' and ItemId='".$b1."'";
                                        $result29=mysql_query($sql18);
                                        $sql31="select * from tbzjzk where ItemId='".$b1."'";
                                        $result42=mysql_query($sql31);
                                        $row21=mysql_fetch_array($result42);
                                        $b9=$row21['Count'];
                                        $b10=$b9+$b5;
                                        $sql32="update tbzjzk set Count='".$b10."' where ItemId='".$b1."'";
                                        $result43=mysql_query($sql32);
                                    }
                                    else{
                                        $sql25="update tbmaster set Count='".$b5."',print='".$print."' where ItemId='".$b1."' and Adress='".$b3."'";
                                        $result36=mysql_query($sql25);

                                        $sql26="update tboutprint set Adress5='".$b3."',Count5='".$b2."' where OutNo='".$No."' and ItemId='".$b1."'";
                                        $result37=mysql_query($sql26);
                                    }

                                }

                                elseif($a5>0&&abs($a5)>=$a4){
                                    $sql19="update tbmaster set Count='".$a8."' where ItemId='".$a1."' and Adress='".$a3."'";
                                    $result30=mysql_query($sql19);
                                    $sql18="update tboutprint set Adress4='".$a3."',Count4='".$a7."' where OutNo='".$No."' and ItemId='".$a1."'";
                                    $result29=mysql_query($sql18);
                                    $sql31="select * from tbzjzk where ItemId='".$a1."'";
                                    $result42=mysql_query($sql31);
                                    $row20=mysql_fetch_array($result42);
                                    $a9=$row20['Count'];
                                    $a10=$a9+($a7-abs($z1));
                                    $sql32="update tbzjzk set Count='".$a10."' where ItemId='".$a1."'";
                                    $result43=mysql_query($sql32);

                                }
                                elseif($a5>0&&abs($a5)<$a4){
                                    $sql19="update tbmaster set Count=0,print='".$print."'  where ItemId='".$a1."' and Adress='".$a3."'";
                                    $result30=mysql_query($sql19);

                                    $sql18="update tboutprint set Adress4='".$a3."',Count4='".$a2."' where OutNo='".$No."' and ItemId='".$a1."'";
                                    $result29=mysql_query($sql18);
                                    $sql31="select * from tbzjzk where ItemId='".$a1."'";
                                    $result42=mysql_query($sql31);
                                    $row20=mysql_fetch_array($result42);
                                    $a9=$row20['Count'];
                                    $a10=$a9+$a5;
                                    $sql32="update tbzjzk set Count='".$a10."' where ItemId='".$a1."'";
                                    $result43=mysql_query($sql32);
                                }
                                else{
                                    $sql25="update tbmaster set Count='".$a5."',print='".$print."' where ItemId='".$a1."' and Adress='".$a3."'";
                                    $result36=mysql_query($sql25);

                                    $sql26="update tboutprint set Adress4='".$a3."',Count4='".$a2."' where OutNo='".$No."' and ItemId='".$a1."'";
                                    $result37=mysql_query($sql26);
                                }
                            }
                            elseif($z1>0&&abs($z1)>=$y){
                                $sql19="update tbmaster set Count='".$bu1."' where ItemId='".$v."' and Adress='".$x."'";
                                $result30=mysql_query($sql19);
                                $sql18="update tboutprint set Adress3='".$x."',Count3='".$bcount1."' where OutNo='".$No."' and ItemId='".$v."'";
                                $result29=mysql_query($sql18);
                                $sql31="select * from tbzjzk where ItemId='".$v."'";
                                $result42=mysql_query($sql31);
                                $row16=mysql_fetch_array($result42);
                                $zjzkct2=$row16['Count'];
                                $zjct2=$zjzkct2+($bcount1-abs($u));
                                $sql32="update tbzjzk set Count='".$zjct2."' where ItemId='".$v."'";
                                $result43=mysql_query($sql32);

                            }
                            elseif($z1>0&&abs($z1)<$y){
                                $sql19="update tbmaster set Count=0,print='".$print."'  where ItemId='".$v."' and Adress='".$x."'";
                                $result30=mysql_query($sql19);

                                $sql18="update tboutprint set Adress3='".$x."',Count3='".$w."' where OutNo='".$No."' and ItemId='".$v."'";
                                $result29=mysql_query($sql18);
                                $sql31="select * from tbzjzk where ItemId='".$v."'";
                                $result42=mysql_query($sql31);
                                $row16=mysql_fetch_array($result42);
                                $zjzkct2=$row16['Count'];
                                $zjct2=$zjzkct2+$z1;
                                $sql32="update tbzjzk set Count='".$zjct2."' where ItemId='".$v."'";
                                $result43=mysql_query($sql32);
                            }
                            else{
                                $sql25="update tbmaster set Count='".$z1."',print='".$print."' where ItemId='".$v."' and Adress='".$x."'";
                                $result36=mysql_query($sql25);

                                $sql26="update tboutprint set Adress3='".$x."',Count3='".$w."' where OutNo='".$No."' and ItemId='".$v."'";
                                $result37=mysql_query($sql26);
                            }
                        }
                        elseif($u>0&&abs($u)>=$t){
                            $sql19="update tbmaster set Count='".$bu."' where ItemId='".$d."' and Adress='".$r."'";
                            $result30=mysql_query($sql19);

                            $sql18="update tboutprint set Adress2='".$r."',Count2='".$bcount."' where OutNo='".$No."' and ItemId='".$d."'";
                            $result29=mysql_query($sql18);
                            $sql29="select * from tbzjzk where ItemId='".$d."'";
                            $result40=mysql_query($sql29);
                            $row16=mysql_fetch_array($result40);
                            $zjzkct1=$row16['Count'];
                            $zjct1=$zjzkct1+($bcount-abs($h));
                            $sql30="update tbzjzk set Count='".$zjct1."' where ItemId='".$d."'";
                            $result41=mysql_query($sql30);

                        }
                        elseif($u>0&&abs($u)<$t){
                            $sql19="update tbmaster set Count=0,print='".$print."'  where ItemId='".$d."' and Adress='".$r."'";
                            $result30=mysql_query($sql19);

                            $sql18="update tboutprint set Adress2='".$r."',Count2='".$q."' where OutNo='".$No."' and ItemId='".$d."'";
                            $result29=mysql_query($sql18);
                            $sql29="select * from tbzjzk where ItemId='".$d."'";
                            $result40=mysql_query($sql29);
                            $row16=mysql_fetch_array($result40);
                            $zjzkct1=$row16['Count'];
                            $zjct1=$zjzkct1+$u;
                            $sql30="update tbzjzk set Count='".$zjct1."' where ItemId='".$d."'";
                            $result41=mysql_query($sql30);
                        }
                        else{
                            $sql23="update tbmaster set Count='".$u."',print='".$print."' where ItemId='".$d."' and Adress='".$r."'";
                            $result34=mysql_query($sql23);

                            $sql24="update tboutprint set Adress2='".$r."',Count2='".$q."' where OutNo='".$No."' and ItemId='".$d."'";
                            $result35=mysql_query($sql24);
                        }
                    }
                    elseif($h>0&&abs($h)>=$s){


                        $sql19="update tbmaster set Count='$h' where ItemId='".$m."' and Adress='".$n."'";
                        $result30=mysql_query($sql19);

                        $sql18="update tboutprint set Adress1='".$n."',Count1='".$zjcount."' where OutNo='".$No."' and ItemId='".$m."'";
                        $result29=mysql_query($sql18);



                    }
                    elseif($h>0&&abs($h)<$s){
                        $sql19="update tbmaster set Count=0,print='".$print."' where ItemId='".$m."' and Adress='".$n."'";
                        $result30=mysql_query($sql19);

                        $sql18="update tboutprint set Adress1='".$n."',Count1='".$o."' where OutNo='".$No."' and ItemId='".$m."'";
                        $result29=mysql_query($sql18);
                        $sql27="select * from tbzjzk where ItemId='".$m."'";
                        $result38=mysql_query($sql27);
                        $row15=mysql_fetch_array($result38);
                        $zjzkct=$row15['Count'];
                        $zjct=$zjzkct+$h;
                        $sql28="update tbzjzk set Count='".$zjct."' where ItemId='".$m."'";
                        $result39=mysql_query($sql28);
                    }
                    else{
                        $sql21="update tbmaster set Count='".$h."',print='".$print."' where ItemId='".$m."' and Adress='".$n."'";
                        $result32=mysql_query($sql21);

                        $sql22="update tboutprint set Adress1='".$n."',Count1='".$o."' where OutNo='".$No."' and ItemId='".$m."'";
                        $result33=mysql_query($sql22);
                    }
                }

                /*
                更新tboutprint数据库
                */

                $sql9="select ItemId,sum(Count)as count,Partment,LotNo from tboutlist where OutNo='".$No."' and  ItemId='".$e."' and Print=0 group by ItemId,Partment ";
                $result22=mysql_query($sql9);

                $rowcount5=mysql_num_rows($result22);
                for($j=0;$j<$rowcount5;$j++){

                    $row11=mysql_fetch_array($result22);
                    $item=$row11['ItemId'];
                    $ct=$row11['count'];
                    $part=$row11['Partment'];
                    $lot=$row11['LotNo'];


                    switch ($j){
                        case 0:
                            $sql12="update tboutprint set Partment1='".$part."',Ct1='".$ct."' where OutNo='".$No."' and ItemId='".$item."'";
                            $result24=mysql_query($sql12);

                            break;

                        case 1:
                            $sql12="update tboutprint set Partment2='".$part."',Ct2='".$ct."' where OutNo='".$No."' and ItemId='".$item."'";
                            $result24=mysql_query($sql12);
                            break;

                        case 2:
                            $sql12="update tboutprint set Partment3='".$part."',Ct3='".$ct."' where OutNo='".$No."' and ItemId='".$item."'";
                            $result24=mysql_query($sql12);
                            break;

                        case 3:
                            $sql12="update tboutprint set Partment4='".$part."',Ct4='".$ct."' where OutNo='".$No."' and ItemId='".$item."'";
                            $result24=mysql_query($sql12);
                            break;

                        case 4:
                            $sql12="update tboutprint set Partment5='".$part."',Ct5='".$ct."' where OutNo='".$No."' and ItemId='".$item."'";
                            $result24=mysql_query($sql12);
                            break;

                        case 5:
                            $sql12="update tboutprint set Partment6='".$part."',Ct6='".$ct."' where OutNo='".$No."' and ItemId='".$item."'";
                            $result24=mysql_query($sql12);
                            break;
                    }

                }

            }
            else{
                $sql5="update tbzjzk set Count='".$zccount."' where ItemId='".$e."'";
                $result17=mysql_query($sql5);


            }

        }




    $sql10="update tboutlist set Print='".$print."' where OutNo='".$No."' and ItemId='".$e."'";
    $result23=mysql_query($sql10);


}
?>

