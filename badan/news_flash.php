<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
  <title>HtmlBox 4.0 - Demonstration Full</title>
  <!--script language="Javascript" src="jquery-1.3.2.min.js" type="text/javascript"></script-->
  <script language="Javascript" src="htmlbox.colors.js" type="text/javascript"></script>
  <script language="Javascript" src="htmlbox.styles.js" type="text/javascript"></script>
  <script language="Javascript" src="htmlbox.syntax.js" type="text/javascript"></script>
  <script language="Javascript" src="xhtml.js" type="text/javascript"></script>
  <script language="Javascript" src="htmlbox.min.js" type="text/javascript"></script>
<style type="text/css">
  .biasa select{
    width: 110px;


  }
</style>

</head>
<body>


<?php

  if ($_SESSION['leveluser_ntb']!=1){
    echo "<script language='javascript'>window.location.href='media.php';</script>"; 
}

if ($_SERVER['REQUEST_METHOD']=='POST'){
    if ($_POST['aksi']=='proses_input'){
        $simpan=mysql_query("INSERT INTO `news_flash` (`no_urut`,`tanggal`, `isi`) VALUES ('$_POST[no_urut]','$_POST[tanggal]', '$_POST[isi]')");
        if ($simpan){
          $tanggal2=date("Y-m-d H:i:s");
            $t_notifikasi=mysql_query("INSERT INTO `notifikasi` (`isi_notifikasi`, `id_pengirim`, `tanggal_notifikasi`) VALUES ('Menambahkan News Flash Baru', '$_SESSION[userid_ntb]', '$tanggal2')");
        
            echo "<script>alert('data berhasil disimpan')</script>";
        }else{
            echo "<script>alert('data gagal disimpan')</script>";
        }
    }elseif ($_POST['aksi']=='proses_edit'){
    $sql="update news_flash set no_urut='$_POST[no_urut]',tanggal='$_POST[tanggal]',isi='$_POST[isi]' where id=$_POST[cid]";
    $proses_edit=mysql_query($sql);
    if ($proses_edit){
        header("location: media.php?module=news_flash");
    }else{
        echo "<script>alert('data Gagal diupdate'); window.location='media.php?module=news_flash';</script>";
    }
    }
}


$no=1;
$query=mysql_query("select * from news_flash order by no_urut desc");


if ($_GET['aksi']=='edit'){
    echo "<div class='grid'>
              
              <div class='grid-title'>
               <div class='pull-left'>
                  <div class='icon-title'></div>
                  <span style='min-width:800px'>Edit Data </span> 
                  <div class='clearfix'></div>
               </div>
               
              <div class='clearfix'></div>   
              </div>
            
              <div class='grid-content'>


<form method='post' action='media.php?module=news_flash&aksi=proses_edit'><table border=1 class='table table-bordered table-mod-2'>";
$sql3="select * from news_flash where id='$_GET[id]'";
$query3=mysql_query($sql3);
$d3=mysql_fetch_array($query3);
echo "  <tr><td>No Urut</td><td>:</td><td><input type='text' name='no_urut' value='$d3[no_urut]'></td></tr>
        <tr><td>Tanggal</td><td>:</td><td><input type='text' name='tanggal' id='datetime1' value='$d3[tanggal]'></td></tr>
        <tr><td>Isi</td><td>:</td><td><span class=biasa><textarea name='isi' id='isi2' style='width: 446px; height: 131px;'> $d3[isi]</textarea></span>";
?>

<script language="Javascript" type="text/javascript">
$("#isi2").css("height","100px").css("width","100%").htmlbox({
    toolbars:[
      ["separator","bold","italic","underline","strike","sup","sub","fontfamily","fontcolor","highlight","code"]

  ],
  skin:"black"
});
</script>
<?php

echo "</td></tr>";

echo "</table> 
<input type='hidden' name='cid' value='$d3[id]'>
<input type='hidden' name='aksi' value='proses_edit'>
<input type='hidden' name='query_string' value='media.php?module=news_flash'>
<input type='submit' Value='Update' class='btn'>
&nbsp;&nbsp;
<a href='media.php?module=news_flash'><input type ='button' class=btn value='Batal'></a>
</form>

                
              <div class='clearfix'></div>
              </div>
              
              </div><br>";
}elseif ($_GET['aksi']=='input'){
  $sql1="SELECT max(no_urut) +1 as no_urut FROM news_flash";
  $query1=mysql_query($sql1);
  $j=mysql_fetch_array($query1);
  $no_urut=$j['no_urut'];

    echo "<div class='grid'>
              
              <div class='grid-title'>
               <div class='pull-left'>
                  <div class='icon-title'></div>
                  <span style='min-width:800px'>Edit Data </span> 
                  <div class='clearfix'></div>
               </div>
               
              <div class='clearfix'></div>   
              </div>
            
              <div class='grid-content'>


<form method='post' action='media.php?module=news_flash&aksi=proses_input'><table border=1 class='table table-bordered table-mod-2'>";

echo "  <tr><td>No Urut</td><td>:</td><td><input class='span1' type='text' name='no_urut' value='$no_urut'></td></tr>
        <tr><td>Tanggal</td><td>:</td><td><input type='text' name='tanggal' id='datetime2'></td></tr>
        <tr><td>Isi</td><td>:</td><td><span class=biasa><textarea name='isi' id='isi1' class='span1'></textarea></span>";
?>

<script language="Javascript" type="text/javascript">
$("#isi1").css("height","100px").css("width","100%").htmlbox({
    toolbars:[
      ["separator","bold","italic","underline","strike","sup","sub","fontfamily","fontcolor","highlight","code"]

  ],
  skin:"black"
});
</script>
<?php

echo "</td></tr>";

echo "</table> 

<input type='hidden' name='aksi' value='proses_input'>
<input type='hidden' name='query_string' value='media.php?module=news_flash'>
<input type='submit' Value='Simpan' class='btn'>
&nbsp;&nbsp;
<a href='media.php?module=news_flash'><input type ='button' class=btn value='Batal'></a>
</form>

                
              <div class='clearfix'></div>
              </div>
              
              </div><br>";
} else{

?>
  

<a href="media.php?module=news_flash&aksi=input"><input type="button" id="btambahData"  value="Tambah Data" style="padding:5px;"></a>

<br>


<!--Example Table-->
              <div class="grid">
              
              <div class="grid-title">
               <div class="pull-left">
                  <div class="icon-title"><i class="icon-eye-open"></i></div>
                  <span>News Flash</span> 
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
                <th>No Urut</th>
                <th>Tanggal</th>
                <th>Isi News Flash</th>
                <th align='center'>Aksi</th>
            </thead>
            <tbody>
              <?php while ($r=mysql_fetch_array($query)){?>

                <tr>

                  <td class="td" width='50'align="center"><?php echo $r['no_urut']?></td>
                  <td width='150' class="td"><?php echo tgl_indo($r['tanggal']); ?></td>
                  <td class="td"><?php echo $r['isi']?></td>
                  <td width='80' align='center'><a href="media.php?module=news_flash&aksi=edit&id=<?php echo $r['id']?>">Edit</a> | <a href="badan/delete.php?aksi=delNewsFlash&id=<?php echo $r['id']?>">Delete</a></td>

                </tr>

               <?php }?>              
                </tbody>
          </table> 


                
              <div class="clearfix"></div>
              </div>
              
              </div>
              *)News Flash Akan ditampilkan di home berdasarkan no urut dari yang terbesar ke yang terkecil.
              <!--Example Table END-->


    
<?php
}
?>
</body>
</html>