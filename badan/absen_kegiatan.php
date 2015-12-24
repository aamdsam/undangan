<style type="text/css">
.ui-datepicker
{
   font-family: Arial;
   font-size: 13px;
   z-index: 1003 !important;
}
</style>
<script type="text/javascript">
function getURLParameter(name) {
  return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null
}
//module = getURLParameter('module');  


$(document).ready(function(){            
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

   $("#tgl_absen").change(function(){
    var tgl_absen=$("#tgl_absen").val();
    var kd_pembimbing=getURLParameter('kd_pembimbing');
    $.ajax({
      type:"GET",
      url:"badan/proses.php",
      data:"aksi=edit_absen&tgl_absen="+tgl_absen,
      success:function(data){  //4
        $("#div_kegiatan").html(data);
        $("#hapus_data_tanggal").html("<a onclick=\"return confirm('Apa anda yakin ingin menghapus data atas nama pembimbing dan tanggal tersebut...?')\" href='media.php?module=absen_kegiatan&aksi=delete_tanggal&kd_pembimbing="+kd_pembimbing+"&tgl_absen="+tgl_absen+"'>Hapus Data Tanggal ini<a>");
        $("#hapus_data_tanggal").show();
      } 
    })
  })
});
</script>


<?php

if ($_SERVER['REQUEST_METHOD']=='POST'){
  if ($_POST['aksi']=='proses_update'){
    $sql_delete_dulu="DELETE from absen where tgl_absen='$_POST[tgl_absen]'";
    //echo $sql_delete_dulu;
    
    $delete=mysql_query($sql_delete_dulu);


    $cek=$_POST['kd_kegiatan'];
    $jumlah=count($cek);
  
      
    for($i=0;$i<$jumlah;$i++){

      //echo "post_aksi".$_POST['aksi'];
      $kd_pembimbing = mysql_real_escape_string($_POST['kd_pembimbing']);
      $tgl_absen=mysql_real_escape_string($_POST['tgl_absen']);


      $sql_insert="INSERT INTO `absen` (`tgl_absen`, `kd_pembimbing`, `kd_kegiatan`) VALUES ('$tgl_absen', '$kd_pembimbing', '$cek[$i]')";
      //echo $sql_insert;

      $query_insert=mysql_query($sql_insert);

    }
      if ($query_insert){
        echo "<script>alert('data berhasil di save'); window.location.href='media.php?module=absen_kegiatan';</script";
      }else{

        echo "<script>alert('data gagal di save'); window.back();</script";
      }
    
  }elseif ($_POST['aksi']=='proses_insert'){
    $cek=$_POST['kd_kegiatan'];
    $jumlah=count($cek);
  
      
    for($i=0;$i<$jumlah;$i++){

      //echo "post_aksi".$_POST['aksi'];
      $kd_pembimbing = mysql_real_escape_string($_POST['kd_pembimbing']);
      $tgl_absen=__convert_date(mysql_real_escape_string($_POST['tgl_absen']));
      $_SESSION['kd_pembimbing']=$kd_pembimbing;


      $sql_insert="INSERT INTO `absen` (`tgl_absen`, `kd_pembimbing`, `kd_kegiatan`) VALUES ('$tgl_absen', '$kd_pembimbing', '$cek[$i]')";
      //echo $sql_update;
      $query_insert=mysql_query($sql_insert);

    }
      if ($query_insert){
        echo "<script>alert('data berhasil di save'); window.location.href='media.php?module=absen_kegiatan&aksi=add';</script";
      }else{

        echo "<script>alert('data gagal di save'); window.back();</script";
      }
    
  }elseif ($_POST['aksi']=='proses_delete_selected'){
      $cek=$_POST['cek'];
    $jumlah=count($cek);
  
      
    for($i=0;$i<$jumlah;$i++){
    $sql_delete_selected ="DELETE FROM absen WHERE `id_absen_kegiatan`='$cek[$i]'";
    $query_delete_selected=mysql_query($sql_delete_selected);
    }
    //echo $sql_delete_selected."<br>";
    
    if ($query_delete_selected){
    header("location: media.php?$_SESSION[query_string]");
    }else{
    echo "<script>alert('data gagal dihapus'); </script";
    }
  }
}else{
  if ($_GET['aksi']=='detail'){
  $sql="SELECT
  dpt.id,
  dpt.kd_kab,
  kabupaten.nm_kab,
  dpt.kd_kec,
  kecamatan.nm_kec,
  dpt.kd_kel,
  kelurahan.nm_kel,
  dpt.tps,
  dpt.no_kk,
  dpt.nik,
  dpt.nama,
  dpt.tempat_lahir,
  dpt.tgl_lahir,
  dpt.umur,
  dpt.status_kawin,
  dpt.jk,
  dpt.alamat,
  dpt.rt,
  dpt.rw,
  dpt.ket
  FROM
  dpt
  INNER JOIN kabupaten ON dpt.kd_kab = kabupaten.kd_kab
  INNER JOIN kecamatan ON dpt.kd_kec = kecamatan.kd_kec
  INNER JOIN kelurahan ON dpt.kd_kel = kelurahan.kd_kel
  where dpt.id='$_GET[id]'";

    $query=mysql_query($sql);
    $c=mysql_fetch_array($query);


    echo "<div class='grid span10'>
                
                <div class='grid-title'>
                 <div class='pull-left'>
                    <div class='icon-title'><i class='icon-star-empty'></i></div>
                     <span style='width: 600px;'>Detail Daftar Pemilih Tetap</span> 
                    <div class='clearfix'></div>
                 </div>
                 <div class='pull-right'> 
                 </div>
                <div class='clearfix'></div>   
                </div>
              
                <div class='grid-content'>";

    

    echo "<table width='100%' class='table table-bordered table-mod-2'>
    <tr>
      <td width='20%'>Kabupaten</td>
      <td width='2%'>:</td>
      <td width='78%'>$c[nm_kab]</td>
    </tr>
    <tr>
      <td>Kecamatan</td>
      <td>:</td>
      <td>$c[nm_kec]</td>
    </tr>
    <tr>
      <td>Kelurahan</td>
      <td>:</td>
      <td>$c[nm_kel]</td>
    </tr>
    <tr>
      <td>TPS</td>
      <td>:</td>
      <td>$c[tps]</td>
    </tr>
    <tr>
      <td>No KK</td>
      <td>:</td>
      <td>$c[no_kk]</td>
    </tr>
    <tr>
      <td>No Identitas KTP</td>
      <td>:</td>
      <td>$c[nik]</td>
    </tr>
    <tr>
      <td>Nama</td>
      <td>:</td>
      <td>$c[nama]</td>
    </tr>
    <tr>
      <td>Tempat / Tgl Lahir</td>
      <td>:</td>
      <td>$c[tempat_lahir] / ".tgl_indo($c['tgl_lahir'])."</td>
    </tr>
    <tr>
      <td>Umur</td>
      <td>:</td>
      <td>$c[umur]</td>
    </tr>
    <tr>
      <td>Status Kawin</td>
      <td>:</td>
      <td>";
      $sql1="select * from tbkod where KDAPLTBKOD ='02' and KDKODTBKOD='$c[status_kawin]'";
      $query1=mysql_query($sql1);
      while ($r=mysql_fetch_array($query1)){
        echo $r['NMKODTBKOD'];
      }

      echo "</td>
    </tr>
    <tr>
      <td>Jenis Kelamin</td>
      <td>:</td>
      <td>";
      $sql1="select * from tbkod where KDAPLTBKOD ='01' and KDKODTBKOD='$c[jk]'";
      $query1=mysql_query($sql1);
      while ($r=mysql_fetch_array($query1)){
        echo $r['NMKODTBKOD'];
      }

      echo "</td>
    </tr>
    <tr>
      <td>Alamat</td>
      <td>:</td>
      <td>$c[alamat]</td>
    </tr>
    <tr>
      <td>RT</td>
      <td>:</td>
      <td>$c[rt]</td>
    </tr>
    <tr>
      <td>RW</td>
      <td>:</td>
      <td>$c[rw]</td>
    </tr>
    <tr>
      <td>Keterangan</td>
      <td>:</td>
      <td>$c[ket]</td>
    </tr>
    <tr>
      <td colspan=3><a href='media.php?module=absen_kegiatan'><button class='btn' type='button'>Kembali</button></a></td>
    </tr>
  </table>

                   
                    

                    
                   
                </div>
                
                </div>";
  }elseif ($_GET['aksi']=='edit'){
    $_SESSION['kd_pembimbing']=$_GET['kd_pembimbing'];

  $sql="SELECT * from absen_kegiatan where id_absen_kegiatan='$_GET[id]'";

    $query=mysql_query($sql);
    $c=mysql_fetch_array($query);


    echo "<div class='grid span10'>
                
                <div class='grid-title'>
                 <div class='pull-left'>
                    <div class='icon-title'><i class='icon-star-empty'></i></div>
                     <span style='width: 600px;'>Edit Absen Kegiatan</span> 
                    <div class='clearfix'></div>
                 </div>
                 <div class='pull-right'> 
                 </div>
                <div class='clearfix'></div>   
                </div>
              
                <div class='grid-content'>";

    

    echo "<form method='POST'> <table width='100%' class='table table-bordered table-mod-2'>
    <tr>
      <td width='20%'>Nama</td>
      <td width='2%'>:</td>
      <td width='78%'><select class='chzn-select chosen_select' name='kd_pembimbing'  >";

      $sql1="select * from dokter_pembimbing where id_dokter_pembimbing='$_SESSION[kd_pembimbing]'";
      $query1=mysql_query($sql1);
      while ($r=mysql_fetch_array($query1)){
        
        echo "<option value='$r[id_dokter_pembimbing]' >$r[nama]</option> ";
      }
      echo "</select></td>
    </tr>
      <td>Tanggal</td>
      <td>:</td>
      <td>
      <select class='chzn-select chosen_select' id='tgl_absen' name='tgl_absen'  >
      <option>Pilih Tanggal<option>";

      $sql1="SELECT absen.tgl_absen FROM absen WHERE absen.kd_pembimbing = '$_GET[kd_pembimbing]' GROUP BY tgl_absen";
      $query1=mysql_query($sql1);
      while ($r=mysql_fetch_array($query1)){
        
        echo "<option value='$r[tgl_absen]' >".tgl_indo($r['tgl_absen'])."</option> ";
      }
      echo "</select>
      </td>
    </tr>
     </tr>
      <td>Pilih Kegiatan</td>
      <td>:</td>
      <td><div id='div_kegiatan'>";



    $s=1;
  $query=mysql_query("SELECT * FROM `kegiatan`");
  while ($r=mysql_fetch_array($query)){
    $s++;
   echo "<input type='checkbox' id='c$s' name='kd_kegiatan[]' value='$r[kd_kegiatan]' /><label for='c$s'><span></span>$r[nm_kegiatan]</label>"; 
  }
      echo "</div><span id='hapus_data_tanggal'style='float:right;display:none'></span></td>
    </tr>
    <tr>
      <td colspan=3>
      <input type='hidden' name='aksi' value='proses_update'>
      
      <button class='btn' type='submit'>Update</button> &nbsp; &nbsp; &nbsp; <a href='media.php?module=absen_kegiatan'><button class='btn' type='button'>Kembali</button></a></td>
    </tr>
  </table></form>

                   
                    

                    
                   
                </div>
                
                </div>";
  }elseif ($_GET['aksi']=='add'){

    echo "
                  
  <div class='grid span10'>
                
                <div class='grid-title'>
                 <div class='pull-left'>
                    <div class='icon-title'><i class='icon-star-empty'></i></div>
                     <span style='width: 600px;'>Tambah Absen Kegiatan</span> 
                    <div class='clearfix'></div>
                 </div>
                 <div class='pull-right'> 
                 </div>
                <div class='clearfix'></div>   
                </div>
              
                <div class='grid-content'>
  
           
    <form method='POST'> <table width='100%' class='table table-bordered table-mod-2'>
    <tr>
      <td width='20%'>Nama</td>
      <td width='2%'>:</td>
      <td width='78%'><select class='chzn-select chosen_select' name='kd_pembimbing'  >
      <option value=''>Masukkan Nama</option>";

      $sql1="select * from dokter_pembimbing order by nama asc";
      $query1=mysql_query($sql1);
      while ($r=mysql_fetch_array($query1)){
        if ($_SESSION['kd_pembimbing']==$r['id_dokter_pembimbing']){
          $selected="selected";
        }else{
          $selected="";
        }
        echo "<option value='$r[id_dokter_pembimbing]' $selected>$r[nama]</option> ";
      }
      echo "</td>
    </tr>
      <td>Tanggal</td>
      <td>:</td>
      <td><input type='text' id='tgl1' name='tgl_absen' class='span3' value=''></td>
    </tr>
     </tr>
      <td>Pilih Kegiatan</td>
      <td>:</td>
      <td>";



    $s=1;
  $query=mysql_query("SELECT * FROM `kegiatan`");
  while ($r=mysql_fetch_array($query)){
    $s++;
   echo "<input type='checkbox' id='c$s' name='kd_kegiatan[]' value='$r[kd_kegiatan]' /><label for='c$s'><span></span>$r[nm_kegiatan]</label>"; 
  }

      echo "</td>
    </tr>
    <tr>
      <td colspan=3>
      <input type='hidden' name='aksi' value='proses_insert'>
      
      <button class='btn' type='submit'>Save</button> &nbsp; &nbsp; &nbsp; <a href='media.php?module=absen_kegiatan'><button class='btn' type='button'>Kembali</button></a></td>
    </tr>
  </table></form>

                   
                    

                    
                   
                </div>
                
                </div>";
  }elseif ($_GET['aksi']=='delete'){
    $sql_delete="DELETE FROM `absen` WHERE `kd_pembimbing`='$_GET[kd_pembimbing]'";
    $query_delete=mysql_query($sql_delete);
    if ($query_delete){
      echo "<script>window.location.href='media.php?module=absen_kegiatan';</script";
    }else{
      echo "<script>alert('data gagal di hapus'); window.back();</script";
    }

  }elseif ($_GET['aksi']=='delete_tanggal'){
    $sql_delete="DELETE FROM `absen` WHERE `kd_pembimbing`='$_GET[kd_pembimbing]' and tgl_absen='$_GET[tgl_absen]'";
    $query_delete=mysql_query($sql_delete);
    if ($query_delete){
      echo "<script>window.location.href='media.php?module=absen_kegiatan';</script";
    }else{
      echo "<script>alert('data gagal di hapus'); window.back();</script";
    }

  }else{
  ?>
  <div class="grid">
                
                <div class="grid-title">
                 <div class="pull-left">
                    <div class="icon-title"><i class="icon-eye-open"></i></div>
                    <span style="width: 300px;">Absen Kegiatan Dokter Pembimbing</span> 
                    <div class="clearfix"></div>
                 </div>
                 <div class="pull-right"> 
                    <div class="icon-title"><a href="#"><i class="icon-refresh"></i></a></div>
                    <div class="icon-title"><a href="#"><i class="icon-cog"></i></a></div>
                 </div>
                <div class="clearfix"></div>   
                </div>
              
                <div class="grid-content">
                  <a href='#'data-target="#anim-modal" data-toggle="modal" ><span class='icon-filter'></span>Filter Data</a>

              <form method="get">
              <div class="clearfix"></div>

                        <div id="anim-modal" class="modal fade hide">
                      <div class="modal-header">
                          <button class="close" type="button" data-dismiss="modal">&times;</button>
                          <b>Filter Data</b>
                      </div>
                      <div class="modal-body">
                          <p>
                            <table class="table table-bordered table-mod-2">
                            <?php
                                echo "
                              <tr>
                                <td width='20%'>Tgl Awal</td>
                                <td width='2%'>:</td>
                                <td width='78%'><input type='text' name='tgl1' id='tgl1' class='span2' value='$_GET[tgl1]'></td>

                              </tr>
                              <tr>
                                <td>Tgl Akhir</td>
                                <td>:</td>
                                <td><input type='text' name='tgl2' id='tgl2' class='span2' value='$_GET[tgl2]'></td>

                              </tr>
                            </table>
                            <input type='hidden' name='aksi' value='filter_data'>
                            <input type='hidden' name='module' value='absen_kegiatan'>
                            
                            ";
                            ?>


                          </p>
                      </div>
                      <div class="modal-footer">
                          <button class='btn btn-primary metro' type='submit'>Proses</button>
                          <a href="#" class="btn" data-dismiss="modal">Close</a>
                      </div>
                    
                  </div>
                </form>

              <button class=btn onclick="window.location.href='?module=absen_kegiatan&aksi=add'">Tambah Data</button><br><br>


             
        <form id='form_data' method='post' action='<?php echo "media.php?".$_SESSION['query_string']?>'>

              <table class="table table-bordered table-mod-2" id="datatable_3" >
              <thead>
                <tr>
                  <th class='t_center'><input type='checkbox' id='selectAll' name='selectAll' /><label for='selectAll'><span></span></label></th>
                  <th>No</th>
                  <th>Nama</th> 
<?php
$sql1="SELECT * FROM `kegiatan`";
$query1=mysql_query($sql1);
while ($d1=mysql_fetch_array($query1)){
    echo "<th class=\"hidden-mobile\">$d1[nm_singkat]</th>"; 
}   
?>          
                  <th  align='center'>Aksi</th>
                </tr>
              </thead>
              <tbody>

              <?php 
$sql="";
$sql .="SELECT
absen.id,
absen.tgl_absen,
dokter_pembimbing.nama,
absen.kd_kegiatan,
absen.kd_pembimbing,";

$n=1;
$sql1="SELECT * FROM `kegiatan`";
$query1=mysql_query($sql1);
$jml=mysql_num_rows($query1);
while ($d1=mysql_fetch_array($query1)){
  if ($n!=$jml){
    $sql .="SUM(IF(absen.kd_kegiatan='$d1[kd_kegiatan]',1,0)) as $d1[nm_singkat],";
  }else{
    $sql .="SUM(IF(absen.kd_kegiatan='$d1[kd_kegiatan]',1,0)) as $d1[nm_singkat] ";
  }
 $n++; 
}


$sql .="FROM
absen
INNER JOIN dokter_pembimbing ON absen.kd_pembimbing = dokter_pembimbing.id_dokter_pembimbing
INNER JOIN kegiatan ON absen.kd_kegiatan = kegiatan.kd_kegiatan ";
if ($_GET['aksi']=='filter_data'){
  $tgl1=__convert_date($_GET['tgl1']);
  $tgl2=__convert_date($_GET['tgl2']);
  $sql .= "where tgl_absen BETWEEN '$tgl1' and '$tgl2' ";
}
$sql .="GROUP BY nama
";

//WHERE absen.tgl_absen BETWEEN '$thn_sekarang-$bln_sekarang-01' AND '$thn_sekarang-$bln_sekarang-31'
//echo $sql;
      $query=mysql_query($sql);

    
 $no=1;
  while ($r=mysql_fetch_array($query)){
    $s++;
    ?>


    <tr>
      
      <?php echo "<td class='t_center'><input type='checkbox' id='c$s' name='cek[]' value='$r[id]' /><label for='c$s'><span></span></label></td>"; ?>
      <td class="td" align="center"><?php echo $no++?></td>
      <td class="td"><?php echo $r['nama']?></td>

<?php
$sql1="SELECT * FROM `kegiatan`";
$query1=mysql_query($sql1);
while ($d1=mysql_fetch_array($query1)){
  $nm_singkat=$d1['nm_singkat'];
  echo "<td class='td' class='hidden-mobile'>$r[$nm_singkat]</td>";

    
}   
?>   
      <td class="td" align="center">
      <a href="?module=absen_kegiatan&aksi=edit&kd_pembimbing=<?php echo $r['kd_pembimbing']?>" >Edit</a> |
      <a onclick="return confirm('Apa anda yakin ingin menghapus semua data atas nama pembimbing ini...?')" href="?module=absen_kegiatan&aksi=delete&kd_pembimbing=<?php echo $r['kd_pembimbing']?>" >Delete</a>

      </td>
    </tr>

   <?php }?>
            </tbody>
            </table>  


          
<input type="hidden" name="aksi" value="proses_delete_selected" />
</form> 
<br><br>
*)ket:<br>
<table cellpadding='1' style='margin-left: 40px;'>
<?php
$sql1="SELECT * FROM `kegiatan`";
$query1=mysql_query($sql1);
while ($d1=mysql_fetch_array($query1)){
  echo "<tr><td>$d1[nm_singkat]</td><td>=</td><td> $d1[nm_kegiatan]</td>";

    
}   
?> 
</table>
 

                <div class="clearfix"></div>
                </div>
                
                </div>
                
  <?php 
  } 

}
?>



