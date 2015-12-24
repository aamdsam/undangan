<?php
session_start();
error_reporting(0);
include("../config/koneksi.php");
if ($_GET['aksi']=='delUser'){
	$id=$_GET['id'];
	$deleteuser=mysql_query("DELETE FROM `user` WHERE `userid`=$id");
		if ($deleteuser) {
			echo "<script>window.location='../media.php?module=manajemen_user';</script>";
		}else{
			echo "<script>alert('data gagal dihapus')</script>";
		}
}else if ($_GET['aksi']=='delLevel'){
	$id=$_GET['id'];
	$deleteuser=mysql_query("DELETE FROM `level` WHERE `kd_level`=$id");
		if ($deleteuser) {
			echo "<script>window.location='../media.php?module=manajemen_level';</script>";
		}else{
			echo "<script>alert('data gagal dihapus')</script>";
		}
}else if ($_GET['aksi']=='delNewsFlash'){
	$id=$_GET['id'];
	$deleteuser=mysql_query("DELETE FROM `news_flash` WHERE `id`=$id");
		if ($deleteuser) {
			echo "<script>window.location='../media.php?module=news_flash';</script>";
		}else{
			echo "<script>alert('data gagal dihapus')</script>";
		}
}else if($_GET[aksi]=='DelGrup'){
		$delete=mysql_query("DELETE FROM grup WHERE id='$_GET[id]'");
			if ($delete) {
			echo "<script>window.location='../media.php?module=manajemen_grup';</script>";
		}else{
			echo "<script>alert('data gagal dihapus')</script>";
		}
	}

?>