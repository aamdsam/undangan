<?php
  if ($_SESSION['leveluser_pelamonia']!=1){
	echo "<script language='javascript'>window.location.href='media.php';</script>"; 
}

$no=1;
$query=mysql_query("select * from chart");
	echo "<table class=badan>
	<tr>
		<th>No</th>
		<th>Gadget</th>
		<th>Level Akses</th>
		<th>Aksi</th>
		
	</tr>";



while ($r=mysql_fetch_array($query)){
	

	$query2=mysql_query("select * from level");
			$pot=explode(',', $r['level']);
			$kd=$a['kd_level'];
			//echo $pot[0]."=".$kd;
			if (!empty($pot[0])){
				$query1=mysql_query("select * from level where kd_level='$pot[0]'");
				$n=mysql_fetch_array($query1);
				$pot0=$n['nm_level'];
				$nm_level=$pot0;
			}
			
			if (!empty($pot[1])){
				$query1=mysql_query("select * from level where kd_level='$pot[1]'");
				$n=mysql_fetch_array($query1);
				$pot1=$n['nm_level'];
				$nm_level=$nm_level.",".$pot1;
			}
			
			if (!empty($pot[2])){
				$query1=mysql_query("select * from level where kd_level='$pot[2]'");
				$n=mysql_fetch_array($query1);
				$pot2=$n['nm_level'];
				$nm_level=$nm_level.",".$pot2;
			}
			
			if (!empty($pot[3])){
				$query1=mysql_query("select * from level where kd_level='$pot[3]'");
				$n=mysql_fetch_array($query1);
				$pot3=$n['nm_level'];
				$nm_level=$nm_level.",".$pot3;
			}
			
			if (!empty($pot[4])){
				$query1=mysql_query("select * from level where kd_level='$pot[4]'");
				$n=mysql_fetch_array($query1);
				$pot4=$n['nm_level'];
				$nm_level=$nm_level.",".$pot4;
			}
			if (!empty($pot[5])){
				$query1=mysql_query("select * from level where kd_level='$pot[5]'");
				$n=mysql_fetch_array($query1);
				$pot5=$n['nm_level'];
				$nm_level=$nm_level.",".$pot5;
			}
			
					
	echo "<tr>
		<td>$no</td>
		<td>$r[title]</td>
		<td>$nm_level</td>
		<td><a href='?module=edit_manajemen_gadget&id=$r[id]'>edit</a></td>
	</tr>";
	$no++;	
	
}
echo "</table>";
?>
