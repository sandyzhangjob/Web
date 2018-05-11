<?php
/**
 * Created by PhpStorm.
 * User: Sandy
 * Date: 5/10/2018
 * Time: 11:11 AM
 */
require_once ('header.php');
error_reporting(0);
session_start();

if($_SESSION['valid_email']){
    echo "<h3>Account: </h3>";
    $email = $_SESSION['valid_email'];
    require_once ('conn.php');
    $sql = "select email,password,fname,lname,phone,address,city,province,country,school,program,edulevel,edustatus,gradate from users where email= lower('$email')";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        // print data
        while($row = $result->fetch_assoc()) {
            echo "User Name: " . $row["email"] . "<br>" .
                 "Password: "  . '************&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. "<a href='changePsw.php'>change password</a>" . "<br>" .
                 "First Name: " .$row["fname"] . "<br>" .
                 "Last Name: " .$row["lname"] . "<br>" .
                 "Phone: " .$row["phone"] . "<br>" .
                 "Address: " .$row["address"] . "<br>" .
                 "City: " .$row["city"] . "<br>" .
                 "Province: " .$row["province"] . "<br>" .
                 "Country: " .$row["country"] . "<br>" .
                 "School: " .$row["school"] . "<br>" .
                 "Program: " .$row["program"] . "<br>" .
                 "Education Level: " .$row["edulevel"] . "<br>" .
                 "Education Status: " .$row["edustatus"] . "<br>" .
                 "Graduate Date: " .$row["gradate"] . "<br>";
        }
    }
    $conn->close();

} else {
    echo "<p>You are not logged in.</p>";
    echo "<p>Only members can see this page.</p>";
}

echo "</body>";
echo "</html>";
require ("footer.php");
?>

