 <?php
include "../library/formatUang.php";
 ?>

    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!--datatables-->
    <link href="../assets/DataTables/css/DT_bootstrap.css" rel="stylesheet">
    <!--app-->
    <link href="../assets/app/css/style.css" rel="stylesheet">
    <script src="../assets/DataTables/js/jquery.dataTables.js"></script>
    <script src="../assets/DataTables/js/DT_bootstrap.js"></script>
<script>
        //Live Tooltip
        $('body').tooltip({
            selector: '[rel=tooltip]'
        });
    </script>

<table width="100%" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered"
            id="example"`>
<tr>
<th>NAMA</th>
<th>BBN1</th>
<th>BBN2</th>
<th>PKB POKOK</th>
<th>TPKB</th>
<th>Total</th>
<th>Obyek</th>
<th></th>
</tr>
<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL);
###############################################
$server="dispenda";                           #
$name="admin1";                               #
$pass="admin1";				      #
					      #
$koneksi= odbc_connect($server,$name,$pass);  #
###############################################



$waktu=gmdate("Y-m-d", time()+60*60*7);
$mysql="SELECT 
		count(*) as total,
		sum(t1.kend_bbn1_pokok) as jmlh1,
		sum(t1.kend_bbn2_pokok) as jmlh2,
		sum(t1.kend_pkb_pokok) as jmlh3,
		sum(t1.kend_tpkb_pokok) as jmlh4,
		t1.utl_drive_kode,
		t2.drvID, t2.drvName
		FROM tbm_notice t1
		 INNER JOIN
			tbmDrive t2 ON t2.drvID=t1.utl_drive_kode
		WHERE t1.utl_cetak_notice_tgl='$waktu'  and t1.utl_cetak_notice='-1'
	  	 group by t1.utl_drive_kode,t2.drvID, t2.drvName";


	
$data=odbc_exec($koneksi, $mysql);

while(odbc_fetch_array($data)){
$kota=odbc_result($data,"drvName");
$hasil1=odbc_result($data,"jmlh1");
$hasil2=odbc_result($data,"jmlh2");
$hasil3=odbc_result($data,"jmlh3");
$hasil4=odbc_result($data,"jmlh4");
$tot=$hasil1 + $hasil2 +$hasil3 +$hasil4 ;
$oby=odbc_result($data,"total");

echo "<tr>";
	echo "<td>".$kota ."</td>";
	echo "<td><div align='right'>".formatRupiah2($hasil1) ."</div></td>";
	echo "<td><div align='right'>".formatRupiah2($hasil2) ."</div></td>";
	echo "<td><div align='right'>".formatRupiah2($hasil3) ."</div></td>";
	echo "<td><div align='right'>".formatRupiah2($hasil4) ."</div></td>";
	echo "<td><div align='right'>".formatRupiah2($tot) ."</div></td>";
	echo "<td><div align='right'>".$oby ."</div></td>";
echo "</tr>";
}

$sqla ="SELECT
		count(*)as totall, 
		sum(kend_bbn1_pokok) as j1,
		sum(kend_bbn2_pokok) as j2,
		sum(kend_pkb_pokok) as j3,
		sum(kend_tpkb_pokok) as j4
 
	FROM tbm_notice 
	WHERE utl_cetak_notice_tgl='$waktu' AND utl_cetak_notice='-1'";
$tbl1=odbc_exec($koneksi,$sqla);
while(odbc_fetch_array($tbl1)){

$a=odbc_result($tbl1,"j1");
$b=odbc_result($tbl1,"j2");
$c=odbc_result($tbl1,"j3");
$d=odbc_result($tbl1,"j4");
$tota=$a + $b +$c +$d ;
$obyk=odbc_result($tbl1,"totall");

echo "<tr>";
        echo "<td>Total Hari Ini</td>";
        echo "<td><div align='right'>".formatRupiah2($a) ."</div></td>";
        echo "<td><div align='right'>".formatRupiah2($b) ."</div></td>";
        echo "<td><div align='right'>".formatRupiah2($c) ."</div></td>";
        echo "<td><div align='right'>".formatRupiah2($d) ."</div></td>";
     	echo "<td><div align='right'>".formatRupiah2($tota) ."</div></td>";
        echo "<td><div align='right'>".$obyk ."</div></td>";
echo "</tr>";
}

$bln=gmdate("m", time()+60*60*7);
$cetak=$bln-1;
echo "<br>".$cetak;
if($cetak==1 or $cetak==2 or $cetak==3 or $cetak==4 or $cetak==5 or $cetak==6 or $cetak==7 or $cetak==8 or $cetak==9){
$cetakh="0".$cetak;
} else{
$cetakh=$cetak;
}

$qla ="SELECT
		
                count(*)as totall,
                sum(kend_bbn1_pokok) as jm1,
               sum(kend_bbn2_pokok) as jm2,
                sum(kend_pkb_pokok) as jm3,
                sum(kend_tpkb_pokok) as jm4

        FROM tbm_notice
        WHERE utl_cetak_notice_tgl <='$waktu' AND  utl_cetak_notice='-1' ";
$t2=odbc_exec($koneksi,$qla);
odbc_fetch_array($t2);

$a1=odbc_result($t2,"jm1");
$b1=odbc_result($t2,"jm2");
$c1=odbc_result($t2,"jm3");
$d1=odbc_result($t2,"jm4");
$tota1=$a1 + $b1 +$c1 +$d1 ;
$obyk1=odbc_result($t2,"totall");

//echo "<tr>";
//        echo "<td>Data Bulan Lalu</td>";
//        echo "<td>".$a1 ."</td>";
//        echo "<td>".$b1 ."</td>";
//        echo "<td>".$c1 ."</td>";
//        echo "<td>".$d1 ."</td>";
//        echo "<td>".$tota1 ."</td>";
//        echo "<td>".$obyk1 ."</td>";
//echo "</tr>";


echo "</table>";
		
		
?>
