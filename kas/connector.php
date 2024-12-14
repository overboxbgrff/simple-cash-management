<?php
    //set waktu dan tanggal
    setlocale(LC_TIME, 'IND');
    date_default_timezone_set("Asia/Makassar");

    //koneksikan PHP dengan MySQL
    $conn = mysqli_connect("127.0.0.1" , "root" , "");

    //Koneksi ke database
    $db = mysqli_select_db($conn, 'kas');
?>