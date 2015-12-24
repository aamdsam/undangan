<?php

session_start();
ob_start();
$aksi=$_GET['aksi'];

include "config/koneksi.php";


if ($aksi=='proses_update_dicetak'){
	$id=$_GET['id'];
	$dicetak=$_GET['dicetak'];

	

	$sql="UPDATE `nama_undangan` SET `dicetak`='$dicetak' WHERE `id`='$id'";
	$query=mysql_query($sql);
	if ($query){
		echo "data berhasil diupdate....!!!";
	}else{
		echo "data gagal diupdate...!!!";
	}
	

	
}elseif ($aksi=='proses_update_dilabel'){
	$id=$_GET['id'];
	$dilabel=$_GET['dilabel'];

	

	$sql="UPDATE `nama_undangan` SET `dilabel`='$dilabel' WHERE `id`='$id'";
	$query=mysql_query($sql);
	if ($query){
		echo "data berhasil diupdate....!!!";
	}else{
		echo "data gagal diupdate...!!!";
	}
	

	
}elseif ($aksi=='proses_update_dikirim'){
	$id=$_GET['id'];
	$dikirim=$_GET['dikirim'];

	

	$sql="UPDATE `nama_undangan` SET `dikirim`='$dikirim' WHERE `id`='$id'";
	$query=mysql_query($sql);
	if ($query){
		echo "data berhasil diupdate....!!!";
	}else{
		echo "data gagal diupdate...!!!";
	}
	

	
}
?>