<style type="text/css">
.table {
  border: 1px solid #CCC;
}

.table th, .table td{
  border: 1px solid #CCC;
  padding: 4px;

}
</style>
<?php
session_start();
include "../config/koneksi.php";
include "../config/fungsi_indotgl.php";
include "../config/library.php";
include "../library/formatUang.php";

$sql2="SELECT dokter_pembimbing.*,
bagian.nm_bagian FROM `dokter_pembimbing` INNER JOIN bagian ON dokter_pembimbing.kd_bagian=bagian.kd_bagian where id_dokter_pembimbing='$_SESSION[kd_pembimbing]'";
$query2=mysql_query($sql2);
$d2=mysql_fetch_array($query2);

?>
<body onload='window.print()'>
 <!-- -->
 <style type="text/css">
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

<div id='kop'>
<span id='t_logo_unismuh'><img src="../images/logo_unismuh.jpg" width='75px'></span>
<div class='row1'>UNIVERSITAS MUHAMMADIYAH MAKASSAR</div>
<div class='row2'>FAKULTAS KEDOKTERAN</div>
<div class='row3'>KEPANITERAAN KLINIK</div>
<div class='row4' style='font-size: 80%;'>JL. Sultan Alauddin No. 259 Tlp (0411) 866972 Fax (0411)865588, Makassar</div>
<hr>

</div>


        <center><h4>RINCIAN HONORARIUM KINERJA PEMBIMBING KLINIK</h4></center>
          <table>
            <tr><td>Nama</td><td>:</td><td><?php    echo $d2['nama'];     ?></td></tr>
            <tr><td>Bagian</td><td>:</td><td><?php    echo $d2['nm_bagian'];     ?></td></tr>
            
            <tr><td>Periode</td><td>:</td><td> <?php echo tgl_indo($_SESSION['tgl1']) ?> s.d. <?php echo tgl_indo($_SESSION['tgl2']) ?></td></tr>
          </table>
          <br><br>
          <table class='table' cellspacing=0 cellpadding=0 >
            <thead>
            <tr>
              <th>No</th>
              <th>Kegiatan</th>
              <th>Satuan</th>
              <th><center>Jumlah</center></th>
              <th>Jumlah Total</th>
            </tr>
            </thead>
           <tbody>
<?php
$t_jml=0;
$t_total=0;
$no=1;
$sql3="SELECT * from kegiatan";
$query3=mysql_query($sql3);
while ($d3=mysql_fetch_array($query3)){
  $sql="SELECT Sum(IF (absen.kd_kegiatan = '$d3[kd_kegiatan]', 1, 0)) AS jml FROM absen WHERE kd_pembimbing='$_SESSION[kd_pembimbing]' 
        and tgl_absen BETWEEN '$_SESSION[tgl1]' and '$_SESSION[tgl2]'";
  $query=mysql_query($sql);
  $d=mysql_fetch_array($query);
  $jml=$d['jml'];
  $satuan=$d3['satuan'];
  $total=$jml * $satuan;

  $t_jml =$t_jml+$jml;
  $t_total =$t_total+$total;

  echo "<tr>
              <td>$no</td>
              <td>$d3[nm_kegiatan]</td>
              <td>"; echo formatRupiah2($d3['satuan']); echo "</td>
              <td><center>$jml</center></td>
              <td>"; echo formatRupiah2($total); echo "</td>
            </tr>  ";
$no++;
}
echo "
          <tr>
            <td colspan='3'><strong>Total Keseluruhan</strong></td><td><strong><center>$t_jml</center></strong></td><td><strong>"; echo formatRupiah2($t_total); echo "</strong></td>
          </tr>";
?>
            
           </tbody>
            
          </table>
<Br><br><br>
  <?php
  $d4=mysql_fetch_array(mysql_query("SELECT * from pejabat"));

  echo "
<table width='100%'>
    <tr>
      <td><br><br>Mengetahui<br>Dekan<br><br><br>$d4[dekan]</td>
      <td>Makassar, <br><br>Wakil Dekan II<br><br><br><br>$d4[wakil_dekan2]</td>
    </tr>
  </table>";
  ?>
</body>