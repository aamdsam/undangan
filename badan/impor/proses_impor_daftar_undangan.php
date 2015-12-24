
<?php

//error_reporting(0);
session_start();

include "../../library/check_login.php";
include "../../config/koneksi.php";
include "../../config/library.php";

//$tabel=$_POST['tabel'];
//$module=$_POST['module'];


// menggunakan class phpExcelReader
include "excel_reader2.php";


 

$data = new Spreadsheet_Excel_Reader($_FILES['file_excel']['tmp_name']);
 

$baris = $data->rowcount($sheet_index=0);
 

$sukses = 0;
$gagal = 0;


$nu=1;
for ($i=2; $i<=$baris; $i++)
{
// membaca data no soal (kolom ke-1)
$no = mysql_real_escape_string($data->val($i, 1)); //id
$no1 = mysql_real_escape_string($data->val($i, 2)); //nama
$no2 = mysql_real_escape_string($data->val($i, 3)); //alamat
$no3 = mysql_real_escape_string($data->val($i, 4)); //kd_kelompok


$query = "INSERT INTO `nama_undangan` (`nama`, `alamat`, `kelompok`) VALUES ('$no1', '$no2', '$no3')";
$arb = mysql_query($query);
//echo "$query<br>$format<br>";
$nu++;
// jika proses insert data sukses, maka counter $sukses bertambah
// jika gagal, maka counter $gagal yang bertambah
if ($arb) $sukses++;
else $gagal++;
}


// tampilan status sukses dan gagal
echo "<h3>Proses import data selesai.</h3>";
echo "<p>Jumlah data yang sukses diimport : ".$sukses."<br>";
echo "Jumlah data yang gagal diimport : ".$gagal."</p>";

echo "<script>window.location='../../media.php?module=daftar_undangan'</script>";
?>