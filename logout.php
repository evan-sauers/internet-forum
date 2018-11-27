<?php 
    session_start();
    
    // Destroy session on logout
    if(session_destroy()){
        // Redirect to Login Screen
        header("Location: login.php");
    }

    // Close the connection
    $conn->close();
?>