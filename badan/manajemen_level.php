<?php

  if ($_SESSION['leveluser_pelamonia']!=1){
	echo "<script language='javascript'>window.location.href='media.php';</script>"; 
}

if ($_SERVER['REQUEST_METHOD']=='POST'){
	$simpan=mysql_query("INSERT INTO `level` (`kd_level`, `nm_level`) VALUES ('$_POST[kd_level]', '$_POST[nm_level]')");
	if ($simpan){
		echo "<script>alert('data berhasil disimpan')</script>";
	}else{
		echo "<script>alert('data gagal disimpan')</script>";
	}
}


$no=1;
$query=mysql_query("select * from level order by kd_level asc");

?>

  

<a data-toggle="modal" href="#addLevel"><input type="button" id="btambahlevel"  value="Tambah Level" style="padding:5px;"></a>

<br><br>


<div class="grid">
              
              <div class="grid-title">
               <div class="pull-left">
                  <div class="icon-title"><i class="icon-eye-open"></i></div>
                  <span>Manajemen Level</span> 
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
<th>No</th>
<th>Kode Level</th>
<th>Nama Level</th>
<th>Aksi</th>
                </thead>
                <tbody>
<?php while ($r=mysql_fetch_array($query)){?>

  <tr>

    <td align="center"><?php echo $no++?></td>
    <td ><?php echo $r['kd_level']?></td>
    <td ><?php echo $r['nm_level']?></td>
    <td width="40" " class="action-table"><a href="badan/delete.php?aksi=delLevel&id=<?php echo $r['kd_level']?>">Delete</a></td>

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
                Tambah Level</h3>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" method="post">
            	<table>
                	<tr>
                    	<td>Kode Level</td>
                        <td><input type="text" name="kd_level"</td>
                    </tr>
                    <tr>
                    	<td>Nama Level</td>
                        <td><input type="text" name="nm_level"</td>
                    </tr>
                    
                </table>
            
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" >Save changes</button><a href="#"
                class="btn" data-dismiss="modal">Cancel</a>
             </form>
        </div>
    </div>
    
    