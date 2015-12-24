<?php

  if ($_SESSION['leveluser_pelamonia']!=1){
	echo "<script language='javascript'>window.location.href='media.php';</script>"; 
}

$id=$_GET['id'];

$query=mysql_query("select * from user where userid=$id");

$r=mysql_fetch_array($query);

?>



<style type="text/css">

.ui-datepicker

{

   font-family: Arial;

   font-size: 13px;

   z-index: 1003 !important;

}

</style>

<script type="text/javascript">

$(document).ready(function()

{

   var jQueryDatePicker1Opts =

   {

      dateFormat: 'dd-mm-yy',

      changeMonth: false,

      changeYear: false,

      showButtonPanel: false,

      showAnim: 'show'

   };

   $("#tgllahir").datepicker(jQueryDatePicker1Opts);





});





</script>



<?php

if ($_SERVER['REQUEST_METHOD']!='POST'){

?>

<h3> Edit User</h3><br />

<form  method="post">

<table width="391" border="0" cellspacing="0" cellpadding="4" class="tedit">

  <tr>

    <td width="120">Username</td>

    <td width="3">:</td>

    <td width="172"><input type="text" name="username" value="<?php echo $r['username']?>" size="30px"></td>

  </tr>

  <tr>

    <td>Nama Lengkap</td>

    <td>:</td>

    <td><input type="text" name="nama_lengkap" id="nama_lengkap" value="<?php echo $r['nama_lengkap']?>" size="30px"></td>

  </tr>

  <tr>

    <td>No. Telp</td>

    <td>:</td>

    <td><input type="text" name="telepon" id="telepon" value="<?php echo $r['telepon']?>" size="30px"></td>

  </tr>

  <tr>

    <td>Email</td>

    <td>:</td>

    <td><input type="text" name="email" id="email"  value="<?php echo $r['email']?>" size="30px"></td>

  </tr>

  <tr>

    <td>Password </td>

    <td>:</td>

    <td><input type="password" name="password" id="password" value="" size="30px"></td>

  </tr>

  <tr>

    <td>Level</td>

    <td>:</td>

    <td><select id="level" name="level" style="border:1px solid #CCC">
 
    <?php
	$query=mysql_query("select * from level");
	while ($a=mysql_fetch_array($query)){
		if ($r['level_user']==$a['kd_level']){
			$c="selected";}else{$c="";}

		echo "<option value=$a[kd_level] $c>$a[nm_level]</option>";
	}
	
	?>

    </select></td>

  </tr>

  <tr>

    <td>Blokir</td>

    <td>:</td>

    <td>

    	<input type='radio' name='blokir' id='blokir_0' value='Y' <?php if ($r['blokir']=='Y'){ echo "checked";}?> >Ya

    	<input type='radio' name='blokir' id='blokir_1' value='N' <?php if ($r['blokir']=='N'){ echo "checked";}?> >Tidak



    </td>

  </tr>

</table><br />

<input type="submit" value="Update" >

</form>

<?php
} else{
  if (!empty($_POST['password'])){ 
	$pass=md5($_POST['password']);
	$updateuser=mysql_query("update `user` SET `username`='$_POST[username]',`nama_lengkap`='$_POST[nama_lengkap]',`telepon`='$_POST[telepon]',`email`='$_POST[email]',`passid`='$pass',`level_user`='$_POST[level]',`blokir`='$_POST[blokir]' where userid=$id");
  }else{
	  $updateuser=mysql_query("update `user` SET `username`='$_POST[username]',`nama_lengkap`='$_POST[nama_lengkap]',`telepon`='$_POST[telepon]',`email`='$_POST[email]',`level_user`='$_POST[level]',`blokir`='$_POST[blokir]' where userid=$id");
	  
  }
	if ($updateuser){
		echo "data berhasil disimpan";
		echo "<script>window.location='media.php?module=manajemen_user'</script>";
	}else{
		echo "data gagal disimpan";
		echo "<script>self.history.back()</script>";

	}

}

?>

<br><br>

<hr /><span class="linkkembali"><a href="?module=manajemen_user" >&curren; Kembali</a> </span>
<?php
if($_GET[update]=='baru'){
  $baru=mysql_query("update grup set id_user='$_GET[id]' WHERE id='$_POST[widget]'");
  if($baru){
    header('location:?module=editUser&id='.$_GET[id].'');
  }
}
?>