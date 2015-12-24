<?php
//set_error_handler( E_NOTICE | E_STRICT);
//error_reporting(error_reporting() & ~E_NOTICE);
$server="dispenda";
$name="admin1";
$pass="admin1";

$koneksi= odbc_connect($server,$name,$pass);


 
header("Content-type: text/json");

$waktu=gmdate("Y-m-d", time()+60*60*7);

$sqla ="SELECT
              
                sum(kend_bbn1_pokok) as j1,
                sum(kend_bbn2_pokok) as j2,
                sum(kend_pkb_pokok) as j3,
                sum(kend_tpkb_pokok) as j4

        FROM tbm_notice
        WHERE utl_cetak_notice_tgl='$waktu' AND utl_cetak_notice='-1'";
$tbl1=odbc_exec($koneksi,$sqla);
odbc_fetch_array($tbl1);

$a=odbc_result($tbl1,"j1");
$b=odbc_result($tbl1,"j2");
$c=odbc_result($tbl1,"j3");
$d=odbc_result($tbl1,"j4");
$total=$a + $b +$c +$d ;


 
$hasil=$a+$b+$c+$d;




//echo $bbn1;
$x = time() * 1000;
$y = $total; 



$ret = array($x, $y);
echo json_encode($ret);
?>
