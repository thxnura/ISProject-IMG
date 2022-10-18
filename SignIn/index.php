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
                <img class="w-64 ml-auto mr-auto " src="../src/img/HashIMG.png" alt="">
                <form action="./login.php" method="post">
                    <div class="flex justify-center mt-5">
                        <input name="uname" type="text" class="border border-gray-400 px-5 py-1.5 rounded-lg w-96 bg-transparent text-white" placeholder="Email">

                    </div>
                    <div class="flex justify-center mt-5">
                        <input name="password" type="password" class="border border-gray-400 px-5 py-1.5 rounded-lg w-96 bg-transparent text-white" placeholder="Password">
                    </div>
                    <div class="flex justify-center mt-5">
                        <button type="submit" class="bg-blue-500 px-5 py-1.5 rounded-lg w-96 text-white">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>