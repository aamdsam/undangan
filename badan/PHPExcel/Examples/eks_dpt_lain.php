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

$queabsdetail = "SELECT * from dpt_lain";
$exequeabsdetail = mysql_query($queabsdetail);
while($res = mysql_fetch_array($exequeabsdetail)){

	$data['id'][] = $res['id'];
	$data['kd_kab'][] = $res['kd_kab'];
	$data['kd_kec'][] = $res['kd_kec'];
	$data['kd_kel'][] = $res['kd_kel'];
	$data['tps'][] = $res['tps'];
	$data['no_kk'][] = $res['no_kk'];
	$data['nik'][] = $res['nik'];
	$data['nama'][] = $res['nama'];
	$data['tempat_lahir'][] = $res['tempat_lahir'];
	$data['tgl_lahir'][] = $res['tgl_lahir'];
	$data['umur'][] = $res['umur'];
	$data['status_kawin'][] = $res['status_kawin'];
	$data['jk'][] = $res['jk'];
	$data['alamat'][] = $res['alamat'];
	$data['rt'][] = $res['rt'];
	$data['rw'][] = $res['rw'];
	$data['ket'][] = $res['ket'];
	
	

} 
$jm = sizeof($data['id']);
 
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
$objPHPExcel->getActiveSheet()->getStyle('F:G')->getNumberFormat()->setFormatCode("0");

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
            ->setCellValue('B1', 'kd_kab')
			->setCellValue('C1', 'kd_kec')
			->setCellValue('D1', 'kd_kel')
			->setCellValue('E1', 'tps')
			->setCellValue('F1', 'no_kk')
			->setCellValue('G1', 'nik')
			->setCellValue('H1', 'nama')
			->setCellValue('I1', 'tempat_lahir')
			->setCellValue('J1', 'tgl_lahir')
			->setCellValue('K1', 'umur')
			->setCellValue('L1', 'status_kawin')
			->setCellValue('M1', 'jk')
			->setCellValue('N1', 'alamat')
			->setCellValue('O1', 'rt')
			->setCellValue('P1', 'rw')
			->setCellValue('Q1', 'ket');

// Miscellaneous glyphs, UTF-8
$y=0;
$t=$jm+2;
for ($i=2; $i<$t; $i++) {
	$objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $data['id'][$y])
								  ->setCellValue('B' . $i, $data['kd_kab'][$y])
								  ->setCellValue('C' . $i, $data['kd_kec'][$y])
								  ->setCellValue('D' . $i, $data['kd_kel'][$y])
								  ->setCellValue('E' . $i, $data['tps'][$y])
								  ->setCellValue('F' . $i, $data['no_kk'][$y])
								  ->setCellValue('G' . $i, $data['nik'][$y])
								  ->setCellValue('H' . $i, $data['nama'][$y])
								  ->setCellValue('I' . $i, $data['tempat_lahir'][$y])
								  ->setCellValue('J' . $i, $data['tgl_lahir'][$y])
								  ->setCellValue('K' . $i, $data['umur'][$y])
								  ->setCellValue('L' . $i, $data['status_kawin'][$y])
								  ->setCellValue('M' . $i, $data['jk'][$y])
								  ->setCellValue('N' . $i, $data['alamat'][$y])
								  ->setCellValue('O' . $i, $data['rt'][$y])
								  ->setCellValue('P' . $i, $data['rw'][$y])
								  ->setCellValue('Q' . $i, $data['ket'][$y]);
	$y++;
}

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);

$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);


// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('DP Sumber Lain');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="dpt_sumber_lain.xls"');
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
