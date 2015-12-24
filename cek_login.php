
<script>

function loading(){
	//window.open('media.php?module=home','splash','',false);
	//window.close();
	setTimeout("location.href='media.php?module=home'",10000);
}

</script>
<?php


session_start();
ob_start();

$_SESSION['menu']='home';


include "config/koneksi.php";
include "config/library.php";


function antiinjection($data){
	$filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
	return $filter_sql;
}

if ($_POST['username']){
	$username = antiinjection($_POST['username']);
	$pass     = antiinjection(md5($_POST['password']));
}


$sql=mysql_query("SELECT * FROM user WHERE username='$username' AND passid='$pass'");
if (mysql_num_rows($sql)>0){
	$data=mysql_fetch_array($sql);
	if ($data['blokir']=='Y'){
		echo "<script>alert('Username anda telah diblokir....!'); window.location='index.php'</script>";
	}else{
		
			include "library/timeout.php";
			$_SESSION['username_pelamonia']   = $username;
		  	$_SESSION['userid_pelamonia']   		= $data['userid'];
			$_SESSION['nama_lengkap_pelamonia']  = $data['nama_lengkap'];
		  	$_SESSION['leveluser_pelamonia']  = $data['level_user'];
		   	$_SESSION['status_pelamonia']     = $data['status'];
	  
	 
			$_SESSION['login_pelamonia'] = 1;
			  timer();
			  //echo "<script>loading(); </script>";
			  echo "<script>window.location='media.php';</script>";


	}
}else{
	//echo "SELECT * FROM user WHERE username='$username' AND passid='$pass'";
	echo "<script>alert('Username atau password yang anda masukkan salah'); window.location='index.php'</script>";
}



?>

