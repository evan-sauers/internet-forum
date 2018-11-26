<?php
    include("config.php");
    include("session.php");
    
    // Get post ID
    $id = (int) $_GET['id'];

    $output1 = mysqli_fetch_assoc($conn->query("SELECT * FROM post WHERE postid = $id"));
    
    // Retrieve the replies for post
    $query2 = $conn->query("SELECT * FROM reply LEFT OUTER JOIN user on reply.username = user.username WHERE postID = $id ORDER BY replyID DESC");
    $query3 = mysqli_num_rows($query2);

    $query4 = $conn->query("SELECT image FROM images WHERE postID = $id");

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $mycontent = mysqli_real_escape_string($conn, $_POST['content']);
        
        $getUser ="SELECT userID FROM user WHERE username='$session'";
        $result = $conn->query($getUser);
        $userString = $result->fetch_assoc();
        
        // Insert new reply to post
        $sql = $conn->query("INSERT INTO reply (content, username, postID, replyDate) VALUES ('$mycontent', '$session', '$id', now())");
              
        header("location: post.php?id=$id");
    }

    $postList = $_SESSION['topicNum'];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Post</title>
        <link rel="stylesheet" href="styles/styles.css">
        <link href="https://fonts.googleapis.com/css?family=ABeeZee" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
            
            <!-- Title of Post--> 
            <div class="row">
                <div class="col-12">
                    <h1 class="post-title"><?php echo $output1['title']; ?></h1>
                    <a href="dashboard.php">Back</a>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <h5 class="post-author">Posted By: <?php echo $output1['username']; ?></h5>
                </div>
            </div>

            
            <!-- Body text begins -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-12">
                                <p><?php echo $output1['content']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br>
            
            <!-- View Comments -->
            <div class="row">
                <div class="col-12">
                    <h2>Comments</h2>
                    <!-- Get reply information -->
                    <?php
                        // If no replies in database, output
                        if ($query3 == 0) {
                            echo '<p colspan="5">No Replies</p>';
                        }
                    
                        while ($output2 = mysqli_fetch_assoc($query2))
                        {
                            echo '<div class="row">';
                            echo '<div class="col-9">';
                            echo '<div class="current-post">';
                            echo '<div class="card">';
                            echo '<div class="card-body">';
                            echo '<h4>'.$output2['username'].'</h4>';
                            echo '<p>'.$output2['content'].'</p>';
                            echo '</div>';
                            echo '<div class="card-header">';
                            echo '<h6>'.$output2['replyDate'].'</h6>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    ?>
                    <form method="post" id="createReply">
                        <h5>Post a New Reply:</h5>
                        <textarea id="content" name="content" maxlength="1000" placeholder="Enter reply here..."></textarea><br>
                        <input id="createButton" class="btn btn-primary" value="Publish Reply" type="submit">
                    </form>
                </div>
            </div>
            <!-- Footer -->
            <div class="row">
                <div class="col-lg-12">
                    <p class="footer">Created by Cynthia Carter and Evan Sauers.</p>
                </div>
            </div>
        </div>
    </body>
</html>