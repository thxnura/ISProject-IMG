<?php

session_start();
if (isset($_SESSION['uname']) ) {
    
} else {
    header("Location: ../signin");
}



?>


<?php

//Get the post Message
//check the isset
if (isset($_POST['Message'])){
 $Message = $_POST['Message'];
}
else {
    $Message = "No Message";

}
?>


<?php
$target_dir = "temp/";
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
if($imageFileType != "jpg")  {
  echo "Sorry, only JPG files are allowed.";
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
    $tempfile = "temp/" . $tempfile; 

    
        include "../../dbconn.php";
       $hint = $_POST['Hint'];
      
       $thekey =  rand(111111111111,999999999999);
       $uname = $_SESSION['uname'];
       $cid = $_SESSION['cid'];
       $sql = "INSERT INTO hasimg (Hint,uname,TempFile,HashKey,cid) VALUES ('$hint','$uname','$tempfile','$thekey','$cid')";
       $result = mysqli_query($conn, $sql);
       if ($result){
           echo "Hint updated";
       }
       else{
           echo "error".mysqli_error($conn);
       }

   


  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>



<?php



$simple_string = $Message;
$ciphering = "AES-128-CTR";

$iv_length = openssl_cipher_iv_length($ciphering);
$options   = 0;

$encryption_iv = '1234567891011121';

$encryption_key = $thekey;

$encryption = openssl_encrypt($simple_string, $ciphering, $encryption_key, $options, $encryption_iv);

//get the input id

$inputid = "SELECT * FROM hasimg WHERE HashKey = '$thekey'";
$result = mysqli_query($conn, $inputid);
if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
       $id = $row['HashID'];
    }
} else {
    $id = "0";
}


$allmessage = '{"ID":"'.$id.'","Message":"'.$encryption.'"}';




?>



<?php
include('functions.php');


//Edit below variables
$msg = $allmessage; //To encrypt
$src = $tempfile; //Start image

$msg .='|'; //EOF sign, decided to use the pipe symbol to show our decrypter the end of the message
$msgBin = toBin($msg); //Convert our message to binary
$msgLength = strlen($msgBin); //Get message length
$img = imagecreatefromjpeg($src); //returns an image identifier
list($width, $height, $type, $attr) = getimagesize($src); //get image size

if($msgLength>($width*$height)){ //The image has more bits than there are pixels in our image
  echo('Message too long. This is not supported as of now.');
  die();
}

$pixelX=0; //Coordinates of our pixel that we want to edit
$pixelY=0; //^

for($x=0;$x<$msgLength;$x++){ //Encrypt message bit by bit (literally)

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

  $newR = $r; //we dont change the red or green color, only the lsb of blue
  $newG = $g; //^
  $newB = toBin($b); //Convert our blue to binary
  $newB[strlen($newB)-1] = $msgBin[$x]; //Change least significant bit with the bit from out message
  $newB = toString($newB); //Convert our blue back to an integer value (even though its called tostring its actually toHex)

  $new_color = imagecolorallocate($img,$newR,$newG,$newB); //swap pixel with new pixel that has its blue lsb changed (looks the same)
  imagesetpixel($img,$pixelX,$pixelY,$new_color); //Set the color at the x and y positions
  $pixelX++; //next pixel (horizontally)

}
$randomDigit = rand(1,9999); //Random digit for our filename
imagepng($img,'result' . $randomDigit . '.png'); //Create image
echo('done: ' . 'result' . $randomDigit . '.png'); //Echo our image file name
$filename = 'result' . $randomDigit . '.png';
imagedestroy($img); //get rid of it

//redirect to down page
header("Location: download.php?file=$filename");

//unline $tempfile
unlink($tempfile);

?>








