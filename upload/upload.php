<?php
  // Create database connection (connect to Config file)
  $db = new mysqli('127.0.0.1', 'root', 'password', 'image_DB');

  // Initialize message variable
  $msg = " ";

// Uploads Database &
// Uploads Image yo Uploads Folder
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
    
    $image_text = mysqli_real_escape_string($db, $_POST['image_text']);
      
      if (in_array($imageActualExt, $allowed)) {
            if ($imageError == 0){
                if ($imageSize < 100000000) {
                    $imageNameNew = uniqid('', true).".".$imageActualExt;
                    $imageDestionation = 'uploads/'.$imageNameNew;
                    move_uploaded_file($imageTmpName, $imageDestionation);
                    
                    $imageEcho ="<img src=".$imageDestionation." height=300 width=auto />"; 
                    
                    echo "SUCCES!";
                    echo $imageEcho;
                        
                    $sql = "INSERT INTO images (image, image_text) VALUES ('$imageDestionation', '$image_text')";
                    mysqli_query($db, $sql);
                    
                    // header("Location:HERE")
                } else {
                    echo "Your file is too big!";
                }
            } else{
              echo "There was a error uploadig your image. Please try again."; 
            }
            
      } else {
              echo "You can not upload files of this type! Valid file types include: .PNG, .JPG or .JPEG!";
      }
  } 

?>