<html>

<head>
<title>Sign Up!</title>

<style type="text/css">
@import url('style.css');
caption {
	line-height: 20px;
	font-variant: small-caps;
	}
	
</style>

<script type="text/javascript" src='script.js'></script>
</head>
<body onload = 'displayFn()'>

	<div id="page-holder" >

		<?php include 'header.php'; ?>

		<?php include 'leftsidebar.php'; ?>
		
		
			<div id="contents">
			
				<form name='register' action='unverifiedregister.php' method='post'>

				<table>
				<caption>Sign Up</caption>
				<tr><td>First Name </td><td><input class='inputBox' type='text' name='first_name' /></td></tr>
				<tr><td>Last Name </td><td><input type='text' class='inputBox' name='last_name' /></td></tr>
				<tr><td>Username </td><td><input type='text' class='inputBox' name='uname' /></td></tr>
				<tr><td>Password </td><td><input type='password' class='inputBox' name='password' /></td></tr>
				<tr><td>Re-Enter Password </td><td><input type='password' class='inputBox' name='password1' /></td></tr>
				<tr><td>Email </td><td><input type='email' class='inputBox' name='email' /></td></tr>
				<tr><td>Choose a secret question</td>
					<td><select class='inputBox' name='squestion'>
					<option selected value="--Choose a question--">--Choose a question--</option>
					<option value="What is your pet's name">What is your pet's name</option>
					<option value="What is your mother's maiden name">What is your mother's maiden name</option>
					<option value="What is your best friend's name">What is your best friend's name</option>
					<option value="What is your favourite sports team">What is your favourite sports team</option>
					</select></td></tr>
				<br />
				<tr><td>Answer </td><td><input type='text' class='inputBox' name='sanswer' /></td></tr>
				<br />
				<tr><td></td><td><input type='submit' class='buttons' value='Register'></td></tr>
				</table>

				</form>
				
			</div>
			
		
		<?php include 'footer.php'; ?>
		
	</div>
</body>

</html>