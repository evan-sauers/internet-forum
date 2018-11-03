<?php
    // Create connection and begin session
    include("config.php");
    session_start();

    $_SESSION['error'] = '';
    
    // If form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        // Two passwords are equal to each other
        if($_POST['password'] == $_POST['confirmPass']) {
            $myusername = mysqli_real_escape_string($conn, $_POST['username']);
            $mypassword = mysqli_real_escape_string($conn, $_POST['password']);
            
            $_SESSSION['username'];
            $_SESSION['login'] = $myusername;

            // Query username and password from user table
            $sql = $conn->query("INSERT INTO user (username, password) VALUES('$myusername', '$mypassword')");
            
            if ($conn->query($sql) === false) {
                $_SESSION['error'] = "Registration successful";
                header("location: dashboard.php");
            } else {
                $_SESSION['error'] = "Registration failed";
            }
        } else {
            $_SESSION['error'] = "The passwords did not match";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Pets Forum</title>
        <link rel="stylesheet" href="styles/login-styles.css">
        <link href="https://fonts.googleapis.com/css?family=ABeeZee" rel="stylesheet">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    </head>

    <body>
        <div class="login">
            <div class="row">
                <div class="col-lg-12">
                <!-- LOGIN FORMS -->
                <form action="create.php" method="post" id="login">
                    <h1>Pets Forum</h1>
                    <p>Create a username and password:</p>
                    <div class="error"><i><?= $_SESSION['error']; ?></i></div>
                    <input class="form" type="text" name="username" placeholder="username" required><br>
                    <input class="form" type="password" name="password" placeholder="password" required><br>
                    <input class="form" type="password" name="confirmPass" placeholder="confirm password" required><br>
                    <input id="createButton" class="btn btn-primary" value="Submit" type="submit">
                </form>
                </div>
                <footer>
                    <p>Created by Cynthia Carter and Evan Sauers.</p>
                </footer>
                
            </div>
        </div>
    </body>
</html>