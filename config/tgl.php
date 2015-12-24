	<?php
	$nama_bulan=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
				echo "<select name=tgl>";
				echo "<option value=0>Tgl</option>";
					for($tgl=1;$tgl<=31;$tgl++){
						$pjg_karakter=strlen($tgl);
						if($pjg_karakter==1)
							$x="0".$tgl;
						else
							$x=$tgl;
							if ($x==$lahir[2]){
							echo "<option value=$x selected=selected>$x</option>";
							}
							else{
							echo "<option value=$x>$x</option>";
							}
						}
				echo "</select>&nbsp;";		
			echo "<select name=bulan>";
				echo "<option value=0>Bulan</option>";
					for($bulan=1;$bulan<=12;$bulan++){
						$pjg_karakter=strlen($bulan);
						if($pjg_karakter==1)
							$x="0".$bulan;
						else
							$x=$bulan;
							if ($x==$lahir[1]){
							echo "<option value=$x selected=selected>$nama_bulan[$bulan]</option>";
							}
							else{
							echo "<option value=$x>$nama_bulan[$bulan]</option>";
							}
						}
				echo "</select>&nbsp;";
				$thn_skrng=date("Y");
				echo "<select name='tahun'>";
				echo "<option value=0>Tahun</option>";
					for($thn=1980;$thn<=$thn_skrng;$thn++){
						if ($thn==$lahir[0]){
						echo "<option value=$thn selected=selected>$thn</option>";
						}
						else{
						echo "<option value=$thn>$thn</option>";
						}
						}
				echo "</select>";
?>