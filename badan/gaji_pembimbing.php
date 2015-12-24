 <style type="text/css">
.ui-datepicker
{
   font-family: Arial;
   font-size: 13px;
   z-index: 1003 !important;
}
</style>
<script type="text/javascript">

$(document).ready(function(){   
$("#cetak").click(function(){

 // alert('test');
  MM_openBrWindow('badan/ctk_gaji_pembimbing.php','cetak','width=800,height=600');

})

  var jQueryDatePicker1Opts =
   {
      dateFormat: 'dd-mm-yy',
      changeMonth: true,
      changeYear: true,
      showButtonPanel: false,
      showAnim: 'show'
   };
   $("#tgl1").datepicker(jQueryDatePicker1Opts);
   $("#tgl2").datepicker(jQueryDatePicker1Opts);
});
</script>


  <div class="grid">
                
                <div class="grid-title">
                 <div class="pull-left">
                    <div class="icon-title"><i class="icon-eye-open"></i></div>
                    <span style="width: 600px;">Rincian Honorarium Dokter Pembimbing</span> 
                    <div class="clearfix"></div>
                 </div>
                 <div class="pull-right"> 
                    <div class="icon-title"><a href="#"><i class="icon-refresh"></i></a></div>
                    <div class="icon-title"><a href="#"><i class="icon-cog"></i></a></div>
                 </div>
                <div class="clearfix"></div>   
                </div>
              
                <div class="grid-content">

        <form method='post'>   
          <table class="table table-bordered table-mod-2">
            <tr><td>Nama</td><td>:</td><td>
<?php echo "
<select class='chzn-select chosen_select' name='kd_pembimbing'  >
      <option value=''>Masukkan Nama</option>";

      $sql1="select * from dokter_pembimbing order by nama asc";
      $query1=mysql_query($sql1);
      while ($r=mysql_fetch_array($query1)){
        
        echo "<option value='$r[id_dokter_pembimbing]' >$r[nama]</option> ";
      }
      echo "</select>";
?>
            </td></tr>
            <tr><td>Tanggal Awal</td><td>:</td><td><input type=text name='tgl1' id='tgl1' value='<?php echo "01-".$bln_sekarang."-".$thn_sekarang; ?>'></td></tr>
            <tr><td>Tanggal Akhir</td><td>:</td><td><input type=text name='tgl2' id='tgl2' value='<?php echo "31-".$bln_sekarang."-".$thn_sekarang; ?>'></td></tr>
            <tr><td colspan=3><input type='submit' value='Hitung'></td></tr>
          </table>
             <input type='hidden' name=module value='gaji_pembimbing'>
        </form>
                <div class="clearfix">



                </div>
<?php
if ($_SERVER['REQUEST_METHOD']=='POST'){
?>
<hr>
<br><br><br>
<?php
$_SESSION['kd_pembimbing']=$_POST['kd_pembimbing'];
$_SESSION['tgl1']=__convert_date($_POST['tgl1']);
$_SESSION['tgl2']=__convert_date($_POST['tgl2']);

$sql2="SELECT * FROM `dokter_pembimbing` where id_dokter_pembimbing='$_POST[kd_pembimbing]'";
$query2=mysql_query($sql2);
$d2=mysql_fetch_array($query2);
?>

        <h4>Rincian Honorarium Dokter Pembimbing</h4>   
          <table>
            <tr><td>Nama</td><td>:</td><td><?php    echo $d2['nama'];     ?></td></tr>
            <tr><td>Tanggal</td><td>:</td><td>dari <?php echo tgl_indo(__convert_date($_POST['tgl1'])) ?> s.d. <?php echo tgl_indo(__convert_date($_POST['tgl2'])) ?></td></tr>
          </table>
          <br><br>
          <button class=btn id='cetak'> Cetak</button>
          <table class="table table-bordered table-mod-2">
            <thead>
            <tr>
              <th>No</th>
              <th>Kegiatan</th>
              <th>Satuan</th>
              <th>Jumlah</th>
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
  $tgl1=__convert_date($_POST['tgl1']);
  $tgl2=__convert_date($_POST['tgl2']);

  $sql="SELECT Sum(IF (absen.kd_kegiatan = '$d3[kd_kegiatan]', 1, 0)) AS jml FROM absen WHERE kd_pembimbing='$_POST[kd_pembimbing]' 
        and tgl_absen BETWEEN '$tgl1' and '$tgl2'";
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
              <td>$jml</td>
              <td>"; echo formatRupiah2($total); echo "</td>
            </tr>  ";
$no++;
}
echo "
          <tr>
            <td colspan='3'><strong>Total Keseluruhan</strong></td><td></td><td>"; echo formatRupiah2($t_total); echo "</td>
          </tr>";
?>
            
           </tbody>
            
          </table>
<?php } ?>
                          <div class="clearfix">



                </div>
                </div>
                
                </div>
