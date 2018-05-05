<?php
/**
 * Created by PhpStorm.
 * User: Sandy
 * Date: 5/5/2018
 * Time: 11:11 AM
 */
error_reporting(0);
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Member Only</title>
</head>
<body>
<h1>Member Only</h1>
<?php
if($_SESSION['valid_user']){
    echo "<p>You are login as " . $_SESSION['valid_user'] . "</p>";
    echo "<p>Member-Only content goes there</p>";
} else {
    echo "<p>You are not logged in.</p>";
    echo "<p>Only members can see this page.</p>";
}

echo "<a href='authmain.php'> Back to Home Page </a>";
?>
</body>
</html>

