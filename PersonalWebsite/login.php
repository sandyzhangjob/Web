<?php
require_once ('header.php');
error_reporting(0);
session_start();

if(isset($_POST['email']) && isset($_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    require_once("conn.php");
    $query = "select email, password from users where email=lower(?) and password=SHA(?)";
    $stmt  = $db->prepare($query);
    $stmt->bind_param('ss', $email, $password);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows == 1){
        $_SESSION['valid_email'] = $email;
    }
    $db->close();
}
echo "<h1>Login</h1>";
if(isset($_SESSION['valid_email'])){
    echo '<p>You are logged in as: ' . $_SESSION['valid_email'] . '<br />';
    echo '<a href="logout.php">Log Out</a><p>';
} else {
    if(isset($email)){
        echo '<p>Failed to login. </p>';
    }
    else{
        echo '<p>You are not logged in. </p>';
    }

    echo '<form action="login.php" method="post">';
    echo '    <fieldset>';
    echo '        <legend>Login Page</legend>';
    echo '        <p>';
    echo '            <lable for="email">Email:</lable>';
    echo '            <input type="text" name="email" id="email" size="30"';
    echo '        </p>';
    echo '        <p>';
    echo '            <lable for="password">Password:</lable>';
    echo '            <input type="password" name="password" id="password" size="30"';
    echo '        </p>';
    echo '    </fieldset>';
    echo '    <button type="submit" name="login">Login</button>';
    echo '</form>';
}
?>
<p><a href="members_only.php">Go to Members Section</a></p>
<p><a href="index.php">Go to Home Page</a></p>
</body>
</html>

<?php
require ("footer.php");
?>