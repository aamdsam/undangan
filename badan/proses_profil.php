<?php
session_start();
include ("../config/koneksi.php");
if ($_POST['nama_lengkap']!='' or $_POST['username']!=''){
	if ($_POST['password']!=''){
		$password=md5($_POST['password']);
		$sql="UPDATE `user` SET `nama_lengkap`='$_POST[nama_lengkap]',
		telepon='$_POST[telepon]',email='$_POST[email]',passid='$password',username='$_POST[username]'
		WHERE `userid`='$_SESSION[userid_ntb]'";
		$update=mysql_query($sql);
		
		if ($update){
			$_SESSION['nama_lengkap_ntb']=$_POST['nama_lengkap'];
			//echo $sql;
			echo "<script>alert('data berhasil di update');window.location='../media.php';</script>";
		}else{
			//echo $sql;
			echo "<script>alert('data gagal di update');window.location='../media.php';</script>";
		}
			
	}else{
		$sql="UPDATE `user` SET `nama_lengkap`='$_POST[nama_lengkap]',
		telepon='$_POST[telepon]',email='$_POST[email]',username='$_POST[username]'
		WHERE `userid`='$_SESSION[userid_ntb]'";
		$update=mysql_query($sql);
		if ($update){
			$_SESSION['nama_lengkap_ntb']=$_POST['nama_lengkap'];
			//echo $sql;
			echo "<script>alert('data berhasil di update');window.location='../media.php';/script>";
			
		}else{
			echo "<script>alert('data gagal di update');window.location='../media.php';</script>";
		}
	}
	
}else{
	echo "<script>alert('data gagal diupdate');window.location='../media.php';</script>";
	
}
?>