<?php
include 'dba.php';

	for($i=1; $i<=20; $i++){

		$queryS = "DELETE FROM trending";
		
		$query = mysql_query($queryS, $dbconnect) or die(mysql_error());
		echo $i.'done!<br />';
	}
	
?>