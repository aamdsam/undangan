<?php
session_start();
ob_start();

include "../config/koneksi.php";
include "../config/fungsi_indotgl.php";
include "../config/library.php";
include "../library/check_login.php";


if ($_GET['aksi']=='edit'){
	$id=$_POST['id'];
	$isi=mysql_real_escape_string($_POST['isi']);
	$sql="update data_statis set isi='$isi' where id=$id";
	$update=mysql_query($sql);
	if ($update){
		if ($id=1){
			echo "<script>alert('data berhasil diupdate'); window.location='tabel_perkembangan_nilai_ekspor.php'</script>";
		}elseif ($id=2){
			echo "<script>alert('data berhasil diupdate'); window.location='tabel_detail_impor_prov_ntb.php'</script>";
		}elseif ($id=3){
			echo "<script>alert('data berhasil diupdate'); window.location='detail_widgets.php?cid=93'</script>";
		}else{
			header("location: ../data_statis.php?aksi=edit&id=$id");
		}
	}else{
		header("location: ../data_statis.php?aksi=edit&id=$id");
	}


}
?>