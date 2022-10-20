<?php
//isset id
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($id == 1) {
        $errorcode = "Invalid attempt";
    } else {
        $errorcode = "Invalid attempt";
    }
} else {
    header("Location: ../");
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>You are already registered!</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    </head>

<body class="bg-gray-900 text-gray-100">

    <div>
        <div class="flex justify-center items-center w-screen h-screen">
            <div class=" max-w-2xl ml-10 min-w-[50%] mr-10 px-5 bg-gray-800 shadow-md rounded-xl py-10 flex items-center justify-center">
               <div>
                    <h1 class='text-red-500 text-center'><i class="uil uil-exclamation-triangle text-center text-6xl"></i></h1>
                    <h1 class="text-2xl font-semibold text-center text-red-400">
                    <?php echo $errorcode; ?>
                    </h1>
                    

                    <h1 class='text-xs text-center mt-3 text-gray-400'>#IMG Security</h1>
                   
                    
               </div>
            </div>
        </div>
    </div>

</body>
</html>