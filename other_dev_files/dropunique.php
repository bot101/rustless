<?php

include 'dba.php';

$sql = "ALTER TABLE trending DROP INDEX poster_id";
$query = mysql_query($sql, $dbconnect) or die (mysql_error());

echo 'done';

?>