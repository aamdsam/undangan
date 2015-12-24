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
	  $sql_delete_selected ="DELETE FROM nama_undangan WHERE `id`='$cek[$i]'";
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
                     <span style='width: 600px;'>Tambah Daftar Undangan</span> 
                    <div class='clearfix'></div>
                 </div>
                 <div class='pull-right'> 
                 </div>
                <div class='clearfix'></div>   
                </div>
              
                <div class='grid-content'>

                1. Ekspor Data ke Excell<br>
                      Sebelum melakukan Impor data dari Excell, Silahkan <a href='badan/PHPExcel/Examples/eks_daftar_undangan.php' >Backup Data Lama anda </a>atau download format yang baku terlebih dahulu <a href='badan/impor/format_daftar_undangan.xls' >disini... <img src='badan/excel-icon.jpeg' width='18' height='18' border='0' ></a> 
                      <br><br>

                      2. Impor data dari Excell<br>

                      Upload data Format Excel 2003 (*.xls) terbaru :
                      <form action='badan/impor/proses_impor_daftar_undangan.php' method='post' enctype='multipart/form-data'>
                      <input type='file' name='file_excel' >
                      <input type='hidden' name='module' value='$_GET[module]'>
                      <button type='submit' onclick=\"return confirm('Apa anda yakin...?')\" >Upload</button>
                      </form>

                   
                    

                    
                   
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
                    <span style="width: 300px;">Daftar Undangan</span> 
                    <div class="clearfix"></div>
                 </div>
                 <div class="pull-right"> 
                 </div>
                <div class="clearfix"></div>   
                </div>
              
                <div class="grid-content">
                 
              
                 <a href='?module=daftar_undangan&aksi=add'><span class='icon-rss'></span></span> Ekspor / Impor Data</a>

                  <br><br><br><br><br>
             
				<form id='form_data1' method='get' action='<?php echo "media.php?".$_SESSION['query_string']?>'> 
                   <input type="hidden" name="aksi" value="proses_tampilkan_data" />
                   <input type="hidden" name="module" value="daftar_undangan" />
                   Tampilkan: <select name='kd_kelompok' id='kd_kelompok'>
                    <option value='A' <?php if ($_GET['kd_kelompok']=='A'){echo "selected"; } ?> >Semua Data</option>
                    
                    <?php
                      $sql2="select * from kelompok";
                      $query2=mysql_query($sql2);
                      while ($d2=mysql_fetch_array($query2)){
                        if ($d2['id']==$_GET['kd_kelompok']){
                          $selected="selected";
                        }else{
                          $selected="";
                        }
                        echo "<option value='$d2[id]' $selected >$d2[kelompok]</option>";
                      }
                    ?>

                    
                 </select>
                </form> 
                <form id='form_data' method='post' action='<?php echo "media.php?".$_SESSION['query_string']?>'>
                
              <table class="table table-bordered table-mod-2" id="datatable_3" >
              <thead>
                <tr>
                  <th class='t_center'><input type='checkbox' id='selectAll' name='selectAll' /><label for='selectAll'><span></span></label></th>
                  <th>No</th>
                  <th class="hidden-mobile">Nama</th>
                  <th >Alamat</th>
                  <th >Kelompok</th>
                </tr>
              </thead>
              <tbody>

              <?php 


    if($_GET['aksi']=='proses_tampilkan_data'){
    if ($_GET['kd_kelompok']=='A'){
      $sql_t="SELECT * from view_daftar_undangan order by id DESC";
    }else{
      $sql_t="SELECT * from view_daftar_undangan where kd_kelompok='$_GET[kd_kelompok]' order by id DESC";
    }
  }else{
      $sql_t="SELECT * from view_daftar_undangan order by id DESC";
  }
  //echo $sql_t;

  $query=mysql_query($sql_t);
    
 $no=1;
  while ($r=mysql_fetch_array($query)){
	  $s++;
	  ?>


    <tr>
    	<?php echo "<td class='t_center'><input type='checkbox' id='c$s' name='cek[]' value='$r[id]' /><label for='c$s'><span></span></label></td>"; ?>
      <td class="td" align="center"><?php echo $no++?></td>
      <td class="td"><?php echo $r['nama']?></td>
      <td class="td"><?php echo $r['alamat']?></td>
      <td class="td"><?php echo $r['kelompok']?></td>
    </tr>

   <?php }?>
            </tbody>
            </table>  

<br /><br /> 

    <span class='icon-check'></span> <a href='#' id='delete_selected' >Delete Selected</a>   
    <input type="hidden" name="aksi" value="proses_delete_selected" />
</form>   
                <div class="clearfix"></div>
                </div>
                
                </div>
                
  <?php 
  } 

}
?>


<script>
$('#delete_selected').click(function(){
  var konfirmasi=confirm("Apa anda yakin... ?");
  if (konfirmasi==true){
    $( "#form_data" ).submit();
  }
})
$('#kd_kelompok').change(function(){
    $( "#form_data1" ).submit();
})
$('#selectAll').click(function (e) {
    $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
});
</script>


