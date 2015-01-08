<html>
<head>
<title>Biodata</title>
</head>
<body>

<?php
session_start();
include 'dba.php';


$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$username = $_POST['uname'];
$password = $_POST['password'];
$squestion = $_POST['squestion'];
$sanswer = $_POST['sanswer'];
$table_query = "SELECT * FROM testtable ORDER BY date DESC LIMIT 0, 5";
setcookie('username',$username, time()+60*60); 


if(isset($first_name,$last_name,$email,$username,$password,$squestion,$sanswer)){
	$submitReg = 'INSERT INTO testtable (first_name, last_name, email, username, password, squestion, sanswer) VALUE ("'.$first_name.'","'.$last_name.'","'.$email.'","'.$username.'","'.$password.'","'.$squestion.'","'.$sanswer.'")';
	} 
	else {
	echo mysql_error() . '<br />One or more of the values you entered is/are incorrect<br /><a href="signup.php">&lt;&lt;BACK</a>';
	die();
	}
$register = mysql_query($submitReg, $dbconnect);
$query = mysql_query($table_query, $dbconnect) or die(mysql_error());

while($row = mysql_fetch_assoc($query)){

echo $row['id'] . '<br />';
echo $row['date'] . '<br />';
echo $row['first_name'] . '<br />';
echo $row['last_name'] . '<br />';
echo $row['email'] . '<br />';
echo '<br /><br />';
}

?>