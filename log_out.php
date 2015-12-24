<?php
include "config/koneksi.php";
	error_reporting(0);
	session_start();
	
$update=mysql_query("update user set status='OFFLINE' where userid='$_GET[id]'");
if($update){

	$_SESSION['username_pelamonia']   = '';
	$_SESSION['namauser_pelamonia']   = '';
	$_SESSION['passuser_pelamonia']   = '';
	$_SESSION['leveluser_pelamonia']  = '';
	$_SESSION['status_pelamonia']     = '';


	$_SESSION['login_pelamonia'] = '';

	
	//session_unset(); 
	//session_destroy();
	echo "<script language='javascript'>window.location.href='index.php';</script>";  
	//header('location:index.php');
	}
?>
