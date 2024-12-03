<?php
    //proses untuk page kas keluar
    $root = realpath($_SERVER['DOCUMENT_ROOT']);
    require $root."/kas/connector.php";
    require_once $root."/kas/session.php";

    
    if ($_GET['act'] == 'tambah-kk'){
        //tambah kode kas
        if(empty($_POST['kode_kk']) || empty($_POST['desk_kk'])){
            header('location:kas-keluar-m.php');
        }else{
            $kode_kk = $_POST['kode_kk'];
            $desk_kk = $_POST['desk_kk'];
            $kode_kk = mysqli_real_escape_string($conn,stripslashes($kode_kk));
            $desk_kk = mysqli_real_escape_string($conn,stripslashes($desk_kk));
            $input_kk = mysqli_query($conn, "insert into jenis_kk (kode_kk, desk_kk)
                                     VALUE ('$kode_kk', '$desk_kk')");                            
            if($input_kk){
                header('location:kas-keluar-m.php');
            }
            mysqli_close($conn);
        }
    } elseif ($_GET['act'] == 'edit-kk'){
        //edit kode kas keluar
        $id_kk = $_GET['id'];   
        $kode_kk = $_POST['e_kode_kk'];
        $desk_kk = $_POST['e_desk_kk'];
        $kode_kk = mysqli_real_escape_string($conn,stripslashes($kode_kk));
        $desk_kk = mysqli_real_escape_string($conn,stripslashes($desk_kk));
        $edit_kk = mysqli_query($conn, "UPDATE jenis_kk SET kode_kk='$kode_kk',desk_kk='$desk_kk'
                                WHERE id_kk='$id_kk'");
                                                    
        if($edit_kk){
            //echo "berhasil";
            header('location:kas-keluar-m.php');
        } else{
            echo "GAGAL";
        }
        mysqli_close($conn);
    }elseif($_GET['act'] == 'hapus_kk'){
        //hapus kode kas keluar
        $id_kk = $_GET['id'];
        $hapus_kk = mysqli_query($conn,"DELETE FROM jenis_kk WHERE id_kk='$id_kk'");
        if($hapus_kk){
            header('location:kas-keluar-m.php');
        }
        mysqli_close($conn);
    } elseif ($_GET['act'] == 'tambah-kas'){
        $kode_kkk = "KK-".date("Ymd-His");
        //tambah kas keluar
        $tanggal_kk = $_POST['tanggal_kk'];


        $kode_kk = $_POST['kode_kk'];
        $uraian_kk = $_POST['uraian_kk'];
        $jumlah_kk = $_POST['jumlah_kk'];
        $tanggal_kk = mysqli_real_escape_string($conn,stripslashes($tanggal_kk));
        $kode_kk = mysqli_real_escape_string($conn,stripslashes($kode_kk));
        $uraian_kk = mysqli_real_escape_string($conn,stripslashes($uraian_kk));
        $jumlah_kk = mysqli_real_escape_string($conn,stripslashes($jumlah_kk));
        $input_kk = mysqli_query($conn, "INSERT INTO kas_keluar (id_kkk, tanggal_kk, kode_kk, uraian_kk, jumlah_kk)
                                     VALUES ('$kode_kkk','$tanggal_kk','$kode_kk', '$uraian_kk','$jumlah_kk')");
                                                    
        if($input_kk){
            header('location:kas-keluar.php');
        } else{
            echo "GAGAL";   
        }
        mysqli_close($conn);
    } elseif ($_GET['act'] == 'hapus_kas') {
        $id_kkk = $_GET['id'];
        $hapus_kkk = mysqli_query($conn,"DELETE FROM kas_keluar WHERE id_kkk='$id_kkk'");
        if($hapus_kkk){
            header('location:kas-keluar.php');
        }
        mysqli_close($conn);
    } elseif ($_GET['act'] == 'edit-kas') {
        //edit kas keluar
        $id_kkk = $_GET['id']; 

        $tanggal_kk = $_POST['tanggal_kk'];

        $kode_kk = $_POST['kode_kk'];
        $uraian_kk = $_POST['uraian_kk'];
        $jumlah_kk = $_POST['jumlah_kk'];
        $tanggal_kk = mysqli_real_escape_string($conn,stripslashes($tanggal_kk));
        $kode_kk = mysqli_real_escape_string($conn,stripslashes($kode_kk));
        $uraian_kk = mysqli_real_escape_string($conn,stripslashes($uraian_kk));
        $jumlah_kk = mysqli_real_escape_string($conn,stripslashes($jumlah_kk));
        $edit_kas = mysqli_query($conn,"UPDATE kas_keluar SET
                                tanggal_kk='$tanggal_kk', kode_kk='$kode_kk', uraian_kk='$uraian_kk', jumlah_kk='$jumlah_kk'
                                WHERE id_kkk='$id_kkk'");
        if($edit_kas){
            header('location:kas-keluar.php');
        }
    }
?>