
<?php

?>


<?php
$target_dir = "temp-d/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 10000000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "png")  {
  echo "Sorry, only PNG files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    $tempfile = htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));
    $tempfile = "temp-d/" . $tempfile; 

      


  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>




<?php
include('functions.php');

$src = $tempfile; //Change this to the image to decrypt


$img = imagecreatefrompng($src); //Returns image identifier
$real_message = ''; //Empty variable to store our message

$count = 0; //Wil be used to check our last char
$pixelX = 0; //Start pixel x coordinates
$pixelY = 0; //start pixel y coordinates

list($width, $height, $type, $attr) = getimagesize($src); //get image size

for ($x = 0; $x < ($width*$height); $x++) { //Loop through pixel by pixel
  if($pixelX === $width+1){ //If this is true, we've reached the end of the row of pixels, start on next row
    $pixelY++;
    $pixelX=0;
  }

  if($pixelY===$height && $pixelX===$width){ //Check if we reached the end of our file
    echo('Max Reached');
    die();
  }

  $rgb = imagecolorat($img,$pixelX,$pixelY); //Color of the pixel at the x and y positions
  $r = ($rgb >>16) & 0xFF; //returns red value for example int(119)
  $g = ($rgb >>8) & 0xFF; //^^ but green
  $b = $rgb & 0xFF;//^^ but blue

  $blue = toBin($b); //Convert our blue to binary

  $real_message .= $blue[strlen($blue) - 1]; //Ad the lsb to our binary result

  $count++; //Coun that a digit was added

  if ($count == 8) { //Every time we hit 8 new digits, check the value
      if (toString(substr($real_message, -8)) === '|') { //Whats the value of the last 8 digits?
          echo ('done<br>'); //Yes we're done now
          $real_message = toString(substr($real_message,0,-8)); //convert to string and remove /
          //echo ('Result: ');
          //echo $real_message; //Show

          //delete the temp image
          unlink($tempfile);

          $xmldata = $real_message;
          //extract data
          $metadataxml = array();
         
          foreach(json_decode($xmldata,true)as $key=>$value){
              $metadataxml[$key] = $value;
         
              if ($key == "ID"){
                  $id = $value;
              }

              if ($key == "Message"){
                  $Message = $value;
              }
          } 
         
          echo $id;
          echo '<br>'.$Message;

          $decryption_iv = '1234567891011121';

          include "../../dbconn.php";
          //get the key from db
            $sql = "SELECT * FROM hasimg WHERE  HashID = '$id'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($result)) {
                    $key = $row["HashKey"];
                }
            } 

            $decryption_key = $key;

            $ciphering = "AES-128-CTR";
            $decryption_iv = '1234567891011121';
            $options   = 0;

            $decrypted_message = openssl_decrypt ($Message, $ciphering,$decryption_key, $options, $decryption_iv);

            echo '<br>'.$decrypted_message;

          die;
      }
      $count = 0; //Reset counter
  }

  $pixelX++; //Change x coordinates to next
}
?>
