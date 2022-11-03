<?php
session_start();

if (isset($_SESSION['uname']) ) {
    header('Location: ../my');

} 


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - #img</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900">
    <!--Login Screen-->
    <div class="">
        <div class="flex w-screen h-screen items-center justify-center">
            <div>
            <img class="w-40 ml-auto mr-auto mb-10" src="../src/img/HashIMG.png" alt="">
            <div class='bg-gray-800 px-10 py-20 rounded-lg border border-gray-700'>
                
                <div>
                    <h1 class='text-center text-white text-xl'>Please check your mail  </h1>
                </div>
            </div>

           
            </div>
        </div>
    </div>
</body>
</html>