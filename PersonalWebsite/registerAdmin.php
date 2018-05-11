<?php
/**
 * Created by PhpStorm.
 * User: Sandy
 * Date: 5/9/2018
 * Time: 5:38 PM
 */
require_once ('header.php');
if(isset($_POST['submit'])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $rePassword = $_POST["RePassword"];
    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $PhoneNumber = $_POST['PhoneNumber'];
    $Address = $_POST['Address'];
    $City = $_POST['City'];
    $Province = $_POST['Province'];
    $Country = $_POST['Country'];
    $School = $_POST['School'];
    $Program = $_POST['Program'];
    $EducationLevel = $_POST['EducationLevel'];
    $EducationStatus = $_POST['EducationStatus'];
    $GraduationDate = $_POST['GraduationDate'];

    if ($email == "" || $password == "" || $rePassword == "" || $FirstName == "" || $LastName == "" || $PhoneNumber == "" ||
        $Address == "" || $City == "" || $Province == "" || $Country == "" || $School == "" || $Program == "" ||
        $EducationLevel == "" || $EducationStatus == "" || $GraduationDate == "") {
        echo "<script>alert('Please enter all information and try again.'); </script>";
        echo "<a href='register.html'> Go back to register page </a>";
    } else {
        if($password == $rePassword) {
            require_once('conn.php');
            $query = "select email from users where email = ?";
            $stmt  = $db->prepare($query);
            $stmt->bind_param('s',$email);
            $stmt->execute();
            $stmt->store_result();
            if($stmt->num_rows == 1) {
                echo '<p> Email already register. </p>';
                echo "<a href='register.html'> Go back to register page </a><br/>";
            } else {
                $sql_increment = "alter table users AUTO_INCREMENT=1";
                $stmt = $db->prepare($sql_increment);
                $stmt->execute();
                $sql_insert = "insert into users(email,password,fname,lname,phone,address,city,province,country,school,program,edulevel,edustatus,gradate)
                              values(lower(?),SHA(?),?,?,?,?,?,?,?,?,?,?,?,?)";
                $stmt = $db->prepare($sql_insert);
                $stmt->bind_param('ssssssssssssss', $email, $password, $FirstName, $LastName, $PhoneNumber, $Address, $City, $Province, $Country, $School, $Program, $EducationLevel, $EducationStatus, $GraduationDate);
                $stmt->execute();
                if ($stmt->affected_rows > 0) {
                    echo "<p>Success Register.<p/>";
                } else {
                    echo "<p>An error has occurred.<br/>
                             Fair to register.<p/>";
                    echo "<a href='register.html'> Go back to register page </a><br/>";
                }
            }
            $db->close();
        }
        else{
            echo "<script>alert('The password not same! '); </script>";
            echo "<a href='register.html'> Go back to register page </a>";
        }
    }
}
