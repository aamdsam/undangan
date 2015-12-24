    <div class="grid">
                
                <div class="grid-title">
                 <div class="pull-left">
                    <div class="icon-title"><i class="icon-eye-open"></i></div>
                    <span style="width: 300px;">Daftar Saksi</span> 
                    <div class="clearfix"></div> </div>
                    <div class="pull-right"> 
                    <div class="icon-title"><a href="#"><i class="icon-refresh"></i></a></div>
                    <div class="icon-title"><a href="#"><i class="icon-cog"></i></a></div>
                 </div>
                <div class="clearfix"></div>   
                </div>
              
                <div class="grid-content">
                  <button class=btn onclick="window.location.href='?module=saksi&aksi=add'">Tambah Data</button><br><br>
<?php
 switch ($_GET[aksi]){

  default:
  
   echo "<table class='table table-bordered table-mod-2' id='datatable_3'>
              <thead>
                <tr>
   
                  <th class='hidden-mobile'>Nama </th>
                  <th class='hidden-mobile'>Nomor Telepon</th>              
                  <th class='hidden-mobile' align='center'>wilayah</th>
                </tr>
              </thead>";

    $sql=mysql_query("SELECT * from data_saksi");
    while($data=mysql_fetch_array($sql)){
    	$cut=explode('.', $data[wil]);

      	$sql1=mysql_query("SELECT * from kelurahan where id='$cut[2]'");
    	$data1=mysql_fetch_array($sql1);
      echo "<tr>";
      echo "<td>$data[nama]</td>";
      echo "<td>$data[tlp]</td>";
      echo "<td>$data1[nm_kel]</td>";
      echo "<td></td>";
      echo "</tr>";
    
    }

    echo "</table>";
  break;

  case "add":

  echo "<form method='POST' action='?module=saksi&aksi=simpan'>";
  echo "<table><tr>
      <td width='20%'>nama </td>
      <td width='2%'>:</td>
      <td width='78%'><input type='text' name='nama' class='span3'></td
    </tr>
    <tr>
      <td>Nama Calon</td>
      <td>:</td>
      <td><input type='text' name='tlp' class='span4' value='+62' ></td
    </tr>
    <tr>
      <td>Partai</td>
      <td>:</td>
      <td><select name='kel'>
      <option>Pilih Partai</option>";
   $mysql=mysql_query("SELECT * FROM kelurahan ");
   while($data=mysql_fetch_array($mysql)){

      echo "<option value='$data[id]'>$data[nm_kel]</option>";  
   }

   echo "</td>
    </tr>
    <tr>
      <td colspan=3>
      
      <button class='btn' type='submit'>Simpan</button> &nbsp; &nbsp; &nbsp; <a href='media.php?module=saksi'><button class='btn'  type='button'>Kembali</button></a></td>
    </tr>
  </table></form>";

  break;

  case "simpan";

  $sql=mysql_query("select * from kelurahan where id='$_POST[kel]'");
  	
  	if($data=mysql_fetch_array($sql));

  	$kode=$data[kd_kab].".".$data[kd_kec].".".$data[kd_kel];

 		 $simpan=mysql_query("INSERT INTO data_saksi VALUES ('','$_POST[nama]','$_POST[tlp]','$kode')");

    if($simpan){
      header('location:?module=saksi');
    }
 }
?>

 <div class="clearfix"></div>
                </div>
                
                </div>