<?php
  session_start();
  require_once 'connector.php';
  $usercheck = $_SESSION['login_user'];
  $query = mysqli_query($conn, "select * from user where uname = '".$usercheck."'");
  $row = mysqli_fetch_array($query);
  $user_name = $row['fullname'];
  $uname = $row['uname'];
  if (!isset($user_name)) {
    mysqli_close($conn);
    header("location: login.php");
  }
 ?>