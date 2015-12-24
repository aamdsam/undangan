<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Asia/Singapore');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once '../Classes/PHPExcel.php';
include "../../../config/koneksi.php";

$queabsdetail = "SELECT * from data_telepon";
$exequeabsdetail = mysql_query($queabsdetail);
while($res = mysql_fetch_array($exequeabsdetail)){

	$data['id'][] = $res['id'];
	$data['nik'][] = $res['nik'];
	$data['no_telepon'][] = $res['no_telepon'];
	$data['nama'][] = $res['nama'];
	$data['ket'][] = $res['ket'];
	
	
	

} 
$jm = sizeof($data['id']);
 
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
$objPHPExcel->getActiveSheet()->getStyle('B:C')->getNumberFormat()->setFormatCode("0");

// Set document properties
$objPHPExcel->getProperties()->setCreator("Muhammad Muammar")
							 ->setLastModifiedBy("Muhammad Muammar")
							 ->setTitle("Office 2003 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");


// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'id')
            ->setCellValue('B1', 'nik')
			->setCellValue('C1', 'no_telepon')
			->setCellValue('D1', 'nama')
			->setCellValue('E1', 'ket');

// Miscellaneous glyphs, UTF-8
$y=0;
$t=$jm+2;
for ($i=2; $i<$t; $i++) {
	$objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $data['id'][$y])
								  ->setCellValue('B' . $i, $data['nik'][$y])
								  ->setCellValue('C' . $i, $data['no_telepon'][$y])
								  ->setCellValue('D' . $i, $data['nama'][$y])
								  ->setCellValue('E' . $i, $data['ket'][$y]);
	$y++;
}

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);

$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);


// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('data_telepon');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="data_telepon.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 2015 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
