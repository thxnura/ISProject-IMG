<?php

//session
session_start();

//isset values
    if (isset($_POST["acode"])){
        //echo ($_POST["acode"]);
    } else {
        echo ("no acode");
        header ( "Location: 2factor.php?error=Invalid Code");
        exit();
    }

session_start();
include "../../dbconn.php";
$HashID = $_SESSION['Hashid'];


//get the auth value from db
$sql = "SELECT * FROM hasimg WHERE  HashID = '$HashID'";
$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
       $getnow = $row['2Factor'];
    }
} else {
    $getnow = "0";
}


if ($getnow == $_POST["acode"]){
    //echo "success";
    //set session approved
    $_SESSION['approve'] = "true";
    $_SESSION['NewHashid'] = $HashID;
    //redirect to preview page with GET ID
    header ( "Location: preview.php?ID=".$HashID);
} else {
    header ( "Location: 2factor.php?error=Invalid Code");
}
