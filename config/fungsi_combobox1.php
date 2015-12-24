<?php
function combo1tgl($awal, $akhir, $var, $default){
echo "<select name=$var style='width:15%'>";
echo "<option value=0 selected>$default</option>";
for ($i=$awal; $i<=$akhir; $i++){
  echo "<option value=$i>$i</option>";
}
echo "</select> ";
}

function combo1bln($awal, $akhir, $var, $default){
include "config/library.php";
echo "<select name=$var style='width:20%'>";
echo "<option value=0 selected>$default</option>";
for ($bln=$awal; $bln<=$akhir; $bln++){
        echo "<option value=$bln>$nama_bln[$bln]</option>";
}
echo "</select> ";
}

function combo1tgl2($awal, $akhir, $var, $terpilih){
echo "<select name=$var style='width:12%'>";
for ($i=$awal; $i<=$akhir; $i++){
if ($i==$terpilih)
  echo "<option value=$i selected>$i</option>";
else
  echo "<option value=$i>$i</option>";
}
echo "</select> ";
}

function combo1tgl22($awal, $akhir, $var, $terpilih,$size){
echo "<select name=$var style='width:$size'>";
for ($i=$awal; $i<=$akhir; $i++){
if ($i==$terpilih)
  echo "<option value=$i selected>$i</option>";
else
  echo "<option value=$i>$i</option>";
}
echo "</select> ";
}

function combo1bln22($awal, $akhir, $var, $terpilih ,$size){
include "config/library.php";
echo "<select name=$var style='width:$size'>";
for ($bln=$awal; $bln<=$akhir; $bln++){
      if ($bln==$terpilih)
         echo "<option value=$bln selected>$nama_bln[$bln]</option>";
      else
        echo "<option value=$bln>$nama_bln[$bln]</option>";
}
echo "</select> ";
}

function combo1bln2($awal, $akhir, $var, $terpilih){
include "config/library.php";
echo "<select name=$var style='width:20%'>";
for ($bln=$awal; $bln<=$akhir; $bln++){
      if ($bln==$terpilih)
         echo "<option value=$bln selected>$nama_bln[$bln]</option>";
      else
        echo "<option value=$bln>$nama_bln[$bln]</option>";
}
echo "</select> ";
}

function combo1tgl3($awal, $akhir, $var, $terpilih){
echo "<select name=$var style='width:10%'>";
for ($i=$awal; $i<=$akhir; $i++){
if ($i==$terpilih)
  echo "<option value=$i selected>$i</option>";
else
  echo "<option value=$i>$i</option>";
}
echo "</select> ";
}

function combo1bln3($awal, $akhir, $var, $terpilih){
include "config/library.php";
echo "<select name=$var style='width:20%'>";
for ($bln=$awal; $bln<=$akhir; $bln++){
      if ($bln==$terpilih)
         echo "<option value=$bln selected>$nama_bln[$bln]</option>";
      else
        echo "<option value=$bln>$nama_bln[$bln]</option>";
}
echo "</select> ";
}

// Terpilih
function tgl1kini($awal, $akhir, $var, $terpilih){
  echo "<select name=$var style='width:10%'>";
  for ($i=$awal; $i<=$akhir; $i++){
    $lebar=strlen($i);
    switch($lebar){
      case 1:
      {
        $g="0".$i;
        break;     
      }
      case 2:
      {
        $g=$i;
        break;     
      }      
    }  
    if ($i==$terpilih)
      echo "<option value=$g selected>$g</option>";
    else
      echo "<option value=$g>$g</option>";
  }
  echo "</select> ";
}

function thn1kini($awal, $akhir, $var, $terpilih, $size){
  echo "<select name=$var style='width:$size'>";
  for ($i=$awal; $i<=$akhir; $i++){
    if ($i==$terpilih)
      echo "<option value=$i selected>$i</option>";
    else
      echo "<option value=$i>$i</option>";
  }
  echo "</select> ";
}

function nama1blnkini($awal, $akhir, $var, $terpilih){
  $nama_bln=array(1=> "Januari", "Februari", "Maret", "April", "Mei", 
                      "Juni", "Juli", "Agustus", "September", 
                      "Oktober", "November", "Desember");
  echo "<select name=$var style='width:20%'>";
  for ($bln=$awal; $bln<=$akhir; $bln++){
      if ($bln==$terpilih)
         echo "<option value=$bln selected>$nama_bln[$bln]</option>";
      else
        echo "<option value=$bln>$nama_bln[$bln]</option>";
  }
  echo "</select> ";
}
?>
