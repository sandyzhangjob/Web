<?php
/**
 * Created by PhpStorm.
 * User: Sandy
 * Date: 5/9/2018
 * Time: 5:40 PM
 */
@$db = new mysqli('localhost', 'sandy', 'sandy123', 'zsblog');
if(mysqli_connect_errno()){
    echo "<p>Error: Could not connect to database.<br/>
                    Please try again later.</p>";
    exit;
}