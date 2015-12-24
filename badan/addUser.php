<script>
$(document).ready(function() {
    $("#passid2").change(function(){
		/*alert ('okoko');*/

	})
});
</script>
<?php
session_start();
ob_start();

  if ($_SESSION['leveluser_pelamonia']!=1){
	echo "<script language='javascript'>window.location.href='media.php';</script>"; 
}

if($_SERVER['REQUEST_METHOD'] != 'POST'){

?>
<div class='grid'>
              
              <div class='grid-title'>
               <div class='pull-left'>
                  <div class='icon-title'><i class='icon-bar-chart'></i></div>
                  <span style='min-width:800px'>Tambah User</span> 
                  <div class='clearfix'></div>
               </div>
               
              <div class='clearfix'></div>   
              </div>
            
              <div class='grid-content'>
<form method="post">
<table width="467" border="0" cellspacing="0" cellpadding="4" class="table table-bordered table-mod-2" >
  <tr>
    <td width="133">Username</td>
    <td width="4">:</td>
    <td width="304"><input type="text" name="username" id="username" size="25" class='span3'></td>
  </tr>
  <tr>
    <td>Nama Lengkap</td>
    <td>:</td>
    <td><input type="text" name="nama_lengkap" id="nama_lengkap" size="45" class='span4'></td>
  </tr>
  <tr>
    <td>Email</td>
    <td>:</td>
    <td><input type="text" name="email" id="email" size="45" class='span4'></td>
  </tr>
  <tr>
    <td>Telepon</td>
    <td>:</td>
    <td><input type="text" name="telepon" id="telepon" size="25" class='span2'></td>
  </tr>
  <tr>
    <td>Password</td>
    <td>:</td>
    <td>
    <input type="password" name="passid" id="passid" class='span3'>
       </td>
  </tr>
  <tr>
    <td>Password lagi</td>
    <td>:</td>
    <td><input type="password" name="passid2" id="passid2" class='span3'></td>
  </tr>
   <tr>

    <td>Level</td>

    <td>:</td>

    <td><select id="level" name="level" style="border:1px solid #CCC" class='span2'>
 
    <?php
  $query=mysql_query("select * from level");
  while ($a=mysql_fetch_array($query)){
   
    echo "<option value='$a[kd_level]'>$a[nm_level]</option>";
  }
  
  ?>

    </select></td>

  </tr>
   
</table>

<br>
<button  type="submit">Simpan </button>
</form>
<div class='clearfix'></div>
              </div>
              
              </div><br>
<?php
} else {
$passid=$_POST['passid'];
$passid2=$_POST['passid2'];
if ($passid != $passid2){
	$_SESSION['pesan']='password tidak sesuai';
	echo "<script>alert('password tidak cocok'); self.history.back();</script>";
}else{
	if (!empty($_POST['username']) and !empty($_POST['email']) and !empty($_POST['passid2'])){


	$pass=md5($_POST['passid2']);
	$simpanuser=mysql_query("INSERT INTO `user` SET `username`='$_POST[username]',`nama_lengkap`='$_POST[nama_lengkap]',`telepon`='$_POST[telepon]',`email`='$_POST[email]',`passid`='$pass',aktif='Y',level_user='$_POST[level]'");
		$_SESSION['pesan']='';
		echo "data berhasil disimpan";
		echo "<script>window.location='media.php?module=manajemen_user'</script>";
	}else{
		echo "data gagal disimpan...!!!";
		echo "<script>self.history.back()</script>";
	}
}
}

?>

<br><br>

<hr /><span class="linkkembali"><a href="?module=manajemen_user" >&curren; Kembali</a> </span>