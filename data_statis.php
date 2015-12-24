<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui.min.js"></script>

 <script src="tinymcpuk/jscripts/tiny_mce/tiny_mce.js" type="text/javascript"></script>
  <script src="tinymcpuk/jscripts/tiny_mce/tiny_lokomedia.js" type="text/javascript"></script>


<?php
session_start();
ob_start();

include "config/koneksi.php";



if ($_GET['aksi']=='edit'){


	if ($_GET['id']){
		$id=$_GET['id'];
		$sql="select * from data_statis where id='$id'";
	}elseif ($_GET['cid']){
		$cid=$_GET['cid'];
		$sql="select * from data_statis where id_chart='$cid'";
		$query2=mysql_query($sql);

		if (mysql_num_rows($query2)<1){
		$sql1="INSERT into data_statis SET id_chart='$cid', id_user='$_SESSION[userid_ntb]'";
		$query1=mysql_query($sql1);
		
	}




	}else{
		header("location: http://inmyhand.ntbprov.go.id/media.php");
	}
	



	$query=mysql_query($sql);
	$d=mysql_fetch_array($query);

	echo "<form method=POST  action='badan/aksi_data_statis.php?aksi=edit'>

	<textarea name='isi' id='loko' style='width:100%; height:100%;'>$d[isi]</textarea>
	<input type='hidden' name='id' value='$d[id]'>
	<input type='hidden' name='id_chart' value='$d[id_chart]'>
	<input type='hidden' name='id_user' value='$_SESSION[userid_ntb]'>
	
	<input type='submit' value='Update'>
	</form>";
}
?>