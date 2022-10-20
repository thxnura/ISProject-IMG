<?php

//session
session_start();

?>


<?php

if (isset($_GET['ID']) ) {
  $GetHashID = $_GET['ID'];   
} else {
    exit('error');
}


if ($GetHashID == $_SESSION['NewHashid']) {
    //isset approve 

    if (isset($_SESSION['secr']) ) {

    } else {
        header ( "Location: ../error.php?id=noapprove4");
        exit('error');
    }


    if (isset($_SESSION['approve']) ) {
        //echo "approved";
    } else {
        header ( "Location: ../error.php?id=noapprove");
        exit('Approve not found');
    }
    if ($_SESSION['approve'] == "true") {
        //echo "success";
        //unnlink approve
        unset($_SESSION['approve']);
    } else {
        header ( "Location: ../error.php?id=noapprove2");
        exit('error');
    }
} else {
    header ( "Location: ../error.php?id=noapprove3");
    exit('error');
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
<body class='bg-gray-900'>


    <div class='flex h-screen w-screen items-center justify-center'>
     
            
    <div class="p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 min-w-[30%]">
    <svg class="mb-2 w-10 h-10 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 5a3 3 0 015-2.236A3 3 0 0114.83 6H16a2 2 0 110 4h-5V9a1 1 0 10-2 0v1H4a2 2 0 110-4h1.17C5.06 5.687 5 5.35 5 5zm4 1V5a1 1 0 10-1 1h1zm3 0a1 1 0 10-1-1v1h1z" clip-rule="evenodd"></path><path d="M9 11H3v5a2 2 0 002 2h4v-7zM11 18h4a2 2 0 002-2v-5h-6v7z"></path></svg>
    <a href="#">
        <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Your #IMG </h5>
    </a>
    <p class="mb-3 font-normal text-gray-500 dark:text-gray-400"><?php echo $_SESSION['secr']; unset($_SESSION['secr']); ?></p>
    <a href="#" class="inline-flex items-center text-red-600 hover:underline">
       Exit
        <svg class="ml-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z"></path><path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z"></path></svg>
    </a>
</div>

        </div>
    
</body>
</html>
