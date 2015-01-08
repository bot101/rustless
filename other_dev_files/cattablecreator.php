<?php
include 'dba.php';

		$queryS = "CREATE TABLE IF NOT EXISTS trending (
		id INT(11) NULL AUTO_INCREMENT,
		post_title VARCHAR(32000),
		post_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
		post TEXT NULL,
		poster_id INT(11) NULL,
		PRIMARY KEY(id)
		)";
		
		$query = mysql_query($queryS, $dbconnect) or die(mysql_error());
		echo 'done!<br />';
	
	
?>