<?php

$dbconnect = @mysql_connect('localhost','root') or die(mysql_error());
$db_select = mysql_select_db('testbase');

?>