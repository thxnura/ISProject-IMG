<?php
session_start();
include "../dbconn.php";

if (isset($_SESSION['uname']) ) {
    
} else {
    header("Location: ../signin");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="shortcut icon" href="https://cdn.discordapp.com/attachments/938131839661539339/973611175168327740/Favi.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" />
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
</head>
<body id="body" class="bg-gray-900 text-gray-100 duration-1000">

    <div class="">
        <div class="flex ">
            <div x-data="{ open: true }" class="fixed top-0  z-50">
               <!-- Desktop View -->
                <div :class="{'hidden md:flex': open, 'flex': !open}" class="flex flex-col items-center w-48 h-screen overflow-hidden text-gray-300 bg-gray-800 rounded  " x-on:click="open = ! open">
                    <a class="flex items-center w-full px-3 mt-3" href="#">
                        <img src="../src/img/HashIMG.png"class="w-20 h-auto" alt="">
                        <span class="ml-2 text-sm font-bold">| Home</span>
                    </a>
                    <div class="w-full px-2">
                        <div class="flex flex-col items-center w-full mt-3 border-t border-gray-700">


                            <a class="flex items-center w-full h-12 px-3 mt-2 rounded hover:bg-gray-700 " href="/my">
                                <svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                <span class="ml-2 text-sm font-medium">Dashboard</span>
                            </a>



                            <a class="flex items-center w-full h-12 px-3 mt-2 rounded cursor-not-allowed" >
                                <svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                <span class="ml-2 text-sm font-medium">My #IMGs</span>
                            </a>

                            <a class="flex items-center w-full h-12 px-3 mt-2 rounded cursor-not-allowed" >
                                <svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                <span class="ml-2 text-sm font-medium">Public #IMGs</span>
                            </a>

                           

                           

                        </div>


                        <div class="flex flex-col items-center w-full mt-2 border-t border-gray-700">



                            <!-- Pending Projects -->
                            
                                <a class="flex items-center w-full h-12 px-3 mt-2 rounded hover:bg-gray-700" href="/my/pending/">
                               
                                    <svg class="w-6 h-6 stroke-current fill-orange-500" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 297 297" style="enable-background:new 0 0 297 297;" xml:space="preserve"> <g> <path d="M292.973,123.141l-44.298-33.228V63.958c0-5.56-4.577-10.067-10.223-10.067h-37.804l-46.107-34.585 c-3.579-2.684-8.503-2.684-12.082,0L96.352,53.89H58.548c-5.646,0-10.223,4.508-10.223,10.067v25.956L4.027,123.141 C1.491,125.043,0,128.027,0,131.196v138.443c0,5.561,4.508,10.068,10.067,10.068h276.865c5.56,0,10.067-4.508,10.067-10.068 V131.196C297,128.027,295.509,125.043,292.973,123.141z M20.136,147.486l63.94,31.972l-63.94,64.381V147.486z M102.975,188.909 l41.022,20.512c1.418,0.709,2.96,1.063,4.503,1.063s3.085-0.354,4.503-1.063l41.023-20.512l70.182,70.663H32.793L102.975,188.909z M212.924,179.458l63.941-31.972v96.353L212.924,179.458z M267.86,129.475l-19.186,9.594v-23.984L267.86,129.475z M148.5,39.945 l18.591,13.945h-37.182L148.5,39.945z M228.231,74.025v75.266L148.5,189.159L68.769,149.29V74.025H228.231z M48.325,139.069 l-19.186-9.594l19.186-14.391V139.069z"/> <path d="M113.894,123.955h69.216c5.559,0,10.067-4.508,10.067-10.068c0-5.56-4.508-10.067-10.067-10.067h-69.216 c-5.56,0-10.067,4.508-10.067,10.067C103.826,119.447,108.334,123.955,113.894,123.955z"/> <path d="M113.894,158.567h69.216c5.559,0,10.067-4.508,10.067-10.067s-4.508-10.067-10.067-10.067h-69.216 c-5.56,0-10.067,4.508-10.067,10.067S108.334,158.567,113.894,158.567z"/> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>
                                
                                    <span class="ml-2 text-sm font-medium text-orange-400">New #IMG</span>
                                </a>                            
                            
                         

                        </div>
                    </div>
                    <a class="flex items-center justify-center w-full h-16 mt-auto bg-gray-800 hover:bg-gray-700 " href="/logout">
                        <div class="border flex px-2 py-1 rounded-lg flex items-center gap-2">
                            <span class="ml-2 text-sm font-medium ">Log Out</span>
                            <svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        
                    </a>
                </div>
	            <!-- Desktop View End  -->


                <!-- Mobile Start -->
                <div  :class="{'flex md:hidden': open, 'hidden': !open}" class="flex flex-col items-center w-12 h-screen overflow-hidden text-gray-300 bg-gray-800 rounded " x-on:click="open = ! open">
                    <a class="flex items-center justify-center mt-3" href="#">
                        <img class="w-8 h-8" src="https://cdn.discordapp.com/attachments/938131839661539339/973611175168327740/Favi.png" alt="">
                    </a>
                    <div class="flex flex-col items-center mt-3 border-t border-gray-700">
                        <a class="flex items-center justify-center w-12 h-12 mt-2 rounded hover:bg-gray-700" href="">
                            <svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </a>

                        <a class="flex items-center justify-center w-12 h-12 mt-2 rounded hover:bg-gray-700" href="">
                            <svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </a>

                        <a class="flex items-center justify-center w-12 h-12 mt-2 text-gray-100 bg-gray-700 rounded" href="">
                            <svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </a>

                        <a class="flex items-center justify-center w-12 h-12 mt-2 rounded hover:bg-gray-700" href="">
                            <svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                            </svg>
                        </a>

                    </div>


                    <div class="flex flex-col items-center mt-2 border-t border-gray-700 hidden">
                        <a class="flex items-center justify-center w-12 h-12 mt-2 rounded hover:bg-gray-700" href="">
                            <svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </a>
                        <a class="flex items-center justify-center w-12 h-12 mt-2 rounded hover:bg-gray-700" href="">
                            <svg class="w-6 h-6 stroke-current"  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg>
                        </a>
                        <a class="relative flex items-center justify-center w-12 h-12 mt-2 rounded hover:bg-gray-700" href="">
                            <svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                            </svg>
                            <span class="absolute top-0 left-0 w-2 h-2 mt-2 ml-2 bg-gray-500 rounded-full"></span>
                        </a>
                    </div>
                    <a class="flex items-center justify-center w-16 h-16 mt-auto bg-gray-800 hover:bg-gray-700" href="">
                        <svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </a>
                </div>
	            <!-- Mobile End  -->
            </div>


           <div class="md:ml-60 ml-16 mr-1 mt-3">
            
            <div class="absolute top-0 right-0 ">
                <div class="w-screen flex justify-end items-center bg-gray-800 text-white h-10 md:hidden">
                    <a href="/logout">
                        <svg class="w-6 rotate-180 fill-gray-300 mr-5" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 330 330" style="enable-background:new 0 0 330 330;" xml:space="preserve"> <g id="XMLID_2_"> <path id="XMLID_4_" d="M51.213,180h173.785c8.284,0,15-6.716,15-15s-6.716-15-15-15H51.213l19.394-19.393 c5.858-5.857,5.858-15.355,0-21.213c-5.856-5.858-15.354-5.858-21.213,0L4.397,154.391c-0.348,0.347-0.676,0.71-0.988,1.09 c-0.076,0.093-0.141,0.193-0.215,0.288c-0.229,0.291-0.454,0.583-0.66,0.891c-0.06,0.09-0.109,0.185-0.168,0.276 c-0.206,0.322-0.408,0.647-0.59,0.986c-0.035,0.067-0.064,0.138-0.099,0.205c-0.189,0.367-0.371,0.739-0.53,1.123 c-0.02,0.047-0.034,0.097-0.053,0.145c-0.163,0.404-0.314,0.813-0.442,1.234c-0.017,0.053-0.026,0.108-0.041,0.162 c-0.121,0.413-0.232,0.83-0.317,1.257c-0.025,0.127-0.036,0.258-0.059,0.386c-0.062,0.354-0.124,0.708-0.159,1.069 C0.025,163.998,0,164.498,0,165s0.025,1.002,0.076,1.498c0.035,0.366,0.099,0.723,0.16,1.08c0.022,0.124,0.033,0.251,0.058,0.374 c0.086,0.431,0.196,0.852,0.318,1.269c0.015,0.049,0.024,0.101,0.039,0.15c0.129,0.423,0.28,0.836,0.445,1.244 c0.018,0.044,0.031,0.091,0.05,0.135c0.16,0.387,0.343,0.761,0.534,1.13c0.033,0.065,0.061,0.133,0.095,0.198 c0.184,0.341,0.387,0.669,0.596,0.994c0.056,0.088,0.104,0.181,0.162,0.267c0.207,0.309,0.434,0.603,0.662,0.895 c0.073,0.094,0.138,0.193,0.213,0.285c0.313,0.379,0.641,0.743,0.988,1.09l44.997,44.997C52.322,223.536,56.161,225,60,225 s7.678-1.464,10.606-4.394c5.858-5.858,5.858-15.355,0-21.213L51.213,180z"/> <path id="XMLID_5_" d="M207.299,42.299c-40.944,0-79.038,20.312-101.903,54.333c-4.62,6.875-2.792,16.195,4.083,20.816 c6.876,4.62,16.195,2.794,20.817-4.083c17.281-25.715,46.067-41.067,77.003-41.067C258.414,72.299,300,113.884,300,165 s-41.586,92.701-92.701,92.701c-30.845,0-59.584-15.283-76.878-40.881c-4.639-6.865-13.961-8.669-20.827-4.032 c-6.864,4.638-8.67,13.962-4.032,20.826c22.881,33.868,60.913,54.087,101.737,54.087C274.956,287.701,330,232.658,330,165 S274.956,42.299,207.299,42.299z"/> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>
                    </a>
                        
                </div>
            </div>
            

                <div class="ml-1 mt-10 md:mt-0 w-[82vw] md:w-[68vw] lg:w-[75vw] xl:w-[78vw] 2xl:w-[82vw]">
                    
            
                <div>
                    <div class="bg-gray-800 py-2 px-3 rounded-lg flex justify-between items-center">
                       <h1> Hello, <span class="text-gray-200 font-semibold" title="dscsdcs  &#010; scsdcsd"><?php echo  $_SESSION['fullname']; ?></span></h1>
                       <div class="flex items-center gap-2">
                            <div title="My Profile" class="w-10 h-10 bg-cover rounded-full cursor-pointer bg-[url('https://images.unsplash.com/photo-1563306406-e66174fa3787?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1974&q=80')] hover:scale-110 duration-300">

                            </div>

                            <div title="Settings" class="w-10 h-10 bg-cover rounded-full cursor-pointer bg-gray-700 flex items-center justify-center hover:rotate-90 duration-500">
                                <i class="uil uil-cog text-2xl  text-gray-300 -mt-1 "></i>
                            </div>
                           
                       </div>
                    </div>
                </div>
           
                <div class="mt-5 ml-2">

                <div class='bg-gray-800 rounded-lg p-3 space-x-3 border-l-4 my-3'>
                    <button class='border p-1 rounded-lg px-3 bg-gray-700 border-gray-600 hover:scale-95' data-modal-toggle="medium-modal">
                        Create a #IMG
                    </button>

                    <button class='border p-1 rounded-lg px-3 bg-gray-700 border-gray-600  hover:scale-95' type="button" data-modal-toggle="popup-modal">
                        Unmask a #IMG
                    </button>
                </div>

                <!-- Default Modal -->
                <div id="medium-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                    <div class="relative p-4 w-full max-w-lg h-full md:h-auto">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div class="flex justify-between items-center p-5 rounded-t border-b dark:border-gray-600">
                                <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                                    Mask your #IMG
                                </h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="medium-modal">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    <span class="sr-only">Close modal</span> 
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-6 space-y-6">
                                

                            <form class='space-y-3' action="hash2/fileupload.php" method="post"  enctype="multipart/form-data">
                                <div class="relative">
                                    <input name="HInt" type="text" name="hint" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                    <label for="floating_outlined" class="absolute text-sm text-gray-500 dark:text-gray-100 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-700 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                                        Hint
                                    </label>
                                </div>

                                <div class="relative">
                                    <input type="text" name="Message" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                    <label for="floating_outlined" class="absolute text-sm text-gray-500 dark:text-gray-100 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-700 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                                        Message
                                    </label>
                                </div>

                                
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="file_input">Upload file</label>
                                <input name="fileToUpload" class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"   type="file">
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">JPG (MAX. 800x400px).</p>
                            </div>

                            <input data-modal-toggle="medium-modal" type="submit" value="Create" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">

                            </form>

                            </div>
                            <!-- Modal footer -->
                            
                        </div>
                    </div>
                </div>
                    <h1 class="text-2xl font-semibold">Your Recent #IMGs</h1>

                    <div class="grid md:grid-cols-2 gap-3 duration-1000">
                        <div class="grid md:grid-cols-2  gap-3 mt-3">

                        <?php
                        //session cid
                        $cid = $_SESSION['cid'];
                        
                        $sql = "SELECT * FROM hasimg WHERE cid = '$cid'";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                               
                        ?>
                             
                                    <div title="My #IMG1" class=" h-32 bg-gray-700 rounded-lg hover:scale-95 hover:rounded-2xl duration-300 p-3" type="button" data-modal-toggle="popup-modal">
                                        <h1>#IMG <?php echo $row["HashID"] ?></h1>
                                        <h1> <?php echo $row["Hint"] ?></h1>
                                        <h1 class="text-xs">Created on: 2022-10-05</h1>                                                                
                                    </div> 
                            
                                

                                <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
                                    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                                        <div class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600">
                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                Unmask a #IMG
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="popup-modal">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                            <div class="p-6 text-center ">
                                                <form action="./hashimg-d/fileupload-d.php" method="post" enctype="multipart/form-data">
                                                <div class="relative text-left">
                                                 
                                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="file_input">Upload the #Image</label>
                                                    <input onchange="this.form.submit()" class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" name="fileToUpload" id="fileToUpload" type="file">
                                                    <p class="mt-1 text-xs text-red-500" id="file_input_help">Only png file format is allowed!</p>

                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            

                        <?php
                               
                            }
                        } else {
                            echo "0 results";
                        }
                        
                        ?>

                            

       
                           <div class="col-span-2 flex gap-2" href="">
                            <button class="bg-indigo-600 py-2 px-3 rounded-xl font-semibold text-center w-3/5 xl:w-4/5">View All</button>
                            <button id="body2" onmouseover="hoverpurge()" onmouseout="hoverpurge2()" class="bg-red-600 py-2 px-3 rounded-xl font-semibold text-center w-2/5 xl:w-1/5 hover:rounded-2xl duration-300">Purge All</button>
                           </div>
                            
                            
                        </div>
                        <div class="p-3 bg-gray-800 rounded-xl h-fit mt-3">
                            <h1 class="text-2xl font-semibold"><i class="uil uil-bell pr-2"></i>Recent Activities</h1>
                            

                        </div>
                    </div>
                </div>

               


                </div>           
        </div>



    </div>

    

	   

</body>

<script>
    function hoverpurge() {
        document.getElementById("body").classList.add("bg-gray-800");

        document.getElementById("body").classList.remove("bg-gray-900");
       
    }
    function hoverpurge2() {
        document.getElementById("body").classList.remove("bg-gray-800");

        document.getElementById("body").classList.add("bg-gray-900");
       
    }
</script>
<script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
</html>



