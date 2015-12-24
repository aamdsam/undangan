<?php
if ($_GET['aksi']=='proses_delete'){
  $sql_delete="DELETE FROM `kelompok` WHERE `id`='$_GET[id]'";
  $query_delete=mysql_query($sql_delete);
  if ($query_delete){
  //header("location: media.php?$_SESSION[query_string]");
  }else{
    echo "<script>alert('data gagal dihapus'); </script";
  }
}

if ($_SERVER['REQUEST_METHOD']=='POST'){
	$simpan=mysql_query("INSERT INTO `kelompok` (`id`, `kelompok`) VALUES ('$_POST[id]', '$_POST[kelompok]')");
	if ($simpan){
		echo "<script>alert('data berhasil disimpan')</script>";
	}else{
		echo "<script>alert('data gagal disimpan')</script>";
	}
}


$no=1;
$query=mysql_query("select * from kelompok order by id asc");

?>

  

<a data-toggle="modal" href="#addLevel"><input type="button" id="btambahlevel"  value="Tambah Level" style="padding:5px;"></a>

<br><br>


<div class="grid">
              
              <div class="grid-title">
               <div class="pull-left">
                  <div class="icon-title"><i class="icon-eye-open"></i></div>
                  <span>Kelompok</span> 
                  <div class="clearfix"></div>
               </div>
               <div class="pull-right"> 
                  <div class="icon-title"><a href="#"><i class="icon-refresh"></i></a></div>
                  <div class="icon-title"><a href="#"><i class="icon-cog"></i></a></div>
               </div>
              <div class="clearfix"></div>   
              </div>
            
              <div class="grid-content">
                
                <table class="table table-bordered table-mod-2">
                <thead>
<th>kd_kelompok</th>
<th>Nama Kelompok</th>
<th>Aksi</th>
                </thead>
                <tbody>
<?php while ($r=mysql_fetch_array($query)){?>

  <tr>


    <td ><?php echo $r['id']?></td>
    <td ><?php echo $r['kelompok']?></td>
    <td width="40" " class="action-table"><a href="?module=kelompok&aksi=proses_delete&id=<?php echo $r['id']?>">Delete</a></td>

  </tr>

 <?php }?>                  
                </tbody>
              </table>  

                
              <div class="clearfix"></div>
              </div>
              
              </div>


  <!--Profile Form-->
    <div class="modal hide fade" id="addLevel">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
                ×</button>
            <h3>
                Tambah Kelompok</h3>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" method="post">
            	<table>
                	<tr>
                    	<td>Kode Level</td>
                        <td><input type="text" name="id"</td>
                    </tr>
                    <tr>
                    	<td>Nama Kelompok</td>
                        <td><input type="text" name="kelompok"</td>
                    </tr>
                    
                </table>
            
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" >Save changes</button><a href="#"
                class="btn" data-dismiss="modal">Cancel</a>
             </form>
        </div>
    </div>
    
    