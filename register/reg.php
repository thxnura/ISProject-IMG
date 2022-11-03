<?php
session_start();


include "../dbconn.php";

//register user and insert data

if (isset($_POST['email']) && isset($_POST['password'])) {
    //validate data
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = validate($_POST['email']);
    $pass = validate($_POST['password']);
    $name = validate($_POST['name']);

    //hash password sha 256
    $pass = hash('sha256', $pass);

    //check if email already exists
    $sql = "SELECT * FROM CustomDetails WHERE Email='$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        header("Location: index.php?error=The email is taken try another");
        exit();
    }else{
        //insert data into db
        $sql2 = "INSERT INTO CustomDetails(Email, Pass, FirstName,uname) VALUES('$email', '$pass', '$name','$email')";
        $result2 = mysqli_query($conn, $sql2);
        if ($result2) {
            //change header
            header("Location: ../my");
            exit();
        }else{
            //header("Location: index.php?error=unknown error occurred&$user_data");
            echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
            exit();
        }
    }

   
    
}

?>