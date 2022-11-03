<?php

session_start();
include "../dbconn.php";

if (isset($_POST['oldpassword']) && isset($_POST['newpassword'])) {
    
        function validate($data){
    
        $data = trim($data);
    
        $data = stripslashes($data);
    
        $data = htmlspecialchars($data);
    
        return $data;
    
        }
    
        $oldpass = validate($_POST['oldpassword']);
        $newpass = validate($_POST['newpassword']);
        $oldpass = hash('sha256', $oldpass);
        $newpass = hash('sha256', $newpass);
        $cid = $_SESSION['cid'];

        //check old password
        $sql = "SELECT * FROM CustomDetails WHERE CID='$cid' AND Pass='$oldpass'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            //update password
            $sql2 = "UPDATE CustomDetails SET Pass='$newpass' WHERE CID='$cid'";
            $result2 = mysqli_query($conn, $sql2);
            if ($result2) {
                //change header
                header("Location: ../my?success=Password updated successfully");
                exit();
            }else{
                header("Location: index.php?error=Password is not updated");
                exit();
            }

        }
        else{
            header("Location: index.php?error=Old password is incorrect");
            exit();
        }
}

?>