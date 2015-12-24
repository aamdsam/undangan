
<?php
include ("../config/koneksi.php");
$idw=$_GET['idw'];
$tw=mysql_query("UPDATE `chart` SET `tampil`='N' where title='$idw'");
echo "UPDATE `chart` SET `tampil`N where title=$idw";
?>