<?php
include "../library/fungsi_indotgl.php";
$time=gmdate("Y-m-d H:i:s", time()+60*60*7);
$pot=explode(" ", $time);
//echo $pot[0];
//echo $pot[1];
?>
<table width"100%">
<tr>
<td align='center'><div align='center'><b>REALISASI PKB dan BBN-KB SE-NTB : <?php echo tgl_indo($pot[0]); ?> </div> </td>
</tr>

