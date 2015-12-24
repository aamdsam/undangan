<?php 
	function ambilNip($var){
	echo "<select name=$var>";
		$ambil=mysql_query("select * from pegawai");
		while($dt=mysql_fetch_array($ambil)){
		echo "<option value='$dt[nip]'>$dt[nip]</option>";			
		}
	echo "</select>";
	}
?>