<?php
  session_start();
  require_once 'connector.php';
  $usercheck = $_SESSION['login_user'];
  $query = mysqli_query($conn, "select * from user where uname = '".$usercheck."'");
  $row = mysqli_fetch_array($query);
  $user_name = $row['fullname'];
  $uname = $row['uname'];
  $priv = $row['priv'];
  if (!isset($user_name)) {
    mysqli_close($conn);
    header("location: login.php");
  }
  if ($priv == "Administrator"){
    $kode_manager = "";
    $status_kode = "";
  } else {
    $kode_manager = "disabled";
    $status_kode = " (Khusus Admin)";
  }
 ?>