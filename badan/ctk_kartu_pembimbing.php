<style type="text/css">
.table {
  border: 1px solid #CCC;
}

.table th, .table td{
  border: 1px solid #CCC;
  padding: 1px;

}

#kop{
  text-align: center;
  font: bold;
}
.row4{
  font: 42;

}
#t_logo_unismuh{
  position: absolute;
  left: 0;
  top: 0;
}
 </style>
<?php
session_start();
include "../config/koneksi.php";
include "../config/fungsi_indotgl.php";
include "../config/library.php";
include "../library/formatUang.php";
include "../config/selisi_waktu.php";



?>
<body onload='window.print()'>

<?php

$tgl1=__convert_date($_GET['tgl1']);
$kd_pembimbing=$_GET['kd_pembimbing'];

$sql2="SELECT * from dokter_pembimbing where id_dokter_pembimbing='$_GET[kd_pembimbing]'";
//echo $sql2;
$query2=mysql_query($sql2);
$d2=mysql_fetch_array($query2);

$tgl2=adddate($tgl1,"+1 day");
$tgl3=adddate($tgl1,"+2 day");
$tgl4=adddate($tgl1,"+3 day");
$tgl5=adddate($tgl1,"+4 day");

$date1=substr($tgl1, 8,2)."/".substr($tgl1, 5,2)."/".substr($tgl1, 2,2);
$date2=substr($tgl2, 8,2)."/".substr($tgl2, 5,2)."/".substr($tgl2, 2,2);
$date3=substr($tgl3, 8,2)."/".substr($tgl3, 5,2)."/".substr($tgl3, 2,2);
$date4=substr($tgl4, 8,2)."/".substr($tgl4, 5,2)."/".substr($tgl4, 2,2);
$date5=substr($tgl5, 8,2)."/".substr($tgl5, 5,2)."/".substr($tgl5, 2,2);




    echo "
<div id='kop'>
<div>RINCIAN KEGIATAN PEMBIMBING KLINIK</div>
<div>FAKULTAS KEDOKTERAN</div>
<div>UNIVERSITAS MUHAMMADIYAH MAKASSAR</div>
</div>

<br><br>
    Tanggal : <b>".tgl_indo($tgl1)."</b> s.d. <b>".tgl_indo($tgl5)."</b><br>
    <table class='table' cellspacing=0 cellpadding=0 style='width:100%'>
      <tr>
        <th rowspan='2' scope='col'>No</th>
        <th rowspan='2' scope='col'>Kegiatan</th>
        <th scope='col'>".convert_hari($tgl1)."</th>
        <th scope='col'>".convert_hari($tgl2)."</th>
        <th scope='col'>".convert_hari($tgl3)."</th>
        <th scope='col'>".convert_hari($tgl4)."</th>
        <th scope='col'>".convert_hari($tgl5)."</th>
        <th rowspan='2' scope='col'>Jumlah</th>
      </tr>
      <tr>
        <td align='center'>$date1</td>
        <td align='center'>$date2</td>
        <td align='center'>$date3</td>
        <td align='center'>$date4</td>
        <td align='center'>$date5</td>
      </tr>";
      $sql="SELECT * from kegiatan order by nm_kegiatan asc";
      $query=mysql_query($sql);
      $no=1;
      while ($d=mysql_fetch_array($query)){
        echo "<tr>
          <td align='center' width='10%'>$no</td>
          <td width='40%'>$d[nm_kegiatan]</td>
          <td align='center'width='8%'>&nbsp;</td>
          <td align='center'width='8%'>&nbsp;</td>
          <td align='center'width='8%'>&nbsp;</td>
          <td align='center'width='8%'>&nbsp;</td>
          <td align='center'width='8%'>&nbsp;</td>
          <td align='center'width='10%'>&nbsp;</td>
        </tr>";
        $no++;
      }
      
    echo "</table>


    <br><br><br><br>
    <div style='float:right'><u><b>($d2[nama])</b></u></div><br><br>    <hr>";

?>
</body>