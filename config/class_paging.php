<?php
// class paging untuk halaman administrator
class Paging{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['halaman'])){
	$posisi=0;
	$_GET['halaman']=1;
}
else{
	$posisi = ($_GET['halaman']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 (untuk admin)
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=1 ><< First</a> | 
                    <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$prev >< Prev</a> | ";
}
else{ 
	$link_halaman .= "<< First | < Prev | ";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? " ... " : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$i >$i</a> | ";
  }
	  $angka .= " <b>$halaman_aktif</b> | ";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$i >$i</a> | ";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " ... | <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$jmlhalaman >$jmlhalaman</a> | " : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$next >Next ></a> | 
                     <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$jmlhalaman >Last >></a> ";
}
else{
	$link_halaman .= " Next > | Last >>";
}
return $link_halaman;
}
}


class Paging1{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['halaman'])){
	$posisi=0;
	$_GET['halaman']=1;
}
else{
	$posisi = ($_GET['halaman']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 (untuk admin)
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=1&tahun=$_GET[tahun]><< First</a> | 
                    <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$prev&tahun=$_GET[tahun]>< Prev</a> | ";
}
else{ 
	$link_halaman .= "<< First | < Prev | ";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? " ... " : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$i&tahun=$_GET[tahun]>$i</a> | ";
  }
	  $angka .= " <b>$halaman_aktif</b> | ";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$i&tahun=$_GET[tahun]>$i</a> | ";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " ... | <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$jmlhalaman&tahun=$_GET[tahun]>$jmlhalaman</a> | " : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$next&tahun=$_GET[tahun]>Next ></a> | 
                     <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$jmlhalaman&tahun=$_GET[tahun]>Last >></a> ";
}
else{
	$link_halaman .= " Next > | Last >>";
}
return $link_halaman;
}
}



?>
