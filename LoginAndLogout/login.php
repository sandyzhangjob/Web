<?php
	// session start
	session_start();
	
	if(isset($_SESSION['success_login']) && $_SESSION['success_login'] === TRUE){
		echo "<meta http-equiv=\"Refresh\" content=\"0.5; url=protectedstuff.php\" > "; 
	}
	else{
		if($_POST){
			// retrive the variable from the user enter
			$_SESSION['loginemail'] = $_POST['loginemail'];
			$_SESSION['loginpwd']   = $_POST['loginpwd'];
			$loginemail = $_SESSION['loginemail'];
			$loginpwd   = $_SESSION['loginpwd'];
			//echo $_SESSION['loginemail']. $_SESSION['loginpwd']
			
			$DBConnect = mysqli_connect("db-mysql.zenit", "int322_171d26", "hsAQ6945", "int322_171d26");
			if(!mysqli_connect_errno($DBConnect) ){
				$SQL = "select * from users where username = \"$loginemail\" and password = \"$loginpwd\";";
				$SQLResult = mysqli_query($DBConnect, $SQL) or die('Query failed.' . mysqli_error($DBConnect));
				// if there is one row in db, then login in success
				if(mysqli_num_rows($SQLResult) == 1 ){
					//echo "Success Login.";
					$_SESSION['success_login'] = TRUE;
					echo "<meta http-equiv=\"Refresh\" content=\"0.3; url=protectedstuff.php\" > "; 
				}
				else {
					echo "Invalid username or password";
				}
			}
			else {
				echo mysqli_errno($DBConnect) . mysqli_error($DBConnect);
			}
		}
	}
?>

<html>
	<head>
		<title>Login Page</title>
	</head>
	<body>
		<hr />
		<form method="POST" >
			<h3>Log In </h3>
			Please enter username(email):	
			<input type="text" name="loginemail"   /> <br/>
			Please enter password: 			
			<input type="password" name="loginpwd" /> <br/>
			<p>(Password are case-sensitive and must be at least 8 characters long)</p>
			
			<input type="reset"  value="Reset"> 
			<input type="submit" value="Log In"> 
		
			<a href="forgetpwd.php">Forgot your password?</a>
		</form>
		<hr />		
	</body>
</html>
