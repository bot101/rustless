<?php
//create your error handler function
function handler($error_type,
$error_message,
$error_file,
$error_line) {
switch ($error_type) {
//fatal error
case E_ERROR:
echo "<h1>Fatal Error</h1>";
die("A fatal error has occured at line $error_line of file " .
"$error_file.<br>" .
"Error message created was &quot;$error_message&quot;");
break;
//warnings
case E_WARNING:
echo "<h1>Warning</h1>";
echo "A warning has occured at line $error_line of file " .
"$error_file.<br>";
echo " Error message created was &quot;$error_message&quot;";
//notices
case E_NOTICE:
//don't show notice errors
break;
}
}
//set the error handler to be used
set_error_handler("handler");
//set string with "Wrox" spelled wrong
$string_variable = "Worx books are great!";
//try to use str_replace to replace Worx with Wrox
//this will generate an E_WARNING
//because of wrong parameter count
str_replace("Worx", "Wrox");
?>