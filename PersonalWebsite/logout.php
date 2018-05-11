<?php
/**
 * Created by PhpStorm.
 * User: Sandy
 * Date: 5/5/2018
 * Time: 11:11 AM
 */
require_once ('header.php');
session_start();
$old_email = $_SESSION['valid_email'];
unset($_SESSION['valid_email']);
session_destroy();
echo "<h1>Log Out</h1>";
if(!empty($old_email)){
    echo "You have been logged out. Go back to home page in 2 sesonds";
    echo '<meta http-equiv="refresh" content="2;url=index.php"/>';
} else {
    echo "<p>You are not logged in.</p>";
}

echo "<a href='index.php'> Back to Home </a>";
?>
</body>
</html>

<?php
require ("footer.php");
?>