<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_cnKloAgogo = "127.0.0.1";
$database_cnKloAgogo = "hospital";
$username_cnKloAgogo = "root";
$password_cnKloAgogo = "";
$cnKloAgogo = mysql_pconnect($hostname_cnKloAgogo, $username_cnKloAgogo, $password_cnKloAgogo) or trigger_error(mysql_error(),E_USER_ERROR);
?>