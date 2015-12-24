<?php

  if ($_SESSION['leveluser_pelamonia']!=1){
  echo "<script language='javascript'>alert('maaf anda tidak berhak mengakses halaman ini...'); window.location.href='media.php';</script>"; 
  header("location: media.php");
}



$no=1;
$query=mysql_query("select * from user order by userid asc");

?>
<a href="?module=addUser"><input type="button" class="btn" id="btambahuser"  value="Tambah User"></a>


<div class="grid">
              
              <div class="grid-title">
               <div class="pull-left">
                  <div class="icon-title"><i class="icon-eye-open"></i></div>
                  <span>Manajemen User</span> 
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
    <th scope="col" class="th">NO</th>
    <th  scope="col" class="th">Username</th>
    <th  scope="col" class="th" class="hidden-mobile">Nama Lengkap</th>
    <th scope="col" class="th" >Email</th>
    <th  scope="col" class="th" class="hidden-mobile">Level</th>
    <th  scope="col" class="th" class="hidden-mobile">Blokir</th>
    <th  scope="col" class="th">Aksi</th>


                </thead>
                <tbody>

<?php while ($r=mysql_fetch_array($query)){?>

  <tr>
    <td class="td" align="center"><?php echo $no++?></td>
    <td class="td"><?php echo $r['username']?></td>
    <td class="td" class="hidden-mobile"><?php echo $r['nama_lengkap']?></td>
    <td class="td"><?php echo $r['email']?></td>
  <td class="td" class="hidden-mobile">
  <?php 
  $sql1="select nm_level from level where kd_level='$r[level_user]'";
  $query1=mysql_query($sql1);
  $l=mysql_fetch_array($query1);
  echo $l['nm_level'];
 
  ?>
    </td>
    <td class="td" align="center" class="hidden-mobile"><?php echo $r['blokir']?></td>
    <td width="80" class="td" align="center"><a href="?module=editUser&id=<?php echo $r['userid']?>" >Edit</a> | <a onclick="return confirm('Apa anda yakin ..?')" href="badan/delete.php?aksi=delUser&id=<?php echo $r['userid']?>">Delete</a></td>

  </tr>

 <?php }?>                  
                </tbody>
              </table>  

                
              <div class="clearfix"></div>
              </div>
              
              </div>













