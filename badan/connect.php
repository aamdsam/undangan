<?php
mysql_connect('localhost','root','root@uinmakassar');
mysql_select_db('sms');


$sql=mysql_query("select * from inbox where SenderNumber='+6285299229914'");
$data=mysql_fetch_array($sql);

$pecah=explode(' ', $data[TextDecoded]);

echo "$pecah[0]";
?>