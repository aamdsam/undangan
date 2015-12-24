<?php
if ($_GET['aksi']=='show_all'){
  //update status pesan menjadi sudah dibaca semua
  $dibaca=mysql_query("UPDATE `pesan` SET `status_dibaca`='Y' where id_penerima='$_SESSION[userid_ntb]'");
	echo "<div class='grid span10'>
              
              <div class='grid-title'>
               <div class='pull-left'>
                  <div class='icon-title'><i class='icon-envelope'></i></div>
                  <span>Semua Pesan</span> 
                  <div class='clearfix'></div>
               </div>
               <div class='pull-right'> 
               </div>
              <div class='clearfix'></div>   
              </div>
            
              <div class='grid-content'>
                <div class='friends'>";
                
                 
                $sql1="select * from pesan where `status_dihapus`='N' and id_penerima='$_SESSION[userid_ntb]' order by id desc limit 1000";
                $query1=mysql_query($sql1);
                while ($r=mysql_fetch_array($query1)){
                  $sql="SELECT * FROM `user` WHERE `userid` = '$r[id_pengirim]' ";
	              $query=mysql_query($sql);
	              $d=mysql_fetch_array($query);
	              $nama_pengirim=$d['nama_lengkap'];

	              $tanggal_terkirim=tgl_indo($r['tgl_terkirim']);
	              $isi_pesan=$r['isi_pesan'];
	
                	echo "<div class='friend'>
                  <img src='images/avatar.png' alt='' class='f-avatar'>
                  <div class='f-info'>
                  	<div class='f-name'>Dari : $nama_pengirim</div>
                    <div class='f-text'>$isi_pesan</div>
                  </div>
                  <div class='t-foot'>
                      <div class='t-date'>$tanggal_terkirim.</div>
                      <div class='t-retweet'><a href='media.php?aksi=balas&uid=$r[id_pengirim]'><i class='icon-share-alt'></i></a></div>
                    </div>
                  <div class='clearfix'></div>
                  </div>";
                }	
                 
                  

                  
                 echo "</div>
              </div>
              
              </div>";
}elseif ($_GET['aksi']=='detail'){
  $dibaca=mysql_query("UPDATE `pesan` SET `status_dibaca`='Y' where id='$_GET[id]'");
  $sql1="select * from pesan where `status_dihapus`='N' and id_penerima='$_SESSION[userid_ntb]' and id='$_GET[id]' order by id desc limit 1000";
  $query1=mysql_query($sql1);
  $r=mysql_fetch_array($query1);
                $sql="SELECT * FROM `user` WHERE `userid` = '$r[id_pengirim]' ";
                $query=mysql_query($sql);
                $d=mysql_fetch_array($query);
                $nama_pengirim=$d['nama_lengkap'];

                $tanggal_terkirim=tgl_indo($r['tgl_terkirim']);
                $isi_pesan=$r['isi_pesan'];
  

  echo "<div class='grid span10'>
              
              <div class='grid-title'>
               <div class='pull-left'>
                  <div class='icon-title'><i class='icon-envelope'></i></div>
                  <span>Detail Pesan</span> 
                  <div class='clearfix'></div>
               </div>
               <div class='pull-right'> 
               </div>
              <div class='clearfix'></div>   
              </div>
            
              <div class='grid-content'>";

  

  echo "<table width='100%' class='table table-bordered table-mod-2'>
  <tr>
    <td width='18%' rowspan='5'><img src='images/avatar.png' width='100%'  alt='' ></td>
    <td width='11%'>Pengirim</td>
    <td width='3%'>:</td>
    <td width='68%'>$nama_pengirim</td>
  </tr>
  <tr>
    <td>Tanggal</td>
    <td>:</td>
    <td>$tanggal_terkirim </td>
  </tr>
  <tr>
    <td>Subjek</td>
    <td>:</td>
    <td>$r[subjek]</td>
  </tr>
  <tr>
    <td>Isi Pesan</td>
    <td>:</td>
    <td>$r[isi_pesan]</td>
  </tr>";
  /*<tr>
    <td>Aksi</td>
    <td >:</td>
    <td><a href='media.php?module=pesan&aksi=balas&uid=$r[id_pengirim]'><button class='btn'>Balas</button></a>&nbsp;&nbsp;<a href='proses.php?aksi=hapus_pesan&id=$_GET[id]'><button class='btn'>Hapus</button></a></td>
  </tr>*/
echo "</table>

                 
                  

                  
                 
              </div>
              
              </div>";
}else{
  echo "<div class='grid span10'>
              
              <div class='grid-title'>
               <div class='pull-left'>
                  <div class='icon-title'><i class='icon-envelope'></i></div>
                  <span>Semua Pesan</span> 
                  <div class='clearfix'></div>
               </div>
               <div class='pull-right'> 
               </div>
              <div class='clearfix'></div>   
              </div>
            
              <div class='grid-content'>
                <div class='friends'>";
                
                 
                $sql1="select * from pesan where `status_dihapus`='N' and id_penerima='$_SESSION[userid_ntb]' order by id desc limit 1000";
                $query1=mysql_query($sql1);
                while ($r=mysql_fetch_array($query1)){
                  $sql="SELECT * FROM `user` WHERE `userid` = '$r[id_pengirim]' ";
                $query=mysql_query($sql);
                $d=mysql_fetch_array($query);
                $nama_pengirim=$d['nama_lengkap'];

                $tanggal_terkirim=tgl_indo($r['tgl_terkirim']);
                $isi_pesan=$r['isi_pesan'];
  
                  echo "<div class='friend'>
                  <img src='images/avatar.png' alt='' class='f-avatar'>
                  <div class='f-info'>
                    <div class='f-name'>Dari : $nama_pengirim</div>
                    <div class='f-text'>$isi_pesan</div>
                  </div>
                  <div class='t-foot'>
                      <div class='t-date'>$tanggal_terkirim.</div>
                      <div class='t-retweet'><a href='media.php?aksi=balas&uid=$r[id_pengirim]'><i class='icon-share-alt'></i></a></div>
                    </div>
                  <div class='clearfix'></div>
                  </div>";
                } 
                 
                  

                  
                 echo "</div>
              </div>
              
              </div>";
}

?>

              

