<?php
    include("config.php");
    include('session.php');

    ob_start();
    $id = (int) $_GET['id'];
    if ($id < 1)
    {
        header('Location: forum.php');
        exit();
    }
    ob_end_clean();

    include("config.php");
    $output1 = mysqli_fetch_assoc($conn->query("SELECT * FROM post WHERE postid = $id"));

    $query2 = $conn->query("SELECT * FROM reply LEFT OUTER JOIN user on reply.userID = user.userID WHERE replyID = '$id' ORDER BY replyID DESC");

    $query3 = mysqli_num_rows($query2);
    
    if ($query3 == 0) {
	   echo '<td colspan="5">No Replies</td>';
    }

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
            
            <!-- Title of Post--> 
            <div class="row">
                <div class="col-12">
                    <h1 class="post-title"><?php echo $output1['title']; ?></h1>
                </div>
            </div>
            
            <!-- Body text begins -->
            <div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-12">
                                    <p><?php echo $output1['content']; ?></p>
                                    <a href="#" class="card-link">Comment</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
             <!-- Post Functionality begins -->
            <div class="row">
                <div class="col-12">
                    <form>
                        <div class="form-group">
                            <!-- Make an Ajax request in order to get OP username -->
                            <label for="comment">Add a comment to <?php $username; ?>'s post</label>
                            <textarea class="form-control" id="comment" rows="3"></textarea>
                            
                            <!-- Add a picture -->
                              <div class="form-group">
                                <label for="upload-img">Upload an Image</label>
                                  <p>Acceptible formats: .png and .jpg</p>
                                <input type="file" class="form-control-file" id="upload-img">
                                <button type="submit" class="btn btn-primary">Post Reply</button>
                              </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- View Comments -->
            <div class="row">
                <div class="col-12">
                    <h2>Comments</h2>
                    <?php
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