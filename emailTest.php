<?php
	$email = $_POST['email'];
	$allowed = array('studentmail.ul.ie', 'ul.ie');

	// Make sure the address is valid
	if (filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		$explodedEmail = explode('@', $email);
		$domain = array_pop($explodedEmail);

		if ( ! in_array($domain, $allowed))
		{
			echo "Invalid address. Must have the domain 'studentmail.ul.ie' or 'ul.ie'.";
		}else{
            echo "Email is valid";
        }
	}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>[Placeholder for name]</title>
	</head>
	<body>
		<form action="" method="post">
			<input type="text" name="email" />
			<input type="submit" />
		</form>
	</body>
</html>