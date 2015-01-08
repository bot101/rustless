<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_myconn = "localhost";
$database_myconn = "testbase";
$username_myconn = "root";
$password_myconn = "";
$myconn = mysql_connect($hostname_myconn, $username_myconn, $password_myconn) or trigger_error(mysql_error(),E_USER_ERROR); 
?>