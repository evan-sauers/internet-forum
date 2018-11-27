<?php
    include("config.php");
    
    // Get username using GET AJAX request
    $us = $_GET["us"];
    
    // Query current usernames in database
    $sql = $conn->query("SELECT username FROM user WHERE username = '$us'");
    
    // Check if username is taken
    if(mysqli_num_rows($sql) > 0) {
        print "<span style=\"color:red;\">Username Taken</span>";
    } else {
        print "Username Valid";
    }

    // Close the connection
    $conn->close();
?>