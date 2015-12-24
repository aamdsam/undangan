<?php
session_start();
include ("config/koneksi.php");

$aksi=$_GET['aksi'];
$mid=$_GET['mid'];
$_SESSION['mid']=$mid;

$sql="select * from sub_menu where aktif='Y' and id_menu='$mid' order by no_urut";
$query=mysql_query($sql);
while ($r=mysql_fetch_array($query)){
  echo "<li class=\"active\"><a href=\"$r[link]\"><i class=\"$r[i_class]\"></i> $r[sub_menu]</a></li>";
}

?>

