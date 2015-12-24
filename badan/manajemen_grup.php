<?php

  if ($_SESSION['leveluser_ntb']!=1){
	echo "<script language='javascript'>window.location.href='media.php';</script>"; 
}

if ($_SERVER['REQUEST_METHOD']=='POST'){
	$simpan=mysql_query("INSERT INTO grup VALUES ('','$_POST[nama]' ,'$_POST[grup]', '$_POST[sub]')");
	if ($simpan){
		echo "<script>alert('data berhasil disimpan')</script>";
	}else{
		echo "<script>alert('data gagal disimpan')</script>";
	}
}


$no=1;
$query=mysql_query("SELECT t1.id, t2.title, t3.nama FROM grup t1
                    INNER JOIN chart t2 ON t1.id_chart_grup=t2.id
                    INNER JOIN tree_submenu t3 ON t1.id_skpd=t3.id
                    ORDER BY t1.id_chart_grup ASC");

?>

  

<a data-toggle="modal" href="#addLevel"><input type="button" id="btambahlevel"  value="Tambah Grup" style="padding:5px;"></a>

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
                
                <table class="table table-bordered table-mod-2" id="datatable_3">
                <thead>
<th>No</th>
<th>Nama Grup</th>
<th>Nama Sub</th>
<th>Nama</th>
<th>Aksi</th>
                </thead>
                <tbody>
<?php while ($r=mysql_fetch_array($query)){?>

  <tr>

    <td align="center"><?php echo $no++?></td>
    <td ><?php echo $r[nama]?></td>
    <td ><?php echo $r[title]?></td>
    <td ><?php echo $r[nama_lengkap]?></td>
    <td width="40" " class="action-table"><a href="badan/delete.php?aksi=DelGrup&id=<?php echo $r['id']?>">Delete</a></td>

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
                    	<td>Grup</td>
                      <td>&nbsp;</td>
                        <td>
                          <select name='grup'>
                              <option>Pilih Grup</option>
                              <?php
                              $sql=mysql_query("SELECT * FROM tree_submenu ORDER BY id asc");
                              while ($data=mysql_fetch_array($sql)) {
                                echo "<option value='$data[id]'>$data[nama]</option>";
                              }
                              ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                    	<td>Sub</td>
                      <td>&nbsp;</td>
                        <td><select name='sub'>
                              <option>Pilih Grup</option>
                              <?php
                              $sql=mysql_query("SELECT * FROM chart t1 WHERE NOT EXISTS 
                                                 (SELECT * FROM grup t2 WHERE t1.id = t2.id_chart_grup) AND t1.tampil='Y' ORDER BY t1.title asc");
                              while ($data=mysql_fetch_array($sql)) {
                                      echo "<option value='$data[id]'>$data[title]</option>";
                                
                              }
                              ?>
                            </select></td>
                    </tr>
                </table>
            
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" >Save changes</button><a href="#"
                class="btn" data-dismiss="modal">Cancel</a>
             </form>
        </div>
    </div>
    
    