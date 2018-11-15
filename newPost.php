<?php
    include('config.php');
    include('session.php'); 
    
    $topicNum = $_SESSION['topicNum'];

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $content = mysqli_real_escape_string($conn, $_POST['content']);
        
        $getUser ="SELECT userID FROM user WHERE username='$session'";
        $result = $conn->query($getUser);
        $userString = $result->fetch_assoc();
        
        $sql = $conn->query("INSERT INTO post (title, content, username, topicID, postDate) VALUES ('$title', '$content', '$session', '$topicNum', now())");
                
        header("location: postList.php?id=$topicNum");
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
                        <h1>Pet Forum Dashboard</h1>
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
            <form action="" method="post" id="createPost">
                <p>Title: <input class="form" type="text" name="title" placeholder="title" required></p><br>
                <textarea id="content" type="text" name="content" maxlength="300" placeholder="Enter description here..."></textarea><br>
            
                <input id="createButton" class="btn btn-primary" value="Publish Post" type="submit">
            </form>
            
                <!-- Image Functionality-->
                <div class="row">
                    <div class="col-12">
                        <form>
                            <div class="form-group">
                                <h4>Upload an Image</h4>
                                <p>Acceptable formats: .png and .jpg</p>
                                <input type="file" class="form-control-file" id="upload-img">
                            </div>
                        </form>
                    </div>
                </div>


        </div>
    </body>
</html>