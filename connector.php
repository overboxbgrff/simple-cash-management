<?php
    //koneksikan PHP dengan MySQL
    
    $conn = mysqli_conect("127.0.0.1" , "root" , "");
    $db = mysqli_select_db($conn, 'test');
?>