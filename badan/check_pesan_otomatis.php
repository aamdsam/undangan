<?php
$sql1="SELECT  COUNT(tanggal) as jumlah  FROM `cek_pesan` where tanggal='$tgl_sekarang'";
$query1=mysql_query($sql1);
$d1=mysql_fetch_array($query1);

$jumlah =$d1['jumlah'];
$now = time(); 





if ($d1['jumlah']<1){
    $sql2="SELECT * from chart where tampil='Y'";
    $query2=mysql_query($sql2);
    while ($d2=mysql_fetch_array($query2)){
    $tanggal_edit=$d2['tgl_edit'];
    if ($tanggal_edit != '0000-00-00 00:00:00' and $tanggal_edit !='' ){
   
        $your_date = strtotime($tanggal_edit);
        $datediff = $now - $your_date;
        $range= floor($datediff/(60*60*24));
        $selisih=$range;  
        $periode=$d2['periode'];
        if ($selisih > $periode){
            $jumlah_hari_terlambat= $selisih-$periode;
            $sql_update="UPDATE `chart` SET `jml_terlambat_update`='$jumlah_hari_terlambat' WHERE (`id`='$d2[id]')";
            $query_update=mysql_query($sql_update);
            if ($query_update){
                $query_kategori=mysql_query("SELECT * from kategori where kode_kategori ='$d2[kategori]'");
                $k=mysql_fetch_array($query_kategori);
                $kategori=$k['nama_kategori'];

                $subjek="SKPD Yang Terlambat Update Data";
                $isi_pesan="Kategori : $kategori Grafik  $d2[title], Terlambat melakukan update data selama  $jumlah_hari_terlambat hari ";
                $tanggal=date("Y-m-d H:i:s");

                $sql_pesan="INSERT INTO `pesan` (`id_pengirim`, `subjek`, `isi_pesan`, `id_penerima`, `tgl_terkirim`) VALUES ('17', '$subjek', '$isi_pesan', '11', '$tanggal')";
                $query_pesan=mysql_query($sql_pesan);
                $query_pesan_status='ok';

            }

        }
    }
    }
    if ($query_pesan_status=='ok'){
        $sql_cek_pesan="INSERT INTO `cek_pesan` (`tanggal`, `cek_pesan`) VALUES ('$tgl_sekarang', 'N')";
        $query_cek_pesan=mysql_query($sql_cek_pesan);
    }

}
?> 
