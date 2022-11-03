<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $newid = $id/5623595266;
    if (round($newid) == $newid) {
        
    } else {
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
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Verify</title>
</head>
<body class='bg-gray-900'>


    <div class='flex h-screen w-screen items-center justify-center'>
        <div>
            
            <form action="auth.php?id=<?php echo $id; ?>" method="post">
            
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Please enter the code</label>
                <input type="password" name="password" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="xxxxx">
                <?php
                if(isset($_GET['error'])) {
                    echo "<h1 class='text-red-500 text-xs mt-3'> *Incorect passcode</h1>";
                }
                
                ?>
                <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">We’ll never share your details. Read our <a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Privacy Policy</a>.</p>
                <input class='mt-5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 w-full' type="submit" value="submit">
                
            </form>

        </div>
    </div>
</body>
</html>