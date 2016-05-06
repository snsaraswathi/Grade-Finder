<?php
$link = mysql_connect('snsaraswathicom.ipagemysql.com', 'saro', 'root');
if (!$link) {
	die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully';
mysql_select_db(logindb);
?>