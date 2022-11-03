<?php
$message = '541561651 jfvnkm dfmv ;ld,f,v dflv;ld fvdfl,v;ld, vd vdfl,v;d,fv df;lv,d;lf vdfvll;';
echo $message;
echo '<br>';
//sha 256
$hash = hash('sha256', $message);
echo $hash;


?>