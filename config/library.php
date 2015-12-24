<?php
ob_start();
session_start();

date_default_timezone_set('Asia/Singapore'); // PHP 6 mengharuskan penyebutan timezone.
$seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
$hari = date("w");
$hari_ini = $seminggu[$hari];

$tgl_sekarang = date("Y-m-d");
$tgl_skrg     = date("d");
$bln_sekarang = date("m");
$thn_sekarang = date("Y");
$jam_sekarang = date("H:i:s");

$nama_bln=array(1=> "Januari", "Februari", "Maret", "April", "Mei", 
                    "Juni", "Juli", "Agustus", "September", 
                    "Oktober", "November", "Desember");
					



function jml_minggu($tgl_awal, $tgl_akhir){
$detik = 24 * 3600;
$tgl_awal = strtotime($tgl_awal);
$tgl_akhir = strtotime($tgl_akhir);

$minggu = 0;
for ($i=$tgl_awal; $i < $tgl_akhir; $i += $detik){
	if (date("w", $i) == "0"){
		$minggu++;
	}
}
return $minggu;
}


function get_date($tgl){
	$date = date('d',strtotime($tgl));
	if ($date<10){
		$date=str_replace("0", "", $date);
	}
	return $date;
}

function convert_hari($tgl){

$namahari = date("l", strtotime($tgl));
if ($namahari == "Sunday") $namahari = "Minggu"; 
else if ($namahari == "Monday") $namahari = "Senin"; 
else if ($namahari == "Tuesday") $namahari = "Selasa"; 
else if ($namahari == "Wednesday") $namahari = "Rabu"; 
else if ($namahari == "Thursday") $namahari = "Kamis"; 
else if ($namahari == "Friday") $namahari = "Jumat"; 
else if ($namahari == "Saturday") $namahari = "Sabtu";

return $namahari;
}

function adddate($vardate,$added)
{
$data = explode("-", $vardate);
$date = new DateTime();
$date->setDate($data[0], $data[1], $data[2]);
$date->modify("".$added."");
$day= $date->format("Y-m-d");
return $day;
}

function __convert_date($tanggal){
    $tanggal = explode('-',$tanggal);
    $tanggal = $tanggal[2] .'-'. $tanggal[1] .'-'. $tanggal[0];
    return $tanggal;
}
function __convert_date_indo($tanggal){
    $tanggal = explode('-',$tanggal);
    $tanggal = $tanggal[2] .'/'. $tanggal[1] .'/'. $tanggal[0];
    return $tanggal;
}
function __convert_date_mysql($tanggal){
    $tanggal = explode('/',$tanggal);
    $tanggal = $tanggal[2] .'-'. $tanggal[1] .'-'. $tanggal[0];
    return $tanggal;
}
?>
