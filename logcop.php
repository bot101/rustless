<?php
session_start();
//verifies if a user is logged in, and sets flag accordingly.
if(!(isset($_SESSION["logged"]) && ! $_SESSION["logged"] == 1)){
	$_SESSION["logged"] = 0;
}

if (!(isset($_COOKIE["logged"]) && ! $_COOKIE["logged"] == 1)){
	$_COOKIE["logged"] = 0;
}
?>
