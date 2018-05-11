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




echo "<h1>Change Password</h1>";

if(isset($_SESSION['valid_email'])){
    echo "<p> Changing password for " . $_SESSION['valid_email'] . "</p> <br/>";
    if(isset($_POST['currentPsw'])){
        require_once ('conn.php');
        $email = $_SESSION['valid_email'];
        $currentPsw = $_POST['currentPsw'];
        $password = $_POST['password'];

        $sql = "select * from users where email = lower('$email') and password = SHA(?)";
        $stmt = $db->prepare($sql);
        $stmt->bind_param('s',$currentPsw);
        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows == 1){
            $sql = "update users set password=SHA(?) where email = lower('$email')";
            $stmt = $db->prepare($sql);
            $stmt->bind_param('s',$password);
            $stmt->execute();
            $stmt->store_result();
            if($stmt->affected_rows == 1) {
                echo "<p>Success change your password</p> ";
            }
            else{
                echo "Something Wrong. Fail to change password.";
            }
        } else {
            echo "<p><strong>Wrong current password, Fail to change password.</strong></p> <br/>";
        }
        $db->close();
    }

    echo '<form name="form" method="post" action="changePsw.php" >';    // onsubmit="return formValidation();" ???
    echo '    <fieldset>';
    echo '        <legend>Change Password:</legend>';
    echo '        <p>';
    echo '            <lable for="currentPsw">Current Password:</lable>';
    echo '            <input type="password" name="currentPsw" id="currentPsw" size="30"';
    echo '        </p>';
    echo '        <p>';
    echo '            <lable for="password">New password:</lable>';
    echo '            <input type="password" name="password" id="password" size="30"';
    echo '        </p>';
    /*echo '        <p>';
    echo '            <lable for="RePassword:">Repeat password:</lable>';
    echo '            <input type="password" name="RePassword" id="RePassword" size="30"';
    echo '        </p>';*/
    echo '    </fieldset>';
    echo '    <button type="submit" name="savepassword">Save Password</button> <br/>' ;
    echo '    <a href="accountAdmin.php">Cancel</a>';
    echo '</form>';


} else {
    echo "<p>You are not logged in.</p>";
    echo "<p>Only members can edit this page.</p>";
}
?>

<script src="js/register.js"> </script>
</body>
</html>

<?php
require ("footer.php");
?>
