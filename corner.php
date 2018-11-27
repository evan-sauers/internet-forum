<?php

    include("config.php");
    include("session.php"); 

    // Get the images
    $query2 = $conn->query("SELECT * FROM images ORDER BY id DESC");
    $query3 = mysqli_num_rows($query2);

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
            <h1>Pet Corner</h1>
            <a href="dashboard.php">Back</a><br><br><br><br>
            <h4>Show off your own pets below!</h4><br>
            <p>Upload an image of your pet along with a short description. Due to privacy, the Pets Corner will remain anonymous.</p><br>
            <script>
                <?php
                    while ($row = mysqli_fetch_array($result)) {
                      echo "<div id='img_div'>";
                        echo "<img src='images/".$row['image']."' >";
                        echo "<p>".$row['image_text']."</p>";
                      echo "</div>";
                    }
                  ?>
            </script>
            <form method="POST" action="upload.php" enctype="multipart/form-data">
            <input type="file" name="image">
            <textarea id="text" cols="40" rows="4" maxlength="300" name="image_text" placeholder="Describe your image..."></textarea>
            <button type="submit" name="submit">UPLOAD</button>
            </form>
            
            <!-- Output images of pets -->
        <?php       
            while ($output2 = mysqli_fetch_assoc($query2))
            {

                echo '<div class="row">';
                echo '<div class="col-4">';
                echo '<div class="current-post">';
                echo '<div class="card">';
                echo '<div class="card-header">';
                echo '<p>'.$output2['image_text'].'</p>';
                echo '</div>';
                echo '<img id="uploadImg" src="'.$output2['image'].'"/>'; 
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
        </div>
    </body>
</html>