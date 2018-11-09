<?php
    include("config.php");
    include('session.php');
    
    ob_start();
    $id = (int) $_GET['id'];
    if ($id < 1)
    {
        header('Location: dashboard.php');
        exit();
    }
    ob_end_clean();
    
    $output1 = mysqli_fetch_assoc($conn->query("SELECT name FROM topic WHERE topicID = $id"));

    $name = $output1['name'];

    $query2 = $conn->query("SELECT * FROM post LEFT OUTER JOIN user on post.userID = user.userID WHERE topicID = '$id' ORDER BY topicID DESC");
    $query3 = mysqli_num_rows($query2);
    if ($query3 == 0)
        echo '<td colspan="5">No Topics</td>';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $name ?> Forum</title>
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
            
            <div class="row">
                <div class="col-12">
                    <h1 class="post-title"><?php echo $name ?> Forum</h1>
                </div>
            </div>
        </div>
        <?php
            while ($output2 = mysqli_fetch_assoc($query2))
            {

                echo '<div class="row">';
                echo '<div class="col-9">';
                echo '<div class="current-post">';
                echo '<div class="card">';
                echo '<div class="card-header">';
                echo '<h4>'.$output2['title'].'</h4>';
                echo '<p>'.$output2['username'].'</p>';
                echo '<h6>'.$output2['postDate'].'</h6>';
                echo '</div>';
                echo '<div class="card-body">';
                echo '<a href="post.php?id='.$output2['postID'].'" class="btn btn-primary">View Post</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        ?>
        <!-- Footer -->
            <div class="row">
                <div class="col-lg-12">
                    <p class="footer">Created by Cynthia Carter and Evan Sauers.</p>
                </div>
            </div>
    </body>
</html>