<?php
session_start();
ob_start();
$aksi=$_GET['aksi'];

include "../config/koneksi.php";

function cek($a){
	$query=mysql_query("select * from absen where kd_pembimbing='$_SESSION[kd_pembimbing]' and tgl_absen ='$_GET[tgl_absen]' ");
	$cek="";
	while ($r=mysql_fetch_array($query)){
		if ($a==$r['kd_kegiatan']){
			$cek='checked';
		}
	}
	return $cek;
}

if ($aksi=='edit_absen'){


	  $s=1;
	  $query=mysql_query("SELECT * FROM `kegiatan`");
	  while ($r=mysql_fetch_array($query)){
	    $s++;
	   	
	   echo "<input type='checkbox' id='c$s' name='kd_kegiatan[]' value='$r[kd_kegiatan]'".cek($r['kd_kegiatan'])." /><label for='c$s'><span></span>$r[nm_kegiatan]</label>"; 
	  }
	
	

}
?>