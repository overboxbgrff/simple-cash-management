<?php
    //inisialisasi koneksi
    require 'connector.php';
    session_start();
    $error_msg = "";

    //proses login
    if (isset($_POST['login'])){
        if(empty($_POST['uname']) || empty($_POST['passwd'])){
            $error_msg = "USERNAME DAN PASSWORD KOSOSNG!";
        } else {
            $uname = $_POST['uname'];
            $passwd = $_POST['passwd'];
            $enc_pw = base64_encode($passwd);

            $uname = mysqli_real_escape_string($conn,stripslashes($uname));
            $enc_pw = mysqli_real_escape_string($conn,stripslashes($enc_pw));

            $query = mysqli_query($conn, "select * from user where uname='".$uname."'
                    and passwd = '".$enc_pw."'");
            $row = mysqli_num_rows($query);
            if ($row == 1){
                $_SESSION['login_user'] = $uname;
                header('location: homepage.php');
            }else{
                $error = "Username atau Password Salah....";
            }
            mysqli_close($conn);
        }
    }
    if (isset($_SESSION['login_user'])) {
        header('location: homepage.php');
      }
?>