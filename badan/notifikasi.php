<?php
if ($_GET['aksi']=='show_all'){
  //update status notifikasi menjadi sudah dibaca semua
	echo "<div class='grid span10'>
              
              <div class='grid-title'>
               <div class='pull-left'>
                  <div class='icon-title'><i class='icon-envelope'></i></div>
                  <span>Semua notifikasi</span> 
                  <div class='clearfix'></div>
               </div>
               <div class='pull-right'> 
               </div>
              <div class='clearfix'></div>   
              </div>
            
              <div class='grid-content'>
                <div class='friends'>";
                
                 
                $sql1="select * from notifikasi order by id desc limit 1000";
                $query1=mysql_query($sql1);
                while ($r=mysql_fetch_array($query1)){
                  $sql="SELECT * FROM `user` WHERE `userid` = '$r[id_pengirim]' ";
	              $query=mysql_query($sql);
	              $d=mysql_fetch_array($query);
	              $nama_pengirim=$d['nama_lengkap'];
                $tanggal=date_format(date_create($r['tgl_notifikasi']),"Y-m-d");
                $waktu=date_format(date_create($r['tgl_notifikasi']),"G:ia");
	              $tanggal_terkirim=tgl_indo($tanggal);
	              $isi_notifikasi=$r['isi_notifikasi'];
	
                	echo "<div class='friend'>
                  <img src='images/avatar.png' alt='' class='f-avatar'>
                  <div class='f-info'>
                  	<div class='f-name'>Dari : $nama_pengirim</div>
                    <div class='f-text'>$isi_notifikasi</div>
                  </div>
                  <div class='t-foot'>
                      <div class='t-date'>$tanggal_terkirim, $waktu</div>
                      <div class='t-retweet'></div>
                    </div>
                  <div class='clearfix'></div>
                  </div>";
                }	
                 
                  

                  
                 echo "</div>
              </div>
              
              </div>";
}
?>

              

