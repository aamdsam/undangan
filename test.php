 
<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui.min.js"></script>

 <script src="tinymcpuk/jscripts/tiny_mce/tiny_mce.js" type="text/javascript"></script>
  <script src="tinymcpuk/jscripts/tiny_mce/tiny_lokomedia.js" type="text/javascript"></script>


<form method=POST  action='badan/aksi_data_statis.php?aksi=edit'>
  Title: <input type='text' name='title' value='' size='50'><br>
  Tanggal: <input type='date' name='tanggal' value='' size='15'><br><br><br>
  Silahkan Paste Data Anda Di di bawah....<br>
  <textarea name='isi' id='loko' style='width:100%; height:100%;'></textarea>
  <input type='hidden' name='id' value='8'>
  <input type='hidden' name='id_chart' value='38'>
  <input type='hidden' name='id_user' value='4'>
  
  <input type='submit' value='Update'>
  </form>