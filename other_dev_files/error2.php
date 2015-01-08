<?php
$error_no = $_SERVER['QUERY_STRING'];

switch ($error_no) {
	case 400:
	$error_output = "<h1>&quot;Bad Request&quot; Error Page - " .
"(Error Code 400)</h1>";
$error_output .= "The browser has made a Bad Request<br>";
$error_output .= "<a href=\"mailto:sysadmin@localhost.com\">" . "Contact</a> the system administrator";
$error_output .= " if you feel this to be in error";
break;

case 401:
$error_output = "<h1>&quot;Authorization Required&quot; " .
"Error Page - (Error Code 401)</h1>";
$error_output .= "You have supplied the wrong information to " .
"access a secure area<br>";
$error_output .= "<a href=\"mailto:sysadmin@localhost.com\">" ."Contact</a> the system administrator";
$error_output .= " if you feel this to be in error";
break;

case 403:
$error_output = "<h1>&quot;Forbidden Access&quot; Error Page - " .
"(Error Code 403)</h1>";
$error_output .= "You are denied access to this area<br>";
$error_output .= "<a href=\"mailto:sysadmin@localhost.com\">" .
"Contact</a> the system administrator";
$error_output .= " if you feel this to be in error";
break;
case 404:
$error_output = "<h1>&quot;Page Not Found&quot; Error Page - " .
"(Error Code 404)</h1>";
$error_output .= "The page you are looking for cannot " .
"be found<br>";
$error_output .= "<a href=\"mailto:sysadmin@localhost.com\">" .
"Contact</a> the system administrator";
$error_output .= " if you feel this to be in error";
break;
case 500:
$error_output = "<h1>&quot;Internal Server Error&quot; " .
"Error Page – (Error Code 500)</h1>";
$error_output .= "The server has encountered an internal " .
"error<br>";
$error_output .= "<a href=\"mailto:sysadmin@localhost.com\">" .
"Contact</a> the system administrator";
$error_output .= " if you feel this to be in error";
break;
default:
$error_output = "<h1>Error Page</h1>";
$error_output .= "This is the custom error Page<br>";
$error_output .= "You should be <a href=\"index.php\">here</a>";
}
?>
<html>
<head>
<title>Beginning PHP5, Apache, MySQL Web Development</title>
</head>
<body>
<?php
echo $error_output;
?>
</body>
</html>