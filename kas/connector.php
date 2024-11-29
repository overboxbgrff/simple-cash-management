<?php
    //koneksikan PHP dengan MySQL
    $conn = mysqli_connect("127.0.0.1" , "root" , "");

    //Koneksi ke database
    $db = mysqli_select_db($conn, 'kas');
?>