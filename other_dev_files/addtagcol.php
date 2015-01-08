<?php

include "dba.php";

$add_tags_qString = "ALTER TABLE sports ADD tags varchar(255)";
$qResult = mysql_query($add_tags_qString,$dbconnect) or die(mysql_error());

if($qResult) echo "Done";



?>