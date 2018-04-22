<?php
	ob_start();
	session_start();
	if(isset($_SESSION['success_login']) && $_SESSION['success_login'] === TRUE){
		
?>
	<html>
	<head>
		<title>Lab5-Part2, Shan Zhang, 113004154</title>
	</head>
	<body>
		<form method="POST">
			<p>You are logged in!</p>
			<input type="submit" value="Logoff" name="logoff"  />
		</form>
		
	</body>
</html>

<?php 
		if(isset($_POST['logoff'])){
			echo "You are logging off...";
			unset($_SESSION['success_login']);
			unset($_SESSION['loginemail']);
			unset($_SESSION['loginpwd']);
			
			session_destroy();
			
			setcookie("success_login", "", time()-61200,"/");
			setcookie("loginemail", "", time()-61200,"/");
			setcookie("loginpwd", "", time()-61200,"/");
			echo "<meta http-equiv=\"Refresh\" content=\"1.5; url=login.php\" > "; 
		}
	}
	else{
		echo "<h3>" . "You haven't login, please login in." . "<h3>";
		echo "<meta http-equiv=\"Refresh\" content=\"1.5; url=login.php\" > "; 
	}
?>
