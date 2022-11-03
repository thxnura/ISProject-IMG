<?php
session_start();

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
                
                <div class='-translate-y-5 w-96'>
                    <h1 class='text-left text-white font-semibold text-3xl'>Find Your Account</h1>
                    <h1 class='text-gray-200 text-sm '>Please enter your email address or mobile number to search for your account.</h1>
                </div>
                <form action="./find.php" method="post">
                    <div class="flex justify-center mt-5">
                        <input name="email" type="email" class="border border-gray-400 px-5 py-1.5 rounded-lg w-96 bg-transparent text-white" placeholder="Email">

                    </div>
                    
                    <div class="flex justify-center mt-5">
                        <button type="submit" class="bg-blue-500 px-5 py-1.5 rounded-lg w-96 text-white">Continue</button>
                    </div>
                   
                </form>
            </div>

            <h1 class='text-gray-400 translate-y-10 text-sm '>Don’t have an account yet? <a class='text-gray-100' href="../register">Sign up</a></h1>
            </div>
        </div>
    </div>
</body>
</html>