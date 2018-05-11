<?php
/**
 * Created by PhpStorm.
 * User: Sandy
 * Date: 5/5/2018
 * Time: 11:11 AM
 */
require_once ('header.php');
error_reporting(0);
session_start();
echo "<h1>Member Only</h1>";
if($_SESSION['valid_email']){
    echo "<p>You are login as " . $_SESSION['valid_email'] . "</p>";
    echo "<p>Member-Only content goes there</p>";
} else {
    echo "<p>You are not logged in.</p>";
    echo "<p>Only members can see this page.</p>";
}
?>
</body>
</html>

<?php
require ("footer.php");
?>
