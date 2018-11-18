<?php
    // Create connection and begin session
    include("config.php");
    session_start();

    $_SESSION['error'] = "";
    
    // If form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Two passwords are equal to each other
        if($_POST['password'] == $_POST['confirmPass']) {
            $myusername = mysqli_real_escape_string($conn, $_POST['username']);
            $mypassword = mysqli_real_escape_string($conn, $_POST['password']);
            
            // Check usernames already existing in database
            $userTest = $conn->query("SELECT username FROM user WHERE username='$myusername'");
            $output1 = mysqli_fetch_assoc($userTest);

            // Set newly created username as session variable
            $_SESSION['username'];
            $_SESSION['login'] = $myusername;
            
            // Insert new row
            $sql = $conn->query("INSERT INTO user (username, password) VALUES('$myusername', '$mypassword')");

            // On submit, redirect to dashboard
            if ($conn->query($sql) === false) {
                header("location: dashboard.php");
            } else {
                $_SESSION['error'] = "<span style=\"color:red;\">Registration failed</span>";
            }
        } else {
            // Error if passwords are different
            $_SESSION['error'] = "<span style=\"color:red;\">Passwords do not match</span>";
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
                    <div id="error"><i><?= $_SESSION['error']; ?></i></div>
                    <input id="username" class="form" type="text" name="username" placeholder="username" required>
                    <input class="form" type="password" name="password" placeholder="password" required><br>
                    <input class="form" type="password" name="confirmPass" placeholder="confirm password" required><br>
                    <input id="createButton" class="btn btn-primary" value="Submit" type="submit"><br />
                    <a href="login.php">Back</a>
                </form>
                </div>
                <footer>
                    <p>Created by Cynthia Carter and Evan Sauers.</p>
                </footer>
                <script>
                // Use AJAX to check availability of username
                let us = document.getElementById("username");
                let error = document.getElementById("error");
                let button = document.getElementById("createButton");

                // Event when typing in forms
                us.addEventListener("input", function(event){
                    let xhr = new XMLHttpRequest();
                    xhr.onreadystatechange=function() {
                        if (this.readyState === 4 && this.status === 200) {
                            // Display response
                            error.innerHTML = xhr.responseText;
                            
                            // Disable submit button based on validation
                            if (xhr.responseText != "Username Valid") {
                                    document.getElementById("createButton").disabled = true;  
                            } else {
                                    document.getElementById("createButton").disabled = false;
                            }
                        }
                    }
                    xhr.open("GET", "username.php?us=" + us.value, true);
                    xhr.send();
                });
            </script>
            </div>
        </div>
    </body>
</html>