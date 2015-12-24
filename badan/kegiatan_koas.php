<script src="tinymcpuk/jscripts/tiny_mce/tiny_mce.js" type="text/javascript"></script>
  <script src="tinymcpuk/jscripts/tiny_mce/tiny_lokomedia.js" type="text/javascript"></script>

<?php

if ($_SERVER['REQUEST_METHOD']=='POST'){
  if ($_POST['aksi']=='proses_update'){
    $materi_kegiatan = mysql_real_escape_string($_POST['materi_kegiatan']);
    $isi_kegiatan=mysql_real_escape_string($_POST['isi_kegiatan']);

    $sql_update="UPDATE `kegiatan_koas` SET `kd_kegiatan`='$_POST[kd_kegiatan]', `kd_dokter_pembimbing`='$_POST[kd_dokter_pembimbing]', `materi_kegiatan`='$materi_kegiatan',`isi_kegiatan`='$isi_kegiatan' WHERE (`id`='$_POST[xid]')";
    //echo $sql_update;
    $query_update=mysql_query($sql_update);
    if ($query_update){
     echo "<script>alert('data berhasil di update'); window.location.href='media.php?module=kegiatan_koas';</script";
    }else{
      echo "<script>alert('data gagal di update'); window.back();</script";
    }
    
    
  }elseif ($_POST['aksi']=='proses_insert'){
    $materi_kegiatan = mysql_real_escape_string($_POST['materi_kegiatan']);
    $isi_kegiatan=mysql_real_escape_string($_POST['isi_kegiatan']);
    $kd_kegiatan=$_POST['kd_kegiatan'];
    $sql_insert="INSERT INTO `kegiatan_koas` (`username_mahasiswa`, `kd_kegiatan`, `tgl_kegiatan`, `waktu_kegiatan`, `kd_dokter_pembimbing`, `materi_kegiatan`, `isi_kegiatan`) VALUES ('$_SESSION[username_pelamonia]', '$kd_kegiatan', '$tgl_sekarang', '$jam_sekarang', '$_POST[kd_dokter_pembimbing]', '$materi_kegiatan', '$isi_kegiatan')";
    //echo $sql_update;
    $query_insert=mysql_query($sql_insert);
    if ($query_insert){
        $sql_cek="SELECT * FROM `absen` WHERE tgl_absen='$tgl_sekarang' and kd_kegiatan='$kd_kegiatan'";
        $query_cek=mysql_query($sql_cek);
        if (mysql_num_rows($query_cek)<1){
          $sql_input_absen_pembimbing="INSERT INTO `absen` (`tgl_absen`, `kd_pembimbing`, `kd_kegiatan`) VALUES ('$tgl_sekarang', '$_POST[kd_dokter_pembimbing]', '$kd_kegiatan')";
          $query_input_absen_pembimbing=mysql_query($sql_input_absen_pembimbing);
        }
        
      echo "<script>alert('data berhasil di insert'); window.location.href='media.php?module=kegiatan_koas';</script";
    }else{
      echo "<script>alert('data gagal di insert'); window.back();</script";
    }
    
  }elseif ($_POST['aksi']=='proses_delete_selected'){
      $cek=$_POST['cek'];
	  $jumlah=count($cek);
	
			
	  for($i=0;$i<$jumlah;$i++){
	  $sql_delete_selected ="DELETE FROM kegiatan_koas WHERE `id_kegiatan_koas`='$cek[$i]'";
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
      <td colspan=3><a href='media.php?module=kegiatan_koas'><button class='btn' type='button'>Kembali</button></a></td>
    </tr>
  </table>

                   
                    

                    
                   
                </div>
                
                </div>";
  }elseif ($_GET['aksi']=='edit'){
  $sql="SELECT * from kegiatan_koas where id='$_GET[id]'";

    $query=mysql_query($sql);
    $c=mysql_fetch_array($query);


    echo "<div class='grid span10'>
                
                <div class='grid-title'>
                 <div class='pull-left'>
                    <div class='icon-title'><i class='icon-star-empty'></i></div>
                     <span style='width: 600px;'>Edit Data Dokter Pembimbing </span> 
                    <div class='clearfix'></div>
                 </div>
                 <div class='pull-right'> 
                 </div>
                <div class='clearfix'></div>   
                </div>
              
                <div class='grid-content'>";

    

    echo "<form method='POST'> <table width='100%' class='table table-bordered table-mod-2'>
    <tr>
      <td width='20%'>Kegiatan</td>
      <td width='2%'>:</td>
      <td width='78%'><select class='chzn-select chosen_select span4' name='kd_kegiatan'  >
      <option value=''>Pilih Kegiatan</option>";

      $sql1="select * from kegiatan";
      $query1=mysql_query($sql1);
      while ($r=mysql_fetch_array($query1)){
        if ($c['kd_kegiatan']==$r['kd_kegiatan']){
            $cek="selected";
        }else{
            $cek="";
        }

        echo "<option value='$r[kd_kegiatan]' $cek>$r[nm_kegiatan]</option> ";
      }
      echo "</select></td>
    </tr>
    <tr>
      <td>Dokter Pembimbing</td>
      <td>:</td>
      <td><select class='chzn-select chosen_select span4' name='kd_dokter_pembimbing'  >
      <option value=''>Pilih Dokter Pembimbing</option>";

      $sql1="select * from dokter_pembimbing";
      $query1=mysql_query($sql1);
      while ($r=mysql_fetch_array($query1)){
         if ($c['kd_dokter_pembimbing']==$r['id_dokter_pembimbing']){
            $cek="selected";
        }else{
            $cek="";
        }

        echo "<option value='$r[id_dokter_pembimbing]' $cek>$r[nama]</option> ";
      }
      echo "</select></td>
    </tr>
    <tr>
      <td>Judul / Materi Kegiatan</td>
      <td>:</td>
      <td><input type='text' class='span6' name='materi_kegiatan' value='$c[materi_kegiatan]'> </td>
    </tr>
    <tr>
      <td>Isi Materi Kegiatan</td>
      <td>:</td>
      <td><textarea name='isi_kegiatan' id='loko' style='width:100%; height:100%;'>$c[isi_kegiatan]</textarea></td>
    </tr>
     <tr>
      <td colspan=3>
      <input type='hidden' name='aksi' value='proses_update'>
      <input type='hidden' name='xid' value='$_GET[id]'>
      <button class='btn' type='submit'>Update</button> &nbsp; &nbsp; &nbsp; <a href='media.php?module=kegiatan_koas'><button class='btn' type='button'>Kembali</button></a></td>
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
                     <span style='width: 600px;'>Tambah Kegiatan KOAS Mahasiswa</span> 
                    <div class='clearfix'></div>
                 </div>
                 <div class='pull-right'> 
                 </div>
                <div class='clearfix'></div>   
                </div>
              
                <div class='grid-content'>
  
           
    <form method='POST'> <table width='100%' class='table table-bordered table-mod-2'>
    <tr>
      <td width='20%'>Kegiatan</td>
      <td width='2%'>:</td>
      <td width='78%'><select class='chzn-select chosen_select span4' name='kd_kegiatan'  >
      <option value=''>Pilih Kegiatan</option>";

      $sql1="select * from kegiatan";
      $query1=mysql_query($sql1);
      while ($r=mysql_fetch_array($query1)){
        
        echo "<option value='$r[kd_kegiatan]' >$r[nm_kegiatan]</option> ";
      }
      echo "</select></td>
    </tr>
    <tr>
      <td>Dokter Pembimbing</td>
      <td>:</td>
      <td><select class='chzn-select chosen_select span4' name='kd_dokter_pembimbing'  >
      <option value=''>Pilih Dokter Pembimbing</option>";

      $sql1="select * from dokter_pembimbing";
      $query1=mysql_query($sql1);
      while ($r=mysql_fetch_array($query1)){
        
        echo "<option value='$r[id_dokter_pembimbing]' >$r[nama]</option> ";
      }
      echo "</select></td>
    </tr>
    <tr>
      <td>Judul / Materi Kegiatan</td>
      <td>:</td>
      <td><input type='text' class='span6' name='materi_kegiatan' </td>
    </tr>
    <tr>
      <td>Isi Materi Kegiatan</td>
      <td>:</td>
      <td><textarea name='isi_kegiatan' id='loko' style='width:100%; height:100%;'></textarea></td>
    </tr>
    <tr>
      <td colspan=3>
      <input type='hidden' name='aksi' value='proses_insert'>
      
      <button class='btn' type='submit'>Insert</button> &nbsp; &nbsp; &nbsp; <a href='media.php?module=kegiatan_koas'><button class='btn' type='button'>Kembali</button></a></td>
    </tr>
  </table></form>

                   
                    

                    
                   
                </div>
                
                </div>";
  }elseif ($_GET['aksi']=='delete'){
    $sql_delete="DELETE FROM `kegiatan_koas` WHERE `id`='$_GET[id]'";
    $query_delete=mysql_query($sql_delete);
    if ($query_delete){
      echo "<script>window.location.href='media.php?module=kegiatan_koas';</script";
    }else{
      echo "<script>alert('data gagal di hapus'); window.back();</script";
    }

  }else{
  ?>
  <div class="grid">
                
                <div class="grid-title">
                 <div class="pull-left">
                    <div class="icon-title"><i class="icon-eye-open"></i></div>
                    <span style="width: 300px;">Kegiatan KOAS Mahasiswa</span> 
                    <div class="clearfix"></div>
                 </div>
                 <div class="pull-right"> 
                    <div class="icon-title"><a href="#"><i class="icon-refresh"></i></a></div>
                    <div class="icon-title"><a href="#"><i class="icon-cog"></i></a></div>
                 </div>
                <div class="clearfix"></div>   
                </div>
              
                <div class="grid-content">
                  <button class=btn onclick="window.location.href='?module=kegiatan_koas&aksi=add'">Tambah Data</button><br><br>

              

             
				<form id='form_data' method='post' action='<?php echo "media.php?".$_SESSION['query_string']?>'>
              <table class="table table-bordered table-mod-2" id="datatable_3" >
              <thead>
                <tr>
                  <th>No</th>
                  <th class="hidden-mobile">Tanggal</th>
                  <th >Kegiatan</th>
                  <th >Nama Pembimbing</th>
                  <th class="hidden-mobile">Judul Materi Kegiatan</th>              
                  <th class="hidden-mobile" align='center'>Aksi</th>
                </tr>
              </thead>
              <tbody>

              <?php 


 

      $query=mysql_query("SELECT * from view_kegiatan_koas where username_mahasiswa='$_SESSION[username_pelamonia]' order by id DESC");
    
 $no=1;
  while ($r=mysql_fetch_array($query)){
	  $s++;
	  ?>


    <tr>
    	
      <td class="td" align="center"><?php echo $no++?></td>
      <td class="td"><?php echo __convert_date_indo($r['tgl_kegiatan']); ?></td>
      <td class="td"><?php echo $r['nm_kegiatan']?></td>
      <td class="td"><?php echo $r['nama']?></td>
      <td class="td" class="hidden-mobile"><?php echo $r['materi_kegiatan']?></td>
      <td class="td" align="center">
      <a href="?module=kegiatan_koas&aksi=edit&id=<?php echo $r['id']?>" >Edit</a> |
      <a onclick="return confirm('Apa anda yakin...?')" href="?module=kegiatan_koas&aksi=delete&id=<?php echo $r['id']?>" >Delete</a>

      </td>
    </tr>

   <?php }?>
            </tbody>
            </table>  


          
<input type="hidden" name="aksi" value="proses_delete_selected" />
</form> 
                <div class="clearfix"></div>
                </div>
                
                </div>
                
  <?php 
  } 

}
?>



