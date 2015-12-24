<?php
if ($_SESSION['login_pelamonia'] != 1){
	echo "<script>alert('anda harus login terlebih dahulu'); window.location='index.php'</script>";
	header("location:index.php");
}




?>
