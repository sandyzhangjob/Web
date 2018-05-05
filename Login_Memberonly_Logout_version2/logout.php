<?php
/**
 * Created by PhpStorm.
 * User: Sandy
 * Date: 5/5/2018
 * Time: 11:11 AM
 */
session_start();
$old_user = $_SESSION['valid_user'];
unset($_SESSION['valid_user']);
session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Log Out</title>
</head>
<body>
<h1>Log Out</h1>
<?php
if(!empty($old_user)){
    echo "<p>You have been logged out</p>";
} else {
    echo "<p>You are not logged in.</p>";
}

echo "<a href='authmain.php'> Back to Home Page </a>";
?>
</body>
</html>