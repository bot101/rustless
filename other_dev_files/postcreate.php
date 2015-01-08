<?php
include 'dba.php';

	for($i=1; $i<=20; $i++){

		$queryS = "INSERT INTO testtable(id, post_title, post, poster_id) VALUES (NULL, 'Post Title ".$i."','This is the default testtable post ".$i." post This is the default testtable post This is the default testtable post This is the default testtable post This is the default testtable post This is the default testtable post This is the default testtable post This is the default testtable post This is the default testtable post This is the default testtable post ', 1)";
		
		$query = mysql_query($queryS, $dbconnect) or die(mysql_error());
		echo $i.'done!<br />';
	}
	
?>