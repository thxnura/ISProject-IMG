<?php

//session start
session_start();

//db connect
include "../dbconn.php";

//check get id
if (isset($_GET['id']) ) {
    $id = $_GET['id'];


    $newid = $id/5623595266;

    //validate
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    //check newid is a round number
    if (round($newid) == $newid) {
        
        //get RID from db
        $sql = "SELECT * FROM CustomDetails WHERE CID='$newid'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $RID = $row['RID'];
            $CID = $row['CID'];
            $email = $row['Email'];
        } else {
            //change to error page
            header("Location: auth-error.php");
            exit();
        }

        //Check post data
        if (isset($_POST['password'])) {
            $pw = validate($_POST['password']);
            

            if ($RID == $pw) {
                //echo "Password reset request accepted";
                //echo '<br>';
                //echo $newid;
                //echo '<br>';
                //echo $RID;
                //echo '<br>';
                //echo $pw;

                //add a session variable
                $_SESSION['passchangeid'] = $CID;
                $_SESSION['passchangea'] = '1';

            }
        } else {
            echo "Password not reset because RID does not match";
            
        }

    } else {
        //change header with error message
        header ( "Location: ../error.php?id=23");
        exit();
    }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

    <form action="./changepw.php" method="post">

        <section class="bg-gray-50 dark:bg-gray-900">
            <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
                <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                    <img class="w-8 h-8 mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg" alt="logo">
                    Flowbite    
                </a>
                <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                            Change Password
                        </h1>
                        <form class="space-y-4 md:space-y-6" action="#">
                           

                            <div>
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Password</label>
                                <input type="password" name="password" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required="">
                            </div>

                      
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                  <input id="terms" aria-describedby="terms" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" required="">
                                </div>
                                <div class="ml-3 text-sm">
                                  <label for="terms" class="font-light text-gray-500 dark:text-gray-300">I accept the <a class="font-medium text-primary-600 hover:underline dark:text-primary-500" href="#">Terms and Conditions</a></label>
                                </div>
                            </div>
                            <button type="submit" class="w-full text-white bg-blue-500 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Change Password</button>
                           
                        </form>
                    </div>
                </div>
            </div>
          </section>

    </form>
    
</body>
</html>