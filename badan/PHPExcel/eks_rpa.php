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

$queabsdetail = "SELECT * from rpa";
$exequeabsdetail = mysql_query($queabsdetail);
while($res = mysql_fetch_array($exequeabsdetail)){

	$data['id'][] = $res['id'];
	$data['nama_skpd'][] = $res['nama_skpd'];
	$data['realisasi_keuangan'][] = $res['realisasi_keuangan'];
	$data['realisasi_fisik'][] = $res['realisasi_fisik'];
} 
$jm = sizeof($data['id']);

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");


// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'id')
            ->setCellValue('B1', 'nama_skpd')
            ->setCellValue('C1', 'realisasi_keuangan')
			->setCellValue('D1', 'realisasi_fisik');

// Miscellaneous glyphs, UTF-8
$y=0;
$t=$jm+2;
for ($i=2; $i<$t; $i++) {
	$objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $data['id'][$y])
	                              ->setCellValue('B' . $i, $data['nama_skpd'][$y])
								  ->setCellValue('C' . $i, $data['realisasi_keuangan'][$y])
								  ->setCellValue('D' . $i, $data['realisasi_fisik'][$y]);
	$y++;
}


// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('neraca');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="rencana_pelaksanaan_anggaran.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
