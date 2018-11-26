<?php
    include("session.php");
    include("config.php");

    // Query all topics
    $query1 = $conn->query("SELECT * FROM topic ORDER BY topicID ASC"); 
    $output1 = mysqli_fetch_assoc($query1);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Pets Forum</title>
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
                  <h1>Pets Forum</h1>
              </div>
                <div class="col-lg-6">
                    <div id="rightNav">
                        <h4>Hello, <?php echo $session; ?></h4>&nbsp;&nbsp;
                        <h4><a href="logout.php">Logout</a></h4>
                    </div>
                </div>
            </div>
            
            <!-- Card Row ONE -->
            
            <!-- Cat -->
            <div class="row">
                <div class="col-lg-4">
                  <div class="card bg-light mb-3" style="width: 27rem;">
                      <img class="card-img-top" src="images/cat.jpg" alt="Card image cap">
                          <div class="card-body">
                            <h5 class="card-title">Cats</h5>
                            <p class="card-text">Write something about cats...</p>
                            <a href="postList.php?id=1" class="btn btn-primary">Access Cat Subforum</a>
                          </div>
                    </div>
                </div>
                
                <!-- Dog -->
                <div class="col-lg-4">
                    <div class="card text-white bg-warning mb-3" style="width: 27rem;">
                      <img class="card-img-top" src="images/dog.jpg" alt="Card image cap">
                          <div class="card-body">
                            <h5 class="card-title">Dogs</h5>
                            <p class="card-text">Write something about dogs...</p>
                            <a href="postList.php?id=2" class="btn btn-primary">Access Dog Subforum</a>
                          </div>
                    </div>
                </div>
            
                 <!-- Bird -->
                <div class="col-lg-4">
                    <div class="card text-white bg-danger mb-3s" style="width: 27rem;">
                      <img class="card-img-top" src="images/bird.jpg" alt="Card image cap">
                          <div class="card-body">
                            <h5 class="card-title">Birds</h5>
                            <p class="card-text">Write something about birds...</p>
                            <a href="postList.php?id=3" class="btn btn-primary">Access Bird Subforum</a>
                          </div>
                    </div>
                </div>
            </div>

            <!-- END ROW -->
            
            
            <!-- Card Row TWO -->
            
            <!-- Fish -->
            <div class="row">
                <div class="col-lg-4">
                  <div class="card text-white bg-dark mb-3" style="width: 27rem;">
                      <img class="card-img-top" src="images/fish.jpg" alt="Card image cap">
                          <div class="card-body">
                            <h5 class="card-title">Fish</h5>
                            <p class="card-text">Write something about fish...</p>
                            <a href="postList.php?id=4" class="btn btn-primary">Access Fish Subforum</a>
                          </div>
                    </div>
                </div>
                
                <!-- Hamster -->
                <div class="col-lg-4">
                    <div class="card text-white bg-info mb-3" style="width: 27rem;">
                      <img class="card-img-top" src="images/hamster.jpg" alt="Card image cap">
                          <div class="card-body">
                            <h5 class="card-title">Hamsters</h5>
                            <p class="card-text">Write something about hamsters...</p>
                            <a href="postList.php?id=5" class="btn btn-primary">Access Hamster Subforum</a>
                          </div>
                    </div>
                </div>
            
                 <!-- Reptile -->
                <div class="col-lg-4">
                    <div class="card text-white bg-success mb-3" style="width: 27rem;">
                      <img class="card-img-top" src="images/lizard.jpg" alt="Card image cap">
                          <div class="card-body">
                            <h5 class="card-title">Reptiles</h5>
                            <p class="card-text">Write something about reptiles...</p>
                            <a href="postList.php?id=6" class="btn btn-primary">Access Reptiles Subforum</a>
                          </div>
                    </div>
                </div>
            </div>

            <!-- END ROW -->
            
            <div class="row">
                <div class="col-lg-12">
                    <form action="corner.php" method="post" id="login">
                        <button id="corner" class="btn btn-primary">Pets Corner</button>
                    </form>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="row">
                <div class="col-lg-4">
                    <p class="footer">Created by Cynthia Carter and Evan Sauers.</p>
                </div>
            </div>
        </div>
    </body>
</html>