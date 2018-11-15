<?php
    include("config.php");

    $us = $_GET["us"];
    
    $sql = $conn->query("SELECT username FROM user WHERE username = '$us'");
    
    if(mysqli_num_rows($sql) > 0) {
        print "<span style=\"color:red;\">Username Taken</span>";
    } else {
        print "Username Valid";
    }
?>