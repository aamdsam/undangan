<script type="text/javascript">
function update_data(a,b,c){
  var loading = $("#loader");
    //alert(a+" dan "+b+" dan "+c);
    loading.show();
    $("#pesan").html("memproses data....!!!");
    $("#pesan").show();
    if (a=='N'){
      var cek='Y';
    }else{
      var cek='N';
    }

      $.ajax({
        type:"GET",
        url:"proses.php",
        data:"aksi=proses_update_dilabel&id="+b+"&dilabel="+cek,
        success:function(data){
        $("#pesan").html(data);
        $("#pesan").fadeOut(5000);
        loading.hide(1000);
        }

      });
}
</script>
<?php
if ($_SERVER['REQUEST_METHOD']=='POST'){
  if ($_POST['aksi']=='proses_update'){
    $sql_update="UPDATE `data_telepon` SET `nik`='$_POST[nik]', `nama`='$_POST[nama]', `no_telepon`='$_POST[no_telepon]' WHERE (`id`='$_POST[xid]')";
    //echo $sql_update;
    $query_update=mysql_query($sql_update);
    if ($query_update){
      echo "<script>alert('data berhasil di update'); window.location.href='media.php?module=data_telepon';</script";
    }else{
      echo "<script>alert('data gagal di update'); window.back();</script";
    }
    
  }elseif ($_POST['aksi']=='proses_insert'){
    $sql_insert="insert into `data_telepon`SET `nik`='$_POST[nik]', `nama`='$_POST[nama]', `no_telepon`='$_POST[no_telepon]'";
    //echo $sql_update;
    $query_insert=mysql_query($sql_insert);
    if ($query_insert){
      echo "<script>alert('data berhasil di insert'); window.location.href='media.php?module=data_telepon';</script";
    }else{
      echo "<script>alert('data gagal di insert'); window.back();</script";
    }
    
  }elseif ($_POST['aksi']=='proses_delete_selected'){
      $cek=$_POST['cek'];
	  $jumlah=count($cek);
	
			
	  for($i=0;$i<$jumlah;$i++){
	  $sql_delete_selected ="DELETE FROM data_telepon WHERE `id`='$cek[$i]'";
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
  if ($_GET['aksi']=='edit'){
  $sql="SELECT * from data_telepon where id='$_GET[id]'";

    $query=mysql_query($sql);
    $c=mysql_fetch_array($query);


    echo "<div class='grid span10'>
                
                <div class='grid-title'>
                 <div class='pull-left'>
                    <div class='icon-title'><i class='icon-star-empty'></i></div>
                     <span style='width: 600px;'>Edit Data Telepon</span> 
                    <div class='clearfix'></div>
                 </div>
                 <div class='pull-right'> 
                 </div>
                <div class='clearfix'></div>   
                </div>
              
                <div class='grid-content'>";

    

    echo "<form method='POST'> <table width='100%' class='table table-bordered table-mod-2'>
    <tr>
      <td width='20%'>Nomor Identitas KTP</td>
      <td width='2%'>:</td>
      <td width='78%'><input type='text' name='nik' class='span3' value='$c[nik]'></td
    </tr>
    <tr>
      <td>Nama</td>
      <td>:</td>
      <td><input type='text' name='nama`' class='span4' value='$c[nama]'></td
    </tr>
    <tr>
      <td>No. Telepon</td>
      <td>:</td>
      <td><input type='text' name='no_telepon' class='span3' value='$c[no_telepon]'></td
    </tr>
    <tr>
      <td>Keterangan</td>
      <td>:</td>
      <td><input type='text' name='ket' class='span1' value='$c[ket]'></td>
    </tr>
    <tr>
      <td colspan=3>
      <input type='hidden' name='aksi' value='proses_update'>
      <input type='hidden' name='xid' value='$_GET[id]'>
      
      <button class='btn' type='submit'>Update</button> &nbsp; &nbsp; &nbsp; <a href='media.php?module=data_telepon'><button class='btn'  type='button'>Kembali</button></a></td>
    </tr>
  </table></form>

                   
                    

                    
                   
                </div>
                
                </div>";
  }elseif ($_GET['aksi']=='add'){
  echo "<div class='grid span10'>
                  
                  <div class='grid-title'>
                   <div class='pull-left'>
                      <div class='icon-title'></div>
                      <span style='min-width:800px'>Ekspor &amp; Impor Data Excell</span> 
                      <div class='clearfix'></div>
                   </div>
                   
                  <div class='clearfix'></div>   
                  </div>
                
                  <div class='grid-content'>
                  1. Ekspor Data ke Excell<br>
                      Sebelum melakukan Impor data dari Excell, Silahkan <a href='badan/PHPExcel/Examples/eks_data_telepon.php' >Backup Data Lama anda </a>atau download format yang baku terlebih dahulu <a href='badan/impor/format_data_telepon.xls' >disini... <img src='badan/excel-icon.jpeg' width='18' height='18' border='0' ></a> 
                      <br><br>

                      2. Impor data dari Excell<br>

                      Upload data Format Excel 2003 (*.xls) terbaru :
                      <form action='badan/impor/proses_impor_data_telepon.php' method='post' enctype='multipart/form-data'>
                      <input type='file' name='file_excel' >
                      <input type='hidden' name='module' value='$_GET[module]'>
                      <button type='submit' onclick=\"return confirm('Apa anda yakin...?')\" >Upload</button>
                      </form></div>
                
                </div>



    <br><br><div class='grid span10'>
                
                <div class='grid-title'>
                 <div class='pull-left'>
                    <div class='icon-title'><i class='icon-star-empty'></i></div>
                     <span style='width: 600px;'>Tambah Data No Telepon</span> 
                    <div class='clearfix'></div>
                 </div>
                 <div class='pull-right'> 
                 </div>
                <div class='clearfix'></div>   
                </div>
              
                <div class='grid-content'>";

    

    echo "<form method='POST'> <table width='100%' class='table table-bordered table-mod-2'>
    <tr>
      <td width='20%'>Nomor Identitas KTP</td>
      <td width='2%'>:</td>
      <td width='78%'><input type='text' name='nik' class='span3' value=''></td
    </tr>
    <tr>
      <td>Nama</td>
      <td>:</td>
      <td><input type='text' name='nama`' class='span4' value=''></td
    </tr>
    <tr>
      <td>No. Telepon</td>
      <td>:</td>
      <td><input type='text' name='no_telepon' class='span3' value=''></td
    </tr>
    <tr>
      <td>Keterangan</td>
      <td>:</td>
      <td><input type='text' name='ket' class='span1' value=''></td>
    </tr>
    <tr>
      <td colspan=3>
      <input type='hidden' name='aksi' value='proses_insert'>
      
      <button class='btn' type='submit'>Insert</button> &nbsp; &nbsp; &nbsp; <a href='media.php?module=data_telepon'><button class='btn' type='button'>Kembali</button></a></td>
    </tr>
  </table></form>

                   
                    

                    
                   
                </div>
                
                </div>";
  }elseif ($_GET['aksi']=='delete'){
    $sql_delete="DELETE FROM `data_telepon` WHERE `id`='$_GET[id]'";
    $query_delete=mysql_query($sql_delete);
    if ($query_delete){
      echo "<script>window.location.href='media.php?module=data_telepon';</script";
    }else{
      echo "<script>alert('data gagal di hapus'); window.back();</script";
    }

  }else{
  ?>
  <div class="grid">
                
                <div class="grid-title">
                 <div class="pull-left">
                    <div class="icon-title"><i class="icon-eye-open"></i></div>
                    <span style="width: 300px;">Undangan yang dilabel</span> 
                    <div class="clearfix"></div>
                 </div>
                 <div class="pull-right"> 
                    <div class="icon-title"><a href="#"><i class="icon-refresh"></i></a></div>
                    <div class="icon-title"><a href="#"><i class="icon-cog"></i></a></div>
                 </div>
                <div class="clearfix"></div>   
                </div>
              
                <div class="grid-content">
                 <img src="images/loader.gif" id='loader' width='20' style='display:none'> <span id='pesan' style='display:none'>memproses data... !!!</span><br><br>
               <form id='form_data' method='get' action='<?php echo "media.php?".$_SESSION['query_string']?>'> 
                   <input type="hidden" name="aksi" value="proses_tampilkan_data" />
                   <input type="hidden" name="module" value="undangan_dilabel" />
                   Tampilkan: <select name='dilabel' id='dilabel'>
                    <option value='A' <?php if ($_GET['dilabel']=='A'){echo "selected"; } ?> >Semua Data</option>
                    <option value='Y' <?php if ($_GET['dilabel']=='Y'){echo "selected"; } ?>>Data yang sudah dilabel</option>
                    <option value='N' <?php if ($_GET['dilabel']=='N'){echo "selected"; } ?>>Data yang belum dilabel</option>
                    
                 </select>
                </form>   
              <table class="table table-bordered table-mod-2" id="datatable_3">
              <thead>
                <tr>
                  <th>No</th>
                  <th >Nama</th>
                  <th >Alamat</th>
                  <th class="hidden-mobile">Kelompok</th>
                  <th class='t_center'>Dilabel</th>
                  <!--input type='checkbox' id='selectAll' name='selectAll' /><label for='selectAll'><span></span></label-->  
                </tr>
              </thead>
              <?php 
              $no=1;
   if($_GET['aksi']=='proses_tampilkan_data'){
    if ($_GET['dilabel']=='A'){
      $sql_t="select * from view_daftar_undangan order by id desc";
    }elseif ($_GET['dilabel']=='Y'){
      $sql_t="select * from view_daftar_undangan where dilabel='Y' order by id desc";
    }elseif ($_GET['dilabel']=='N'){
      $sql_t="select * from view_daftar_undangan where dilabel='N' order by id desc";
    }
  }else{
      $sql_t="select * from view_daftar_undangan order by id desc";
  }

  $query=mysql_query($sql_t);
  while ($r=mysql_fetch_array($query)){
	  $s++;
	  ?>


    <tr>
       <td class="td" align="center"><?php echo $no++?></td>
      <td class="td"><?php echo $r['nama']?></td>
      <td class="td"><?php echo $r['alamat']?></td>
      <td class="td" class="hidden-mobile"><?php echo $r['kelompok']?></td>
      <?php 
      if ($r['dilabel']=='Y'){
        $checked="checked";
        $s_dilabel="sudah";
      }else{
        $checked="";
        $s_dilabel="belum";
      }
      echo "<td class='t_center'><input type='checkbox' id='c$s' onclick='javascript: update_data(\"$r[dilabel]\",\"$r[id]\",\"c$s\")' name='cek[]' value='$r[dilabel]' $checked /><label for='c$s'><span></span></label></td>"; ?>
      
      
    </tr>

   <?php }?>
            </table> <br /><br /> 

    
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
$('#dilabel').change(function(){
    $( "#form_data" ).submit();
})
$('#selectAll').click(function (e) {
    $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
});
</script>