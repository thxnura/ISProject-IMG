<?php 

session_start();
unset($_SESSION["uname"]);
unset($_SESSION["RID"]);
header("Location:../");
?>