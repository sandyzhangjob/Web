<?php
	if($_POST && isset($_POST['email'])){
		$email = trim($_POST['email']);
		
		$DBConnect = mysqli_connect("db-mysql.zenit", "int322_171d26", "hsAQ6945", "int322_171d26");
			if(!mysqli_connect_errno($DBConnect) ){
				$SQL = "select * from users where username = \"$email\";";
				$SQLResult = mysqli_query($DBConnect, $SQL) or die('Query failed.' . mysqli_error($DBConnect));
				// if there is one row in db, then login in success
				if(mysqli_num_rows($SQLResult) == 1 ){
					// send username and password tip to email address
					$SQL = "select username, passwordHint from users where username = \"$email\";";
					$SQLResult = mysqli_query($DBConnect, $SQL) or die('Query failed.' . mysqli_error($DBConnect));
					// send email
					$subject = "Find your password";
					while($row = mysqli_fetch_row($SQLResult)){ 
						$message = "Your username is: " . $row[0] . "  Your password hint is: " . $row[1];
					}
					$from = "int322_lab5_login@senecac.com";
					$headers = "From: $from";
					mail($email,$subject,$message,$headers);
					echo "Mail Sent. Return to login page";
				}
				else {
					echo "No such Email. Return to login page.";
				}
				echo "<meta http-equiv=\"Refresh\" content=\"2; url=login.php\" > ";
			}
			else {
				echo mysqli_errno($DBConnect) . mysqli_error($DBConnect);
			}
	}
?>

<html>
	<head>
		<title>Find Your Password</title>
	</head>
	<body>
		<hr />
		<form method="POST" >
			Please enter your email:
			<input type="text" name="email"   /> <br/>
		
			<input type="submit" value="Submit"> 
		</form>
		<hr />		
	</body>
</html>