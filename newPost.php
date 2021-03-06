<?php
    include("config.php");
    include("session.php"); 
    
    // Get session variable
    $topicNum = $_SESSION['topicNum'];

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        // Retrieve form information
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $content = mysqli_real_escape_string($conn, $_POST['content']);
        
        $getUser ="SELECT userID FROM user WHERE username='$session'";
        $result = $conn->query($getUser);
        $userString = $result->fetch_assoc();

        $_SESSION['error'] = "";
        
        // Server-side Validation: Title must be greater than 5
        // Description must be greater than 10
        if (strlen($title) >= 5) {
            if (strlen($content) >= 10) {
                // Insert new row into post
                $sql = $conn->query("INSERT INTO post (title, content, username, topicID, postDate) VALUES ('$title', '$content', '$session', '$topicNum', now())");
                
                // Redirect
                header("location: postList.php?id=$topicNum");
            } else {
                $_SESSION['error'] = "<span style=\"color:red;\">Description must be at least 10 characters.</span>";
            }
        } else {
            $_SESSION['error'] = "<span style=\"color:red;\">Title must be at least 5 characters</span>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Pet Forum - Create Post</title>
        <link rel="stylesheet" href="styles/styles.css">
        <link href="https://fonts.googleapis.com/css?family=ABeeZee" rel="stylesheet">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    </head>

    <body>
        <div class="container-fluid">
            <!-- Title -->
            <div class="topNav">
                <div class="row">
                  <div class="col-lg-6">
                    <h1>Pets Forum</h1>
                  </div>
                    <div class="col-lg-6">
                        <div id="rightNav">
                            <h4>Hello, <?php echo $session; ?></h4>&nbsp;&nbsp;
                            <h4><a href="logout.php">Logout</a></h4>
                        </div>
                    </div>
                </div>
            </div>
            <h1>Create a Post</h1>
            <div id="error"><i><?= $_SESSION['error']; ?></i></div>
            <form method="post" id="createPost" enctype="multipart/form-data">
                <p>Title: <input class="form" type="text" name="title" placeholder="title" required></p><br>
                <textarea id="content" name="content" maxlength="300" placeholder="Enter description here..." required></textarea><br>
                <input id="createButton" class="btn btn-primary" value="Publish Post" type="submit">
            </form>
        </div>
    </body>
</html>

<?php
    // Close the connection
    $conn->close();
?>