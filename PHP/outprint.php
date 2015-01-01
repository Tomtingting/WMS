<?php
session_start();

$No=$_SESSION['no'];
require_once('conn.php');  //连接mysql数据库

//调用phpexcel类库
require_once 'Classes/PHPExcel.php';
require_once 'Classes/PHPExcel/IOFactory.php';


$dt=date("Y-m-d").'/'.date("H:i:s");
$objPHPExcel = new PHPExcel();
// Set properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
    ->setLastModifiedBy("Maarten Balliauw")
    ->setTitle("出库单清单")//题目
    ->setSubject("Office 2007 XLSX Test Document")
    ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")//描述
    ->setKeywords("office 2007 openxml php")//关键字
    ->setCategory("Test result file");//种类
/*设置单元格的标题*/
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:U2');//合并单元格
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', '部品出库清单');
//设置font
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->setSize(24);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
//水平居中===垂直居中
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3','出库单号');
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A3')->getFont()->setSize(14);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A3')->getFont()->setBold(true);

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B3',$No);
//设置font
$objPHPExcel->setActiveSheetIndex(0)->getStyle('B3')->getFont()->setSize(14);

//水平居中===垂直居中
$objPHPExcel->setActiveSheetIndex(0)->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('B3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('B3')->getFont()->setSize(14);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('B3')->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D3','日期');
$objPHPExcel->setActiveSheetIndex(0)->getStyle('D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('D3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('D3')->getFont()->setSize(14);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('D3')->getFont()->setBold(true);

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E3',$dt);
//设置font
$objPHPExcel->setActiveSheetIndex(0)->getStyle('E3')->getFont()->setSize(14);

//水平居中===垂直居中
$objPHPExcel->setActiveSheetIndex(0)->getStyle('E3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('E3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('E3')->getFont()->setSize(14);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('E3')->getFont()->setBold(true);

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A4','部品名称');
//设置font


//水平居中===垂直居中
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A4')->getFont()->setSize(18);

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B4','箱数');
$objPHPExcel->setActiveSheetIndex(0)->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('B4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('B4')->getFont()->setSize(18);

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C4','总需求数量');
$objPHPExcel->setActiveSheetIndex(0)->getStyle('C4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('C4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('C4')->getFont()->setSize(18);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D4','地址码1');
$objPHPExcel->setActiveSheetIndex(0)->getStyle('D4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('D4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('D4')->getFont()->setSize(18);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E4','数量');
$objPHPExcel->setActiveSheetIndex(0)->getStyle('E4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('E4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('E4')->getFont()->setSize(18);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F4','地址码2');
$objPHPExcel->setActiveSheetIndex(0)->getStyle('F4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('F4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('F4')->getFont()->setSize(18);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G4','数量');
$objPHPExcel->setActiveSheetIndex(0)->getStyle('G4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('G4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('G4')->getFont()->setSize(18);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H4','地址码3');
$objPHPExcel->setActiveSheetIndex(0)->getStyle('H4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('H4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('H4')->getFont()->setSize(18);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I4','数量');
$objPHPExcel->setActiveSheetIndex(0)->getStyle('I4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('I4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('I4')->getFont()->setSize(18);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J4','地址码4');
$objPHPExcel->setActiveSheetIndex(0)->getStyle('J4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('J4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('J4')->getFont()->setSize(18);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K4','数量');
$objPHPExcel->setActiveSheetIndex(0)->getStyle('K4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('K4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('K4')->getFont()->setSize(18);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L4','地址码5');
$objPHPExcel->setActiveSheetIndex(0)->getStyle('L4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('L4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('L4')->getFont()->setSize(18);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M4','数量');
$objPHPExcel->setActiveSheetIndex(0)->getStyle('M4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('M4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('M4')->getFont()->setSize(18);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N4','职场1');
$objPHPExcel->setActiveSheetIndex(0)->getStyle('N4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('N4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('N4')->getFont()->setSize(18);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O4','数量');
$objPHPExcel->setActiveSheetIndex(0)->getStyle('O4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('O4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('O4')->getFont()->setSize(18);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P4','职场2');
$objPHPExcel->setActiveSheetIndex(0)->getStyle('P4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('P4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('P4')->getFont()->setSize(18);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q4','数量');
$objPHPExcel->setActiveSheetIndex(0)->getStyle('Q4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('Q4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('Q4')->getFont()->setSize(18);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('R4','职场3');
$objPHPExcel->setActiveSheetIndex(0)->getStyle('R4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('R4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('R4')->getFont()->setSize(18);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('S4','数量');
$objPHPExcel->setActiveSheetIndex(0)->getStyle('S4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('S4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('S4')->getFont()->setSize(18);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('T4','职场4');
$objPHPExcel->setActiveSheetIndex(0)->getStyle('T4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('T4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('T4')->getFont()->setSize(18);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('U4','数量');
$objPHPExcel->setActiveSheetIndex(0)->getStyle('U4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('U4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('U4')->getFont()->setSize(18);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('V4','职场5');
$objPHPExcel->setActiveSheetIndex(0)->getStyle('V4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('V4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('V4')->getFont()->setSize(18);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('W4','数量');
$objPHPExcel->setActiveSheetIndex(0)->getStyle('W4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('W4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('W4')->getFont()->setSize(18);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('X4','职场6');
$objPHPExcel->setActiveSheetIndex(0)->getStyle('X4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('X4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('X4')->getFont()->setSize(18);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Y4','数量');
$objPHPExcel->setActiveSheetIndex(0)->getStyle('Y4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('Y4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('Y4')->getFont()->setSize(18);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('A')->setWidth(20);//表示设置A这一列的宽度,以下一样
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('B')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('C')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('D')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('E')->setWidth(14);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('F')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('G')->setWidth(14);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('H')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('I')->setWidth(14);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('J')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('K')->setWidth(14);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('L')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('M')->setWidth(14);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('N')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('O')->setWidth(14);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('P')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('Q')->setWidth(14);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('R')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('S')->setWidth(14);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('T')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('U')->setWidth(14);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('V')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('W')->setWidth(14);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('X')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('Y')->setWidth(14);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A')->getFont()->setSize(20);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('B')->getFont()->setSize(20);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('C')->getFont()->setSize(20);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('D')->getFont()->setSize(20);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('E')->getFont()->setSize(20);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('F')->getFont()->setSize(20);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('G')->getFont()->setSize(20);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('H')->getFont()->setSize(20);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('I')->getFont()->setSize(20);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('J')->getFont()->setSize(20);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('K')->getFont()->setSize(20);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('L')->getFont()->setSize(20);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('M')->getFont()->setSize(20);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('N')->getFont()->setSize(20);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('O')->getFont()->setSize(20);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('P')->getFont()->setSize(20);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('Q')->getFont()->setSize(20);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('R')->getFont()->setSize(20);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('S')->getFont()->setSize(20);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('T')->getFont()->setSize(20);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('U')->getFont()->setSize(20);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('V')->getFont()->setSize(20);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('W')->getFont()->setSize(20);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('X')->getFont()->setSize(20);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('Y')->getFont()->setSize(20);
$sqlgroups="select * from tboutprint where OutNo='".$No."'";
$resultgroups=mysql_query($sqlgroups);
$numrows=mysql_num_rows($resultgroups);
if ($numrows>0)
{
    $count=4;
    while($data=mysql_fetch_array($resultgroups))
    {
        $count+=1;
        $l1="A"."$count";
        $l2="D"."$count";
        $l3="E"."$count";
        $l4="F"."$count";
        $l5="G"."$count";
        $l6="H"."$count";
        $l7="I"."$count";
        $l8="J"."$count";
        $l9="K"."$count";
        $l10="L"."$count";
        $l11="M"."$count";
        $l12="N"."$count";
        $l13="O"."$count";
        $l14="P"."$count";
        $l15="Q"."$count";
        $l16="R"."$count";
        $l17="S"."$count";
        $l18="T"."$count";
        $l19="U"."$count";
        $l20="V"."$count";
        $l21="W"."$count";
        $l22="X"."$count";
        $l23="Y"."$count";
        $l24="B"."$count";
        $l25="C"."$count";

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue($l1, $data['ItemId'])
            ->setCellValue($l2, $data['Adress1'])
            ->setCellValue($l3, $data['Count1'])
            ->setCellValue($l4, $data['Adress2'])
            ->setCellValue($l5, $data['Count2'])
            ->setCellValue($l6, $data['Adress3'])
            ->setCellValue($l7, $data['Count3'])
            ->setCellValue($l8, $data['Adress4'])
            ->setCellValue($l9, $data['Count4'])
            ->setCellValue($l10, $data['Adress5'])
            ->setCellValue($l11, $data['Count5'])
            ->setCellValue($l12, $data['Partment1'])
            ->setCellValue($l13, $data['Ct1'])
            ->setCellValue($l14, $data['Partment2'])
            ->setCellValue($l15, $data['Ct2'])
            ->setCellValue($l16, $data['Partment3'])
            ->setCellValue($l17, $data['Ct3'])
            ->setCellValue($l18, $data['Partment4'])
            ->setCellValue($l19, $data['Ct4'])
            ->setCellValue($l20, $data['Partment5'])
            ->setCellValue($l21, $data['Ct5'])
            ->setCellValue($l22, $data['Partment6'])
            ->setCellValue($l23, $data['Ct6'])
            ->setCellValue($l24, $data['Box'])
            ->setCellValue($l25, $data['Count']);
    }
}

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('出库清单');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="部品出库清单.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>