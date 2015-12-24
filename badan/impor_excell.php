1. Ekspor Data ke Excell<br>
Sebelum melakukan Impor data dari Excell, Silahkan Backup Data Lama anda atau download format yang baku terlebih dahulu <a href="badan/PHPExcel/Examples/eks_ke_excell.php?cid=<?php echo $_GET['cid']; ?>" >disini... <img src="badan/excel-icon.jpeg" width="18" height="18" border="0" ></a> 
<br><br>

2. Impor data dari Excell<br>
Upload data Format Excel 2003 (*.xls) terbaru :
<form action="badan/impor/proses_impor_excell.php?module=edit_widget&cid=<?php echo $_GET['cid']; ?>" method="post" enctype="multipart/form-data">
<input type="file" name="file_excel" >
<input type="hidden" name="module" value="<?php echo $_GET['module']; ?>">
<input type="hidden" name="tabel" value="1">
<button type="submit">Upload</button>
</form>
