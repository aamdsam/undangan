    <div class="grid">
                
                <div class="grid-title">
                 <div class="pull-left">
                    <div class="icon-title"><i class="icon-eye-open"></i></div>
                    <span style="width: 300px;">Daftar valeg</span> 
                    <div class="clearfix"></div> </div>
                    <div class="pull-right"> 
                    <div class="icon-title"><a href="#"><i class="icon-refresh"></i></a></div>
                    <div class="icon-title"><a href="#"><i class="icon-cog"></i></a></div>
                 </div>
                <div class="clearfix"></div>   
                </div>
              
                <div class="grid-content">
                  <button class=btn onclick="window.location.href='?module=caleg&aksi=add'">Tambah Data</button><br><br>
<?php
 switch ($_GET[aksi]){

  default:
  
   echo "<table class='table table-bordered table-mod-2' id='datatable_3'>
              <thead>
                <tr>
    
                  <th>No Urut</th>
                  <th class='hidden-mobile'>Nama Calon</th>
                  <th class='hidden-mobile'>Partai</th>              
                  <th class='hidden-mobile' align='center'>Aksi</th>
                </tr>
              </thead>";

    $sql=mysql_query("SELECT t1.no_urut, t1.nama_calon, t2.singkatan
                      FROM mas_caleg t1
                      INNER JOIN mas_partai t2 ON t1.partai=t2.id_partai 
                      ORDER BY partai asc");
    while($data=mysql_fetch_array($sql)){
      
      echo "<tr>";
      echo "<td>$data[no_urut]</td>";
      echo "<td>$data[nama_calon]</td>";
      echo "<td>$data[singkatan]</td>";
      echo "<td></td>";
      echo "</tr>";
    
    }

    echo "</table>";
  break;

  case "add":

  echo "<form method='POST' action='?module=caleg&aksi=simpan'>";
  echo "<table><tr>
      <td width='20%'>No Urut Calon </td>
      <td width='2%'>:</td>
      <td width='78%'><input type='text' name='urut' class='span3' style='width:10%;'></td
    </tr>
    <tr>
      <td>Nama Calon</td>
      <td>:</td>
      <td><input type='text' name='nama' class='span4' ></td
    </tr>
    <tr>
      <td>Partai</td>
      <td>:</td>
      <td><select name='partai'>
      <option>Pilih Partai</option>";
   $mysql=mysql_query("SELECT * FROM mas_partai ORDER BY id_partai asc");
   while($data=mysql_fetch_array($mysql)){

      echo "<option value='$data[id_partai]'>$data[singkatan]</option>";  
   }

   echo "</td>
    </tr>
    <tr>
      <td colspan=3>
      
      <button class='btn' type='submit'>Simpan</button> &nbsp; &nbsp; &nbsp; <a href='media.php?module=caleg'><button class='btn'  type='button'>Kembali</button></a></td>
    </tr>
  </table></form>";

  break;

  case "simpan";

  $simpan=mysql_query("INSERT INTO mas_caleg VALUES ('','$_POST[urut]','$_POST[nama]','$_POST[partai]')");

    if($simpan){
      header('location:?module=caleg');
    }
 }
?>

 <div class="clearfix"></div>
                </div>
                
                </div>