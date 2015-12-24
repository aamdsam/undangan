
<?php
include ("../config/koneksi.php");
$id=$_GET['id'];
$tw=mysql_query("UPDATE `chart` SET `tampil`='Y' where id=$id");
if ($tw){
	echo "<script>window.parent.sukses_add_widget()</script>";
}else{
	echo "<script>alert('gagal menambahkan widget')</script>";
}
?>