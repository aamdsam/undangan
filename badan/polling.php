    <div class="grid">
                
                <div class="grid-title">
                 <div class="pull-left">
                    <div class="icon-title"><i class="icon-eye-open"></i></div>
                    <span style="width: 300px;">Polling SMS</span> 
                    <div class="clearfix"></div> </div>
                    <div class="pull-right"> 
                    <div class="icon-title"><a href="#"><i class="icon-refresh"></i></a></div>
                    <div class="icon-title"><a href="#"><i class="icon-cog"></i></a></div>
                 </div>
                <div class="clearfix"></div>   
                </div>
              
                <div class="grid-content">
<?php
 switch ($_GET[aksi]){

  default:
  
   echo "<table class='table table-bordered table-mod-2' id='datatable_3'>
              <thead>
                <tr>
                  <th>Partai</th>
                  <th>Calon 1</th>
                  <th>Calon 2</th>
                  <th>Calon 3</th>
                  <th>Calon 4</th>
                  <th>Calon 5</th>
                  <th>Calon 6</th>
                  <th>Calon 7</th>
                  <th>Calon 8</th>
                  <th>Total</th>
                  <th>Detail</th>
                  
                </tr>
              </thead>";

    $sql=mysql_query("SELECT * FROM polling");
    while($data=mysql_fetch_array($sql)){
      $cut=explode('.', $data[id_wilayah]);

      $s=(mysql_fetch_array(mysql_query("select singkatan from mas_partai where id='$cut[3]'")));
      echo "<tr>";
      echo "<td>$s[0]</td>";
      echo "<td>$data[caleg1]</td>";
      echo "<td>$data[caleg2]</td>";
      echo "<td>$data[caleg3]</td>";
      echo "<td>$data[caleg4]</td>";
      echo "<td>$data[caleg5]</td>";
      echo "<td>$data[caleg6]</td>";
      echo "<td>$data[caleg7]</td>";
      echo "<td>$data[caleg8]</td>";
      echo "<td>$data[caleg9]</td>";
      echo "<td><a href='?module=polling&aksi=detail&id=$data[id_wilayah]'>Detail</a></td>";
      echo "</tr>";
    
    }

    echo "</table>";
  break;

  case "detail":
     
      $cut=explode('.', $_GET[id]);
      $gabung=$cut[0].".".$cut[1].".".$cut[2];

      $kabupaten=(mysql_fetch_array(mysql_query("select nm_kab from kabupaten where kd_kab='$cut[0]'")));
      $kecamatan=(mysql_fetch_array(mysql_query("select nm_kec from kecamatan where kd_kec='$cut[1]'")));
      $kelurahan=(mysql_fetch_array(mysql_query("select nm_kel from kelurahan where kd_kel='$cut[2]'")));

      $orang=(mysql_fetch_array(mysql_query("select nama,tlp from data_saksi where wil='$gabung'")));

  echo "<table><tr>
      <td width='20%'>Kabupaten</td>
      <td width='2%'>:</td>
      <td width='78%'>$kabupaten[0]</td
    </tr>
    <tr>
      <td>Kecamatan</td>
      <td>:</td>
      <td>$kecamatan[0]</td
    </tr>
    <tr>
      <td>kelurahan</td>
      <td>:</td>
      <td>$kelurahan[0]</td>
    </tr>
    <tr>
      <td>TPS</td>
      <td>:</td>
      <td>0</td>
    </tr>
    <tr>
      <td>KTP</td>
      <td>:</td>
      <td>0</td>
    </tr>
    <tr>
      <td>Nama Saksi </td>
      <td>:</td>
      <td>$orang[0]</td>
    </tr>
    <tr>
      <td>Nomor Telpon</td>
      <td>:</td>
      <td>$orang[1]</td>
    </tr>
 
  </table>";

  break;

 
 }
?>

 <div class="clearfix"></div>
                </div>
                
                </div>