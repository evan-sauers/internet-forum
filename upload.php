<?php
    include("config.php");
    include("session.php");

  $topicNum = $_SESSION['topicNum'];

  // Initialize message variable
  $msg = " ";

// Uploads Database &
// Uploads Image to Uploads Folder
  if (isset($_POST['submit'])) {
  	
    $image = $_FILES['image'];
    $imageName = $_FILES['image']['name'];
    $imageTmpName = $_FILES['image']['tmp_name'];
    $imageSize = $_FILES['image']['size'];
    $imageError = $_FILES['image']['error'];
    $imageType = $_FILES['image']['type'];
    
    $imageExt = explode('.',$imageName);
    $imageActualExt = strtolower(end($imageExt));
    
    $allowed = array('jpeg', 'jpg', 'png');
    
    $image_text = mysqli_real_escape_string($conn, $_POST['image_text']);
      
      if (in_array($imageActualExt, $allowed)) {
            if ($imageError == 0){
                if ($imageSize < 100000000) {
                    $imageNameNew = uniqid('', true).".".$imageActualExt;
                    $imageDestination = 'upload/'.$imageNameNew;
                    move_uploaded_file($imageTmpName, $imageDestination);

                    $sql = "INSERT INTO images (image, image_text) VALUES ('$imageDestination', '$image_text')";
                    mysqli_query($conn, $sql);
                    
                    header("location: corner.php");
                } else {
                    echo "Your file is too big!";
                }
            } else{
              echo "There was a error uploading your image. Please try again."; 
            }
            
      } else {
              echo "You can not upload files of this type! Valid file types include: .PNG, .JPG or .JPEG!";
      }
  } 

?>