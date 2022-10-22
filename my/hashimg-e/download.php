<?php 
//doenload png file from the server
if(isset($_GET['file'])){
    $file = $_GET['file'];
    $filepath = $file;
    if(file_exists($filepath)){
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        
        //unlink
        unlink($file);
        exit();
    }
}