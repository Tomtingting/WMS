<?php
session_start();


require_once('conn.php');  //连接mysql数据库

//调用phpexcel类库
require_once 'Classes/PHPExcel.php';
require_once 'Classes/PHPExcel/IOFactory.php';


$dt=date("Y-m-d").'/'.date("H:i:s");
$objPHPExcel = new PHPExcel();
// Set properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
    ->setLastModifiedBy("Maarten Balliauw")
    ->setTitle("原材料中间在库清单")//题目
    ->setSubject("Office 2007 XLSX Test Document")
    ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")//描述
    ->setKeywords("office 2007 openxml php")//关键字
    ->setCategory("Test result file");//种类
/*设置单元格的标题*/
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:B2');//合并单元格
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', '原材料盘点表');
//设置font
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->setSize(24);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
//水平居中===垂直居中
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3','日期');
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A3')->getFont()->setSize(18);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A3')->getFont()->setBold(true);

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B3',$dt);
//设置font
$objPHPExcel->setActiveSheetIndex(0)->getStyle('B3')->getFont()->setSize(18);

//水平居中===垂直居中
$objPHPExcel->setActiveSheetIndex(0)->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('B3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->setActiveSheetIndex(0)->getStyle('B3')->getFont()->setBold(true);

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A4','部品名称');
//设置font


//水平居中===垂直居中
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A4')->getFont()->setSize(20);

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B4','库存数量');
$objPHPExcel->setActiveSheetIndex(0)->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('B4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('B4')->getFont()->setSize(20);



$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('A')->setWidth(20);//表示设置A这一列的宽度,以下一样
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('B')->setWidth(20);


$objPHPExcel->setActiveSheetIndex(0)->getStyle('A')->getFont()->setSize(20);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('B')->getFont()->setSize(20);


$sqlgroups="select * from tbzjzk order by ItemId asc ";
$resultgroups=mysql_query($sqlgroups);
$numrows=mysql_num_rows($resultgroups);
if ($numrows>0)
{
    $count=4;
    while($data=mysql_fetch_array($resultgroups))
    {
        $count+=1;
        $l1="A"."$count";
        $l2="B"."$count";


        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue($l1, $data['ItemId'])
            ->setCellValue($l2, $data['Count']);


    }
}

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('盘点清单');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="中间在库盘点表.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>