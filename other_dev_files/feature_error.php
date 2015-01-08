<?php
//create your error handler function
function handler($error_type,
$error_message,
$error_file,
$error_line) {
switch($error_type) {
//fatal error
case E_ERROR:
$to = "Administrator <admin@yourdomain.com>";
$subject = "Custom Error Handling";
$body = "<html>";
$body .= "<head>";
$body .= "<title>Website error</title>";
$body .= "</head>";
$body .= "<body>";
$body .= "<h1>Fatal Error</h1>";
$body .= "Error received was a <b>" . $error_type .
"</b> error.<br>";
$body .= "The page that generated the error was: <b>" .
$error_file . "</b>";
$body .= " and was generated on line: <b>" . $error_line .
"</b><br>";
$body .= "The generated error message was:" . $error_message;
$body .= "</body>";
$body .= "</html>";
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= "From: Apache Error <host@yourdomain.com>\r\n";
$headers .= "Cc: webmaster@yourdomain.com\r\n";
mail($to, $subject, $body, $headers);
die(); //kill the script
break;
//warnings
case E_WARNING:
$to = "Administrator <admin@yourdomain.com>";
$subject = "Custom Error Handling";
$body = "<html>";
$body .= "<head>";
$body .= "<title></title>";
$body .= "</head>";
$body .= "<body>";
$body .= "<h1>Warning</h1>";
$body .= "Error received was a <b>" . $error_type .
"</b> error.<br>";
$body .= "The page that generated the error was: <b>" .
$error_file . "</b>";
$body .= " and was generated on line: <b>" . $error_line .
"</b><br>";
$body .= "The generated error message was:" . $error_message;
$body .= "</body>";
$body .= "</html>";
$headers = "MIME-Version: 1.0\r\n”";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n”";
$headers .= "From: Apache Error <host@yourdomain.com>\r\n";
$headers .= "Cc: webmaster@yourdomain.com\r\n";
mail($to, $subject, $body, $headers);
break;
//script will continue
//notices
case E_NOTICE:
//don’t show notice errors
break;
}
}
/*
set error handling to 0
we will handle all error reporting
only notifying admin on warnings and fatal errors
don’t bother with notices as they are trivial errors
really only meant for debugging
*/
error_reporting(0);
//set the error handler to be used
set_error_handler(“handler”);
/*
Create the rest of your page here.
We will not be displaying any errors
We will be e-mailing the admin an error message
Keep in mind that fatal errors will still halt the
execution, but they will still notify the admin
*/
?>