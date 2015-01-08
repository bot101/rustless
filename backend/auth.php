<?php
session_start();

switch($_POST["authtype"]){
	
	case "login":
		
		$_SESSION["logged"] = 0;
		$username = $_POST['username'];
		$password = addslashes($_POST['password']);
		
		$login_q_string = "SELECT username FROM userbase WHERE username = @$username AND password = PASSWORD(@$password) LIMIT 1";
		$login_query = mysql_query($login_q_string) or die(header("Location:/"));
		if($login_query){
			$_SESSION["username"] = $username;
			$_SESSION["logged"] = 1;
			setcookie("username",$username,time()+60*60*24*30);
			setcookie("logged","1",time()+60*60*24*30);
		} else{
			$username = "Anonymous";
		}
		break;
		
	case "logout":
	case "default":
		setcookie("username","",-(time()+60*60*24*366));
		setcookie("logged","",-(time()+60*60*24*366));
		session_start();
		session_unset();
		session_destroy();
}
//username sent back as response text

?>