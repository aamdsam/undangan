<?php
ob_start();
?>
<?php 
session_start();
if (	$_SESSION['username_pegawai'])
{
	header("location:../media.php?module=absensi");
	
}
else{
	header("location:../wellcome.php");

}
	?>