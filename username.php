<?php
    include("config.php");

    $us = $_GET["us"];
    
    $sql = $conn->query("SELECT username FROM user WHERE username = '$us'");

    if(mysqli_num_rows($sql) > 0) {
        echo "<span style=\"color:red;\">Username Taken</span>";
    } else {
        echo "Username Valid";
    }
?>