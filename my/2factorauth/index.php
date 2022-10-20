<?php
session_start();
include "../../dbconn.php";

if (isset($_SESSION['uname']) ) {
    
} else {
    header("Location: ../../signin");
}


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
    //echo "File is an image - " . $check["mime"] . ".";
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
    //echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    $tempfile = htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));
    $tempfile = "temp-d/" . $tempfile; 

    //add data to DB 
    
    //session cid
    $cid = $_SESSION['cid'];


    $sql = "INSERT INTO DecryptData (CID,FileName) VALUES ('$cid','$tempfile')";
    $result = mysqli_query($conn, $sql);

      


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
          //echo ('done<br>'); //Yes we're done now
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
         
          //echo $id;
          //echo '<br>'.$Message;

          $decryption_iv = '1234567891011121';

          include "../../dbconn.php";
          //get the key from db
            $sql = "SELECT * FROM hasimg WHERE  HashID = '$id'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($result)) {
                    $key = $row["HashKey"];
                    $HashID = $row["HashID"];
                }
            } 

            //select random value to 2 factor auth
            $twofactor = random_int(10000, 99999);
            date_default_timezone_set('Asia/Colombo');
            $time = date('H:i:s');
            $date = date('Y-m-d');



            //update randomized 2factorauth value in sql db
            $sql = "UPDATE hasimg SET 2Factor = '$twofactor', AuthDate = '$date', AuthTime = '$time' WHERE HashID = '$HashID'";
            $result = mysqli_query($conn, $sql);

            //check result is true
            if ($result === TRUE) {

            } else {
                echo "Error updating record: " . $conn->error;
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




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="shortcut icon" href="https://cdn.discordapp.com/attachments/938131839661539339/973611175168327740/Favi.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" />
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
</head>
<body id="body" class="bg-gray-900 text-gray-100 duration-1000">

    <div class="">
        <div class="flex ">
            <div x-data="{ open: true }" class="fixed top-0  z-50">
               <!-- Desktop View -->
                <div :class="{'hidden md:flex': open, 'flex': !open}" class="flex flex-col items-center w-48 h-screen overflow-hidden text-gray-300 bg-gray-800 rounded  " x-on:click="open = ! open">
                    <a class="flex items-center w-full px-3 mt-3" href="#">
                        <img src="../../src/img/HashIMG.png"class="w-20 h-auto" alt="">
                        <span class="ml-2 text-sm font-bold">| Home</span>
                    </a>
                    <div class="w-full px-2">
                        <div class="flex flex-col items-center w-full mt-3 border-t border-gray-700">


                            <a class="flex items-center w-full h-12 px-3 mt-2 rounded hover:bg-gray-700 " href="/my">
                                <svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                <span class="ml-2 text-sm font-medium">Dashboard</span>
                            </a>



                            <a class="flex items-center w-full h-12 px-3 mt-2 rounded cursor-not-allowed" >
                                <svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                <span class="ml-2 text-sm font-medium">My #IMGs</span>
                            </a>

                            <a class="flex items-center w-full h-12 px-3 mt-2 rounded cursor-not-allowed" >
                                <svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                <span class="ml-2 text-sm font-medium">Public #IMGs</span>
                            </a>

                           

                           

                        </div>


                        <div class="flex flex-col items-center w-full mt-2 border-t border-gray-700">



                            <!-- Pending Projects -->
                            
                                <a class="flex items-center w-full h-12 px-3 mt-2 rounded hover:bg-gray-700" href="/my/pending/">
                               
                                    <svg class="w-6 h-6 stroke-current fill-orange-500" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 297 297" style="enable-background:new 0 0 297 297;" xml:space="preserve"> <g> <path d="M292.973,123.141l-44.298-33.228V63.958c0-5.56-4.577-10.067-10.223-10.067h-37.804l-46.107-34.585 c-3.579-2.684-8.503-2.684-12.082,0L96.352,53.89H58.548c-5.646,0-10.223,4.508-10.223,10.067v25.956L4.027,123.141 C1.491,125.043,0,128.027,0,131.196v138.443c0,5.561,4.508,10.068,10.067,10.068h276.865c5.56,0,10.067-4.508,10.067-10.068 V131.196C297,128.027,295.509,125.043,292.973,123.141z M20.136,147.486l63.94,31.972l-63.94,64.381V147.486z M102.975,188.909 l41.022,20.512c1.418,0.709,2.96,1.063,4.503,1.063s3.085-0.354,4.503-1.063l41.023-20.512l70.182,70.663H32.793L102.975,188.909z M212.924,179.458l63.941-31.972v96.353L212.924,179.458z M267.86,129.475l-19.186,9.594v-23.984L267.86,129.475z M148.5,39.945 l18.591,13.945h-37.182L148.5,39.945z M228.231,74.025v75.266L148.5,189.159L68.769,149.29V74.025H228.231z M48.325,139.069 l-19.186-9.594l19.186-14.391V139.069z"/> <path d="M113.894,123.955h69.216c5.559,0,10.067-4.508,10.067-10.068c0-5.56-4.508-10.067-10.067-10.067h-69.216 c-5.56,0-10.067,4.508-10.067,10.067C103.826,119.447,108.334,123.955,113.894,123.955z"/> <path d="M113.894,158.567h69.216c5.559,0,10.067-4.508,10.067-10.067s-4.508-10.067-10.067-10.067h-69.216 c-5.56,0-10.067,4.508-10.067,10.067S108.334,158.567,113.894,158.567z"/> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>
                                
                                    <span class="ml-2 text-sm font-medium text-orange-400">New #IMG</span>
                                </a>                            
                            
                         

                        </div>
                    </div>
                    <a class="flex items-center justify-center w-full h-16 mt-auto bg-gray-800 hover:bg-gray-700 " href="/logout">
                        <div class="border flex px-2 py-1 rounded-lg flex items-center gap-2">
                            <span class="ml-2 text-sm font-medium ">Log Out</span>
                            <svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        
                    </a>
                </div>
	            <!-- Desktop View End  -->


                <!-- Mobile Start -->
                <div  :class="{'flex md:hidden': open, 'hidden': !open}" class="flex flex-col items-center w-12 h-screen overflow-hidden text-gray-300 bg-gray-800 rounded " x-on:click="open = ! open">
                    <a class="flex items-center justify-center mt-3" href="#">
                        <img class="w-8 h-8" src="https://cdn.discordapp.com/attachments/938131839661539339/973611175168327740/Favi.png" alt="">
                    </a>
                    <div class="flex flex-col items-center mt-3 border-t border-gray-700">
                        <a class="flex items-center justify-center w-12 h-12 mt-2 rounded hover:bg-gray-700" href="">
                            <svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </a>

                        <a class="flex items-center justify-center w-12 h-12 mt-2 rounded hover:bg-gray-700" href="">
                            <svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </a>

                        <a class="flex items-center justify-center w-12 h-12 mt-2 text-gray-100 bg-gray-700 rounded" href="">
                            <svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </a>

                        <a class="flex items-center justify-center w-12 h-12 mt-2 rounded hover:bg-gray-700" href="">
                            <svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                            </svg>
                        </a>

                    </div>


                    <div class="flex flex-col items-center mt-2 border-t border-gray-700 hidden">
                        <a class="flex items-center justify-center w-12 h-12 mt-2 rounded hover:bg-gray-700" href="">
                            <svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </a>
                        <a class="flex items-center justify-center w-12 h-12 mt-2 rounded hover:bg-gray-700" href="">
                            <svg class="w-6 h-6 stroke-current"  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg>
                        </a>
                        <a class="relative flex items-center justify-center w-12 h-12 mt-2 rounded hover:bg-gray-700" href="">
                            <svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                            </svg>
                            <span class="absolute top-0 left-0 w-2 h-2 mt-2 ml-2 bg-gray-500 rounded-full"></span>
                        </a>
                    </div>
                    <a class="flex items-center justify-center w-16 h-16 mt-auto bg-gray-800 hover:bg-gray-700" href="">
                        <svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </a>
                </div>
	            <!-- Mobile End  -->
            </div>


           <div class="md:ml-60 ml-16 mr-1 mt-3">
            
            <div class="absolute top-0 right-0 ">
                <div class="w-screen flex justify-end items-center bg-gray-800 text-white h-10 md:hidden">
                    <a href="/logout">
                        <svg class="w-6 rotate-180 fill-gray-300 mr-5" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 330 330" style="enable-background:new 0 0 330 330;" xml:space="preserve"> <g id="XMLID_2_"> <path id="XMLID_4_" d="M51.213,180h173.785c8.284,0,15-6.716,15-15s-6.716-15-15-15H51.213l19.394-19.393 c5.858-5.857,5.858-15.355,0-21.213c-5.856-5.858-15.354-5.858-21.213,0L4.397,154.391c-0.348,0.347-0.676,0.71-0.988,1.09 c-0.076,0.093-0.141,0.193-0.215,0.288c-0.229,0.291-0.454,0.583-0.66,0.891c-0.06,0.09-0.109,0.185-0.168,0.276 c-0.206,0.322-0.408,0.647-0.59,0.986c-0.035,0.067-0.064,0.138-0.099,0.205c-0.189,0.367-0.371,0.739-0.53,1.123 c-0.02,0.047-0.034,0.097-0.053,0.145c-0.163,0.404-0.314,0.813-0.442,1.234c-0.017,0.053-0.026,0.108-0.041,0.162 c-0.121,0.413-0.232,0.83-0.317,1.257c-0.025,0.127-0.036,0.258-0.059,0.386c-0.062,0.354-0.124,0.708-0.159,1.069 C0.025,163.998,0,164.498,0,165s0.025,1.002,0.076,1.498c0.035,0.366,0.099,0.723,0.16,1.08c0.022,0.124,0.033,0.251,0.058,0.374 c0.086,0.431,0.196,0.852,0.318,1.269c0.015,0.049,0.024,0.101,0.039,0.15c0.129,0.423,0.28,0.836,0.445,1.244 c0.018,0.044,0.031,0.091,0.05,0.135c0.16,0.387,0.343,0.761,0.534,1.13c0.033,0.065,0.061,0.133,0.095,0.198 c0.184,0.341,0.387,0.669,0.596,0.994c0.056,0.088,0.104,0.181,0.162,0.267c0.207,0.309,0.434,0.603,0.662,0.895 c0.073,0.094,0.138,0.193,0.213,0.285c0.313,0.379,0.641,0.743,0.988,1.09l44.997,44.997C52.322,223.536,56.161,225,60,225 s7.678-1.464,10.606-4.394c5.858-5.858,5.858-15.355,0-21.213L51.213,180z"/> <path id="XMLID_5_" d="M207.299,42.299c-40.944,0-79.038,20.312-101.903,54.333c-4.62,6.875-2.792,16.195,4.083,20.816 c6.876,4.62,16.195,2.794,20.817-4.083c17.281-25.715,46.067-41.067,77.003-41.067C258.414,72.299,300,113.884,300,165 s-41.586,92.701-92.701,92.701c-30.845,0-59.584-15.283-76.878-40.881c-4.639-6.865-13.961-8.669-20.827-4.032 c-6.864,4.638-8.67,13.962-4.032,20.826c22.881,33.868,60.913,54.087,101.737,54.087C274.956,287.701,330,232.658,330,165 S274.956,42.299,207.299,42.299z"/> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>
                    </a>
                        
                </div>
            </div>
            

                <div class="ml-1 mt-10 md:mt-0 w-[82vw] md:w-[68vw] lg:w-[75vw] xl:w-[78vw] 2xl:w-[82vw]">
                    
            
                <div>
                    <div class="bg-gray-800 py-2 px-3 rounded-lg flex justify-between items-center">
                       <h1> Hello, <span class="text-gray-200 font-semibold" title="dscsdcs  &#010; scsdcsd"><?php echo  $_SESSION['fullname']; ?></span></h1>
                       <div class="flex items-center gap-2">
                            <div title="My Profile" class="w-10 h-10 bg-cover rounded-full cursor-pointer bg-[url('https://images.unsplash.com/photo-1563306406-e66174fa3787?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1974&q=80')] hover:scale-110 duration-300">

                            </div>

                            <div title="Settings" class="w-10 h-10 bg-cover rounded-full cursor-pointer bg-gray-700 flex items-center justify-center hover:rotate-90 duration-500">
                                <i class="uil uil-cog text-2xl  text-gray-300 -mt-1 "></i>
                            </div>
                           
                       </div>
                    </div>
                </div>
           
                <div class="mt-5 ml-2">
                    <div class='fl'>
                        <div class='bg-gray-700 p-5'>
                            <div class='grid grid-cols-2'>
                                <div class="p-3 rounded-xl bg-[url('<?php echo $tempfile ?>')] bg-cover h-96">
                                    <h1>Uploaded Image</h1>
                                </div>

                                <div>
                                    sdcsdc
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
               


                </div>           
        </div>



    </div>

    

	   

</body>

<script>
    function hoverpurge() {
        document.getElementById("body").classList.add("bg-gray-800");

        document.getElementById("body").classList.remove("bg-gray-900");
       
    }
    function hoverpurge2() {
        document.getElementById("body").classList.remove("bg-gray-800");

        document.getElementById("body").classList.add("bg-gray-900");
       
    }
</script>
<script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
</html>



