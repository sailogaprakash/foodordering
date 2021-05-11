<?php
    
    session_start();
    //echo $_SESSION['tbl_user'];
    session_destroy();
    //echo 'session has destroyed';
   header ("Location: feedback.php");
?>