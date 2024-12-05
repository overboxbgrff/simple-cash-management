<?php
    //proses untuk page user

    $root = realpath($_SERVER['DOCUMENT_ROOT']);
    require $root."/kas/connector.php";
    require_once $root."/kas/session.php";

    
    if ($_GET['act'] == 'tambah-user'){
        //tambah kode kas
        if(empty($_POST['fullname']) || empty($_POST['uname']) || empty($_POST['passwd']) ){
            header('location:user-man.php');
        }else{
            $fullname = $_POST['fullname'];
            $uname = $_POST['uname'];
            $pw = $_POST['passwd'];
            $priv = $_POST['priv'];
            $passwd = base64_encode($pw);

            $fullname = mysqli_real_escape_string($conn,stripslashes($fullname));
            $uname = mysqli_real_escape_string($conn,stripslashes($uname));
            $passwd = mysqli_real_escape_string($conn,stripslashes($passwd));
            $priv = mysqli_real_escape_string($conn,stripslashes($priv));

            
            $input_km = mysqli_query($conn, "insert into user (fullname, uname, passwd, priv)
                                     VALUE ('$fullname', '$uname', '$passwd', '$priv')");
                                                    
            if($input_km){
                header('location:user-man.php');
            }
            mysqli_close($conn);
        }
    } elseif ($_GET['act'] == 'edit-user'){
        $id_user = $_GET['id'];
        if(empty($_POST['fullname']) || empty($_POST['uname']) || empty($_POST['passwd']) ){
            header('location:user-man.php');
        }else{
            $fullname = $_POST['fullname'];
            $uname = $_POST['uname'];
            $pw = $_POST['passwd'];
            $priv = $_POST['priv'];
            $passwd = base64_encode($pw);

            $fullname = mysqli_real_escape_string($conn,stripslashes($fullname));
            $uname = mysqli_real_escape_string($conn,stripslashes($uname));
            $passwd = mysqli_real_escape_string($conn,stripslashes($passwd));
            $priv = mysqli_real_escape_string($conn,stripslashes($priv));
            
            $edit_user = mysqli_query($conn, "UPDATE user SET fullname='$fullname', uname='$uname',
                                passwd='$passwd', priv='$priv'
                                WHERE id_user='$id_user'");
            if($edit_user){
                //echo "berhasil";
                header('location:user-man.php');
            } else{
                echo "GAGAL";
            }
            mysqli_close($conn);
        }                                            
    } elseif ($_GET['act'] == 'hapus_user'){
        //hapus_kode kas
        $id_user = $_GET['id'];
        $hapus_km = mysqli_query($conn,"DELETE FROM user WHERE id_user='$id_user'");
        if($hapus_km){
            header('location:user-man.php');
        }
        mysqli_close($conn);
    }
?>