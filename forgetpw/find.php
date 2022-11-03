<?php

//db connect
include "../dbconn.php";

//check if email is set
if (isset($_POST['email'])) {
    //validate data
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = validate($_POST['email']);

    //check if email exists

    $sql = "SELECT * FROM CustomDetails WHERE Email='$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        //send email
        $row = mysqli_fetch_assoc($result);
        $to = $row['Email'];
        $CID = $row['CID'];

        //generate a random 8 bit key
        $key = bin2hex(random_bytes(3));

        //insert key into db
        $sql2 = "UPDATE CustomDetails SET RID='$key' WHERE Email='$to'";
        $result2 = mysqli_query($conn, $sql2);

        if ($result2 == true) {
            echo "Key inserted";

            //send mail
            $emailkey = $key;
            $emailto = $to;

            //require_once 'phpmailer.php';

            //header change to auth page
            //new CID
            $NEWCID = $CID*5623595266;


            header("Location: auth-enter.php?id=$NEWCID");

        } else {
            echo "error ".mysqli_error($conn);
        }
        
        echo $key;


    }
}

?>