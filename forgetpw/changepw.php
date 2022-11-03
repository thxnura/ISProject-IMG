<?php
//session start
session_start();

//isset session variables
if (isset($_SESSION['passchangeid']) && isset($_SESSION['passchangea'])) {
    if ($_SESSION['passchangea'] == 1) {
        //isset post values
        if (isset($_POST['password'])) {
            //validate
            function validate($data){
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            //get post values
            $pw = validate($_POST['password']);

            //hash password
            $pw = hash('sha256', $pw);

            //get CID from session
            $CID = $_SESSION['passchangeid'];

            //connect db
            include "../dbconn.php";

            //update password
            $updatesql = "UPDATE CustomDetails SET pass='$pw' WHERE CID='$CID'"; 
            $result = mysqli_query($conn, $updatesql);

            //check if result is sucess
            if ($result == true) {
                echo "Password updated successfully";

                //unset session variables
                unset($_SESSION['passchangeid']);
                unset($_SESSION['passchangea']);

                //redirect to login page
                header("Location: ../");
            }

        } else {
            echo "Password not set";
        }
            
    } else {
        echo "Error no passchange approval";
    }
} else {
    echo "Error";
}

?>