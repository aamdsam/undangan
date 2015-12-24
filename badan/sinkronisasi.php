<script type="text/javascript">
$(document).ready(function(){
  $("#kd_kab").change(function(){
    var kd_kab=$("#kd_kab").val();
    $("#kd_kec").fadeOut();
    $.ajax({
      type:"GET",
      url:"proses.php",
      data:"aksi=nm_kec&kd_kab="+kd_kab,
      success:function(data){  //4
        $("#kd_kec").html(data);
        $("#kd_kec").fadeIn();
      } 
    })//4
  })
  $("#kd_kec").change(function(){
    var kd_kec=$("#kd_kec").val();
    $("#kd_kel").fadeOut();
    $.ajax({
      type:"GET",
      url:"proses.php",
      data:"aksi=nm_kel&kd_kec="+kd_kec,
      success:function(data){  //4
        $("#kd_kel").html(data);
        $("#kd_kel").fadeIn();
      } 
    })//4
  })

})

</script>
<?php 
    if ($_GET['aksi']=='filter_data'){
      if ($_GET['kd_kab']!=''){
        $where1= " ='$_GET[kd_kab]'";
		
      }else{
        $where1= " LIKE '%%'";
      }
	  
      if ($_GET['kd_kec']!=''){
        $where2= " ='$_GET[kd_kec]'";
      }else{
        $where2= " LIKE '%%'";
      }

      if ($_GET['kd_kel']!=''){
        $where3= " ='$_GET[kd_kel]'";
      }else{
        $where3= " LIKE '%%'";
      }

      if ($_GET['tps']!=''){
        $where4= " ='$_GET[tps]'";
      }else{
        $where4= " LIKE '%%'";
      }
$filter="kd_kab $where1 and kd_kec $where2 and kd_kel $where3 and tps $where4";
$filter2="dpt.kd_kab $where1 and dpt.kd_kec $where2 and dpt.kd_kel $where3 and dpt.tps $where4";

	$sql_dpt_kpu="SELECT COUNT(id) as jml_dpt from dpt where $filter";
}else{
	$sql_dpt_kpu="SELECT COUNT(id) as jml_dpt from dpt";
}


$query_dpt_kpu=mysql_query($sql_dpt_kpu);
$c=mysql_fetch_array($query_dpt_kpu);
$jml_dpt_kpu=$c['jml_dpt'];


/*if ($_GET['aksi']=='filter_data'){
	$sql_dpt_lain="SELECT COUNT(id) as jml_dpt from dpt_lain where $filter";
}else{
	$sql_dpt_lain="SELECT COUNT(id) as jml_dpt from dpt_lain";
}


$query_dpt_lain=mysql_query($sql_dpt_lain);
$c=mysql_fetch_array($query_dpt_lain);
$jml_dpt_lain=$c['jml_dpt'];
*/

$sql_data_telepon="SELECT COUNT(id) as jml from data_telepon";
$query_data_telepon=mysql_query($sql_data_telepon);
$d=mysql_fetch_array($query_data_telepon);
$jml_data_telepon=$d['jml'];


if ($_GET['aksi']=='filter_data'){
	$sql_dpt2="SELECT * FROM dpt INNER JOIN data_telepon ON dpt.nik = data_telepon.nik WHERE dpt.nik <> '' and  $filter";
}else{
	$sql_dpt2="SELECT * FROM dpt INNER JOIN data_telepon ON dpt.nik = data_telepon.nik where dpt.nik <> ''";
}



$query_dpt2=mysql_query($sql_dpt2);
$jml_dpt2=mysql_num_rows($query_dpt2);

if ($_GET['aksi']=='filter_data'){
	$sql_dpt3="SELECT COUNT(id) as jml_dpt FROM dpt where nik NOT in (SELECT nik from data_telepon) and $filter";
}else{
	$sql_dpt3="SELECT COUNT(id) as jml_dpt FROM dpt where nik NOT in (SELECT nik from data_telepon)";
}

$query_dpt3=mysql_query($sql_dpt3);
$c=mysql_fetch_array($query_dpt3);
$jml_dpt3=$c['jml_dpt'];

echo "<div class='grid'>              
<div class='grid-title'>
 <div class='pull-left'>
    <div class='icon-title'><i class='icon-eye-open'></i></div>
    <span style='width: 600px;'>Data sinkronisasi</span> 
    <div class='clearfix'></div>
 </div>
 <div class='pull-right'> 
    <div class='icon-title'><a href='#'><i class='icon-refresh'></i></a></div>
    <div class='icon-title'><a href='#'><i class='icon-cog'></i></a></div>
 </div>
<div class='clearfix'></div>   
</div>

<div class='grid-content'>";
$aksi=$_GET['aksi'];
?>
<a href='#'data-target="#anim-modal" data-toggle="modal" ><span class='icon-filter'></span>Filter Data</a>

              <form method="get">
              <div class="clearfix"></div>

                        <div id="anim-modal" class="modal fade hide">
                      <div class="modal-header">
                          <button class="close" type="button" data-dismiss="modal">&times;</button>
                          <b>Filter Data</b>
                      </div>
                      <div class="modal-body">
                          <p>
                            <table class="table table-bordered table-mod-2">
                              <tr>
                                <?php
                                echo "
                                <td width='20%'>Kabupaten</td>
                                <td width='2%'>:</td>
                                <td width='78%'>
                                <select class='chzn-select chosen_select' name='kd_kab'  >
                                <option value=''>Pilih Kabupaten</option>";

                                $sql1="select * from kabupaten";
                                $query1=mysql_query($sql1);
                                while ($r=mysql_fetch_array($query1)){
									if ($r['kd_kab']==$_GET['kd_kab']){
										$selected="  selected";
									}else{
										$selected="";
									}
								
                                  echo "<option value='$r[kd_kab]' $selected>$r[nm_kab]</option> ";
                                }
                                

                                echo "</select></td>
                              </tr>
                              <tr>
                                <td>Kecamatan</td>
                                <td>:</td>
                                <td><select class='chzn-select chosen_select' name='kd_kec'  >
                                <option value=''>Pilih Kecamatan</option>";

                                $sql1="select * from kecamatan";
                                $query1=mysql_query($sql1);
                                while ($r=mysql_fetch_array($query1)){
									if ($r['kd_kec']==$_GET['kd_kec']){
										$selected="  selected";
									}else{
										$selected="";
									}
                                  echo "<option value='$r[kd_kec]' $selected>$r[nm_kec]</option> ";
                                }
                                

                                echo "</select></td>
                              </tr>
                              <tr>
                                <td>Kelurahan</td>
                                <td>:</td>
                                <td><select class='chzn-select chosen_select' name='kd_kel'  >
                                <option value=''>Pilih Kelurahan</option>";

                                $sql1="select * from kelurahan";
                                $query1=mysql_query($sql1);
                                while ($r=mysql_fetch_array($query1)){
									if ($r['kd_kel']==$_GET['kd_kel']){
										$selected="  selected";
									}else{
										$selected="";
									}
                                  echo "<option value='$r[kd_kel]' $selected>$r[nm_kel]</option> ";
                                }
                                

                                echo "</select></td>
                              </tr>
                              <tr>
                                <td>TPS</td>
                                <td>:</td>
                                <td><input type='text' name='tps' class='span1' value='$_GET[tps]'></td>
                              </tr>
                            </table>
                            <input type='hidden' name='module' value='sinkronisasi'>
							<input type='hidden' name='aksi' value='filter_data'>";
                            ?>


                          </p>
                      </div>
                      <div class="modal-footer">
                          <button class='btn btn-primary metro' type='submit'>Proses</button>
                          <a href="#" class="btn" data-dismiss="modal">Close</a>
                      </div>
                    
                  </div>
                </form>
                
<?php
if ($aksi=='cari'){
echo "<form method='get' action='$_SERVER[PHP_SELF]'>
<input type='hidden' name='menu' id='menu' value='$_GET[menu]'>
  
  <table class='table table-bordered table-mod-2'>
    <tr><td>Kabupaten</td>
    <td>:</td>
    <td><select name='kd_kab' id='kd_kab' >
      <option value=''>Pilih Kabupaten</option>";
      $sql1="select * from kabupaten";
      $query1=mysql_query($sql1);
      while ($r=mysql_fetch_array($query1)){
        echo "<option value='$r[kd_kab]' >$r[nm_kab]</option> ";
      }
      echo "</select>

    </td></tr>

    <tr>
      <td>Kecamatan</td>
      <td>:</td>
      <td><select  name='kd_kec' id='kd_kec'  >
      <option value=''>Pilih Kecamatan</option>";


      

      echo "</select></td>
    </tr>
    <tr>
      <td>Kelurahan</td>
      <td>:</td>
      <td><select  name='kd_kel' id='kd_kel' >
      <option value=''>Pilih Kelurahan</option>";



      echo "</select></td>
    </tr>
    <tr>
      <td>TPS</td>
      <td>:</td>
      <td><input type='text' name='tps' class='span1' value=''></td>
    </tr>
    <tr>
      <td colspan=3><button class=btn type='submit'>Proses</button></td>
    </tr>
  </table> 
<input type='hidden' name='module' value='$_GET[module]'>
<input type='hidden' name='aksi' value='proses_cari'>

</form>
<hr>
<br>";
}elseif ($aksi=='detail'){
  $sql="SELECT
  dpt.id,
  dpt.kd_kab,
  kabupaten.nm_kab,
  dpt.kd_kec,
  kecamatan.nm_kec,
  dpt.kd_kel,
  kelurahan.nm_kel,
  dpt.tps,
  dpt.no_kk,
  dpt.nik,
  dpt.nama,
  dpt.tempat_lahir,
  dpt.tgl_lahir,
  dpt.umur,
  dpt.status_kawin,
  dpt.jk,
  dpt.alamat,
  dpt.rt,
  dpt.rw,
  dpt.ket
  FROM
  dpt
  INNER JOIN kabupaten ON dpt.kd_kab = kabupaten.kd_kab
  INNER JOIN kecamatan ON dpt.kd_kec = kecamatan.kd_kec
  INNER JOIN kelurahan ON dpt.kd_kel = kelurahan.kd_kel
  where dpt.id='$_GET[id]'";

    $query=mysql_query($sql);
    $c=mysql_fetch_array($query);


    echo "<div class='grid span10'>
                
                <div class='grid-title'>
                 <div class='pull-left'>
                    <div class='icon-title'><i class='icon-star-empty'></i></div>
                     <span style='width: 600px;'>Detail Daftar Pemilih Tetap</span> 
                    <div class='clearfix'></div>
                 </div>
                 <div class='pull-right'> 
                 </div>
                <div class='clearfix'></div>   
                </div>
              
                <div class='grid-content'>";

    

    echo "<table width='100%' class='table table-bordered table-mod-2'>
    <tr>
      <td width='20%'>Kabupaten</td>
      <td width='2%'>:</td>
      <td width='78%'>$c[nm_kab]</td>
    </tr>
    <tr>
      <td>Kecamatan</td>
      <td>:</td>
      <td>$c[nm_kec]</td>
    </tr>
    <tr>
      <td>Kelurahan</td>
      <td>:</td>
      <td>$c[nm_kel]</td>
    </tr>
    <tr>
      <td>TPS</td>
      <td>:</td>
      <td>$c[tps]</td>
    </tr>
    <tr>
      <td>No KK</td>
      <td>:</td>
      <td>$c[no_kk]</td>
    </tr>
    <tr>
      <td>No Identitas KTP</td>
      <td>:</td>
      <td>$c[nik]</td>
    </tr>
    <tr>
      <td>Nama</td>
      <td>:</td>
      <td>$c[nama]</td>
    </tr>
    <tr>
      <td>Tempat / Tgl Lahir</td>
      <td>:</td>
      <td>$c[tempat_lahir] / ".tgl_indo($c['tgl_lahir'])."</td>
    </tr>
    <tr>
      <td>Umur</td>
      <td>:</td>
      <td>$c[umur]</td>
    </tr>
    <tr>
      <td>Status Kawin</td>
      <td>:</td>
      <td>";
      $sql1="select * from tbkod where KDAPLTBKOD ='02' and KDKODTBKOD='$c[status_kawin]'";
      $query1=mysql_query($sql1);
      while ($r=mysql_fetch_array($query1)){
        echo $r['NMKODTBKOD'];
      }

      echo "</td>
    </tr>
    <tr>
      <td>Jenis Kelamin</td>
      <td>:</td>
      <td>";
      $sql1="select * from tbkod where KDAPLTBKOD ='01' and KDKODTBKOD='$c[jk]'";
      $query1=mysql_query($sql1);
      while ($r=mysql_fetch_array($query1)){
        echo $r['NMKODTBKOD'];
      }

      echo "</td>
    </tr>
    <tr>
      <td>Alamat</td>
      <td>:</td>
      <td>$c[alamat]</td>
    </tr>
    <tr>
      <td>RT</td>
      <td>:</td>
      <td>$c[rt]</td>
    </tr>
    <tr>
      <td>RW</td>
      <td>:</td>
      <td>$c[rw]</td>
    </tr>
    <tr>
      <td>Keterangan</td>
      <td>:</td>
      <td>$c[ket]</td>
    </tr>
    <tr>
      <td colspan=3><a href='media.php?module=sinkronisasi'><button class='btn' type='button'>Kembali</button></a></td>
    </tr>
  </table>

                   
                    

                    
                   
                </div>
                
                </div>";

}else{

if ($_GET['aksi']=='filter_data'){
$sql="select * from kabupaten where kd_kab='$_GET[kd_kab]'";
$query=mysql_query($sql);
$r=mysql_fetch_array($query);
$kabupaten=$r['nm_kab'];

$sql="select * from Kecamatan where kd_kec='$_GET[kd_kec]'";
$query=mysql_query($sql);
$r=mysql_fetch_array($query);
$kecamatan=$r['nm_kec'];

$sql="select * from kelurahan where kd_kel='$_GET[kd_kel]'";
$query=mysql_query($sql);
$r=mysql_fetch_array($query);
$kelurahan=$r['nm_kel'];



echo "
Kabupaten : $kabupaten <br>
Kecamatan : $kecamatan <br>
Kelurahan : $kelurahan <br>
TPS : $_GET[tps]<br><br><hr>";
}

echo "


Jumlah Daftar Pemilih Tetap Sumber KPU  : $jml_dpt_kpu Orang <br>
Jumlah Data No Telepon / HP : $jml_data_telepon Orang <br><br>

Jumlah Daftar Pemilih Yang tersinkronisasi :  $jml_dpt2 orang<br>
Jumlah Daftar Pemilih Yang gagal tersinkronisasi :  $jml_dpt3 orang

<br><br>";
?>
<hr>
<legend>Daftar Pemilih Tetap yang tersinkronisasi</legend>
<table class="table table-bordered table-mod-2">
              <thead>
                <tr>
                  <th>No</th>
                  <th class="hidden-mobile">No Identitas KTP</th>
                  <th >Nama</th>
                  <th class="hidden-mobile">Alamat</th>              
                  <th class="hidden-mobile" align='center'>Aksi</th>
                </tr>
              </thead>
              <?php 
	 include("config/class_paging2.php");
    $p      = new Paging3;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);
    $no = $posisi+1;
  if ($_GET['aksi']=='filter_data'){
  	$sql1="SELECT * FROM dpt INNER JOIN data_telepon ON dpt.nik = data_telepon.nik WHERE dpt.nik <> '' and  $filter order by dpt.id ASC LIMIT $posisi,$batas";    
  }else{
	$sql1="SELECT * FROM dpt INNER JOIN data_telepon ON dpt.nik = data_telepon.nik where dpt.nik <> '' order by dpt.id ASC LIMIT $posisi,$batas";   
  }
  //echo $sql1;
  $query=mysql_query($sql1);
  while ($r=mysql_fetch_array($query)){?>


    <tr>
      <td class="td" align="center"><?php echo $no++?></td>
      <td class="td"><?php echo $r['nik']?></td>
      <td class="td"><?php echo $r['nama']?></td>
      <td class="td" class="hidden-mobile"><?php echo $r['alamat']?></td>
      <td class="td" align="center">
      <a href="?module=sinkronisasi&aksi=detail&id=<?php echo $r['id']?>" >Detail</a>

      </td>
    </tr>

   <?php }?>
            </table>

 <?php

if ($_GET['aksi']=='filter_data'){
	 $jmldata = mysql_num_rows(mysql_query("SELECT * FROM dpt INNER JOIN data_telepon ON dpt.nik = data_telepon.nik WHERE  $filter"));
}else{
  	$jmldata = mysql_num_rows(mysql_query("SELECT * FROM dpt INNER JOIN data_telepon ON dpt.nik = data_telepon.nik"));
}

  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
  echo " <div id=paging>$linkHalaman</div><br>";


	
?>
  
<div class='clearfix'></div>
</div>

</div>

<?php

}

?>
