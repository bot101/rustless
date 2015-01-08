<?php
include "dba.php";
$name = stripslashes(trim($_GET["name"]));

$sql = "SELECT username FROM userbase where username =  $name LIMIT 1";

$query = mysql_query($sql);
 
 echo "OK";
?>