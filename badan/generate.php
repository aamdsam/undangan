<?php
session_start();
include ("../config/koneksi.php");
include "../library/check_login.php";
include "../config/fungsi_indotgl.php";

$cid=$_GET['cid'];
$sql4="SELECT * from chart where `id`='$cid'";
$query4=mysql_query($sql4);
$d4=mysql_fetch_array($query4);


$nama_tabel=$d4['nama_tabel'];
$id_chart=$cid;
$id_grafik=$d4['type_grafik'];


$sql2="select * from type_grafik where kode='$d4[type_grafik]'";
$query2=mysql_query($sql2);
$tg=mysql_fetch_array($query2);
$type_grafik=$tg['nama'];



$query2=mysql_query("SELECT COUNT(id) as mulai FROM $nama_tabel where tampil='Y'");
$b=mysql_fetch_array($query2);

if ($b['mulai']>5){
    $mulai=$b['mulai']-5;
    
}else{
    $mulai=0;
    $pesan=$mulai;

}


$filter=" WHERE `tampil` = 'Y'";

include ("../config/library.php");
if ($_GET['lihat']=='detail'){
    tambah_lihat($id_chart);
    $chart_height="256";
}

if ($_GET['l']){
    if ($_GET['l1']){
        $limit="limit $_GET[l1],$_GET[l]";
    }elseif($_GET['l2']){
        $limit="limit $_GET[l2]";
    }else{
        $limit="limit $mulai,$_GET[l]";
    }
}else{
    $limit="";
}


if ($_GET['o']){
    $order="ORDER BY $_GET[o]";
        if ($_GET['s']=='1'){
            $order .= " ASC";
        }elseif ($_GET['s']=='2'){
            $order .= " DESC";
        }else{
            $order .= "";
        }
}else{
    $order= "";
}

$sql="SELECT * from chart where nama_tabel = '$nama_tabel'";
$query=mysql_query($sql);
$r=mysql_fetch_array($query);
$title=$r['title'];
$sub_title=$r['sub_title'];


$sql3="SELECT * from widgets where id_chart='$id_chart'";
$query3=mysql_query($sql3);
$d3=mysql_fetch_array($query3);

if ($id_grafik=='1'){
    include "generate_coloumn.php";
}elseif ($id_grafik=='2'){
    include "generate_line.php";
}elseif ($id_grafik=='3'){
    include "generate_pie.php";
}elseif ($id_grafik=='4'){
    include "generate_bar.php";
}



?>




