<script type="text/javascript">
$(document).ready(function(){   
$("#cetak").click(function(){

 // alert('test');
  MM_openBrWindow('badan/ctk_kartu_pembimbing.php?<?php echo "kd_pembimbing=$_GET[kd_pembimbing]&tgl1=$_GET[tgl1]"; ?>','cetak','width=800,height=600');

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


<?php


if ($_SERVER['REQUEST_METHOD']=='POST'){
  if ($_POST['aksi']=='proses_update'){
    $nama = mysql_real_escape_string($_POST['nama']);
    $ket=mysql_real_escape_string($_POST['ket']);

    $sql_update="UPDATE `dokter_pembimbing` SET `nama`='$nama', `kd_pangkat`='$_POST[kd_pangkat]', `kd_bagian`='$_POST[kd_bagian]', `ket`='$ket' WHERE (`id_dokter_pembimbing`='$_POST[xid]')";
   // echo $sql_update;
    $query_update=mysql_query($sql_update);
    if ($query_update){
     echo "<script>alert('data berhasil di update'); window.location.href='media.php?module=dokter_pembimbing';</script";
    }else{
      echo "<script>alert('data gagal di update'); window.back();</script";
    }
    
  }elseif ($_POST['aksi']=='proses_insert'){
    //echo "post_aksi".$_POST['aksi'];
    $nama = mysql_real_escape_string($_POST['nama']);
    $ket=mysql_real_escape_string($_POST['ket']);

    $sql_insert="INSERT INTO `dokter_pembimbing` (`nama`, `kd_pangkat`, `kd_bagian`, `ket`) VALUES ('$nama', '$_POST[kd_pangkat]', '$_POST[kd_bagian]', '$ket')";
    //echo $sql_update;
    $query_insert=mysql_query($sql_insert);
    if ($query_insert){
      echo "<script>alert('data berhasil di insert'); window.location.href='media.php?module=dokter_pembimbing';</script";
    }else{
      echo "<script>alert('data gagal di insert'); window.back();</script";
    }
    
  }elseif ($_POST['aksi']=='proses_delete_selected'){
      $cek=$_POST['cek'];
	  $jumlah=count($cek);
	
			
	  for($i=0;$i<$jumlah;$i++){
	  $sql_delete_selected ="DELETE FROM dokter_pembimbing WHERE `id_dokter_pembimbing`='$cek[$i]'";
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
      <td colspan=3><a href='media.php?module=dokter_pembimbing'><button class='btn' type='button'>Kembali</button></a></td>
    </tr>
  </table>

                   
                    

                    
                   
                </div>
                
                </div>";
  }elseif ($_GET['aksi']=='edit'){
  $sql="SELECT * from dokter_pembimbing where id_dokter_pembimbing='$_GET[id]'";

    $query=mysql_query($sql);
    $c=mysql_fetch_array($query);


    echo "<div class='grid span10'>
                
                <div class='grid-title'>
                 <div class='pull-left'>
                    <div class='icon-title'><i class='icon-star-empty'></i></div>
                     <span style='width: 600px;'>Edit Data Dokter Pembimbing</span> 
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
      <td width='78%'><input type='text' name='nama' class='span4' value='$c[nama]'></td>
    </tr>
    <tr>
      <td>Pangkat</td>
      <td>:</td>
      <td><select class='chzn-select chosen_select' name='kd_pangkat'  >
      <option value=''>Pilih Pangkat</option>";

      $sql1="select * from pangkat";
      $query1=mysql_query($sql1);
      while ($r=mysql_fetch_array($query1)){
        if ($c['kd_pangkat']==$r['kd_pangkat']){
          $cek= "selected";
        }else{
          $cek="";
        }
        
        echo "<option value='$r[kd_pangkat]' $cek>$r[nm_pangkat]</option> ";
      }
      echo "</td>
    </tr>
    <tr>
      <td>Bagian</td>
      <td>:</td>
      <td><select class='chzn-select chosen_select' name='kd_bagian'  >
      <option value=''>Pilih Bagian</option>";

      $sql1="select * from bagian";
      $query1=mysql_query($sql1);
      while ($r=mysql_fetch_array($query1)){
        if ($c['kd_bagian']==$r['kd_bagian']){
          $cek= "selected";
        }else{
          $cek="";
        }
        
        echo "<option value='$r[kd_bagian]' $cek>$r[nm_bagian]</option> ";
      }
      echo "</td>
    </tr>
    <tr>
      <td>Keterangan</td>
      <td>:</td>
      <td><input type='text' name='ket' class='span3' value='$c[ket]'></td>
    </tr>
     <tr>
      <td colspan=3>
      <input type='hidden' name='aksi' value='proses_update'>
      <input type='hidden' name='xid' value='$_GET[id]'>
      <button class='btn' type='submit'>Update</button> &nbsp; &nbsp; &nbsp; <a href='media.php?module=dokter_pembimbing'><button class='btn' type='button'>Kembali</button></a></td>
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
                     <span style='width: 600px;'>Tambah Dokter Pembimbing</span> 
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
      <td width='78%'><input type='text' name='nama' class='span4' value=''></td>
    </tr>
    <tr>
      <td>Pangkat</td>
      <td>:</td>
      <td><select class='chzn-select chosen_select' name='kd_pangkat'  >
      <option value=''>Pilih Pangkat</option>";

      $sql1="select * from pangkat";
      $query1=mysql_query($sql1);
      while ($r=mysql_fetch_array($query1)){
        
        echo "<option value='$r[kd_pangkat]' >$r[nm_pangkat]</option> ";
      }
      echo "</td>
    </tr>
    <tr>
      <td>Bagian</td>
      <td>:</td>
      <td><select class='chzn-select chosen_select' name='kd_bagian'  >
      <option value=''>Pilih Bagian</option>";

      $sql1="select * from bagian";
      $query1=mysql_query($sql1);
      while ($r=mysql_fetch_array($query1)){
        
        echo "<option value='$r[kd_bagian]' >$r[nm_bagian]</option> ";
      }
      echo "</td>
    </tr>
    <tr>
      <td>Keterangan</td>
      <td>:</td>
      <td><input type='text' name='ket' class='span3' value=''></td>
    </tr>
    <tr>
      <td colspan=3>
      <input type='hidden' name='aksi' value='proses_insert'>
      
      <button class='btn' type='submit'>Insert</button> &nbsp; &nbsp; &nbsp; <a href='media.php?module=dokter_pembimbing'><button class='btn' type='button'>Kembali</button></a></td>
    </tr>
  </table></form>

                   
                    

                    
                   
                </div>
                
                </div>";
  }elseif ($_GET['aksi']=='delete'){
    $sql_delete="DELETE FROM `dokter_pembimbing` WHERE `id_dokter_pembimbing`='$_GET[id]'";
    $query_delete=mysql_query($sql_delete);
    if ($query_delete){
      echo "<script>window.location.href='media.php?module=dokter_pembimbing';</script";
    }else{
      echo "<script>alert('data gagal di hapus'); window.back();</script";
    }

  }else{
  ?>
  <div class="grid">
                
                <div class="grid-title">
                 <div class="pull-left">
                    <div class="icon-title"><i class="icon-eye-open"></i></div>
                    <span style="width: 500px;">Kartu Rincian Kegiatan Pembimbing Klinik</span> 
                    <div class="clearfix"></div>
                 </div>
                 <div class="pull-right"> 
                    <div class="icon-title"><a href="#"><i class="icon-refresh"></i></a></div>
                    <div class="icon-title"><a href="#"><i class="icon-cog"></i></a></div>
                 </div>
                <div class="clearfix"></div>   
                </div>
              
                <div class="grid-content">
                 
             
				<form id='form_data' method='get'>

              <table class='table table-bordered table-mod-2'>
                <thead>
                  <th colspan=3>Pilih Kategori</th>
                </thead>
    <tbody>
    <tr>
      <td class="td" >Masukkan Nama Pembimbing</td>
      <td class="td" align="center">:</td>
      <td class="td">
        <?php
        echo "<select class='chzn-select chosen_select span3' name='kd_pembimbing'  >
      <option value=''>Masukkan Nama</option>";

      $sql1="select * from dokter_pembimbing order by nama asc";
      $query1=mysql_query($sql1);
      while ($r=mysql_fetch_array($query1)){
        if ($_GET['kd_pembimbing']==$r['id_dokter_pembimbing']){
          $selected="selected";
        }else{
          $selected="";
        }
        echo "<option value='$r[id_dokter_pembimbing]' $selected>$r[nama]</option> ";
      };

      ?>
      </td>
    </tr>
    <tr>
      <td class="td" >Masukkan tanggal awal</td>
      <td class="td" align="center">:</td>
      <td class="td"><input type='text'  name='tgl1' id='tgl1' value='<?php echo $_GET[tgl1]?>'>    </td>
    </tr>
    <tr><td colspan=3><button class=btn>Proses</button></td></tr>

           </tbody> </table>  


          
<input type="hidden" name="aksi" value="cari_data" />
<input type="hidden" name="module" value="kartu_pembimbing" />
</form> 
                <div class="clearfix"></div>
<?php
if ($_GET['aksi']=='cari_data'){
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

$date1=get_date($tgl1);
$date2=get_date($tgl2);
$date3=get_date($tgl3);
$date4=get_date($tgl4);
$date5=get_date($tgl5);




    echo "
    <hr>
    <center><h4>Rincian Kegiatan Pembimbing Klinik</h4></center><br>
    Tanggal : <b>".tgl_indo($tgl1)."</b> s.d. <b>".tgl_indo($tgl5)."</b><br><br>
    <button class=btn id='cetak'> Cetak</button>
    <table class='table table-bordered table-mod-2'>
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
    <div style='float:right'><u><b>($d2[nama])</b></u></div>
    <div class='clearfix'></div>
                    </div>
                    
                    </div>";
    }

  } 

}
?>



