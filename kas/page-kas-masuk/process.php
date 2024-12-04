<?php
    //proses untuk page kas masuk

    $root = realpath($_SERVER['DOCUMENT_ROOT']);
    require $root."/kas/connector.php";
    require_once $root."/kas/session.php";

    
    if ($_GET['act'] == 'tambah-km'){
        //tambah kode kas
        if(empty($_POST['kode_km']) || empty($_POST['desk_km'])){
            header('location:kas-masuk-m.php');
        }else{
            $kode_km = $_POST['kode_km'];
            $desk_km = $_POST['desk_km'];
            $kode_km = mysqli_real_escape_string($conn,stripslashes($kode_km));
            $desk_km = mysqli_real_escape_string($conn,stripslashes($desk_km));
            $input_km = mysqli_query($conn, "insert into jenis_km (kode_km, desk_km)
                                     VALUE ('$kode_km', '$desk_km')");
                                                    
            if($input_km){
                header('location:kas-masuk-m.php');
            }
            mysqli_close($conn);
        }
    } elseif ($_GET['act'] == 'edit-km'){
        //edit kode kas
        $id_km = $_GET['id'];   
        $kode_km = $_POST['e_kode_km'];
        $desk_km = $_POST['e_desk_km'];
        $kode_km = mysqli_real_escape_string($conn,stripslashes($kode_km));
        $desk_km = mysqli_real_escape_string($conn,stripslashes($desk_km));
        $edit_km = mysqli_query($conn, "UPDATE jenis_km SET kode_km='$kode_km',desk_km='$desk_km'
                                WHERE id_km='$id_km'");
                                                    
        if($edit_km){
            //echo "berhasil";
            header('location:kas-masuk-m.php');
        } else{
            echo "GAGAL";
        }
        mysqli_close($conn);
    } elseif ($_GET['act'] == 'hapus_km'){
        //hapus_kode kas
        $id_km = $_GET['id'];
        $hapus_km = mysqli_query($conn,"DELETE FROM jenis_km WHERE id_km='$id_km'");
        if($hapus_km){
            header('location:kas-masuk-m.php');
        }
        mysqli_close($conn);
    } elseif ($_GET['act'] == 'tambah-kas'){
        //tambah kas masuk
        $kode_kkm = "KM-".date("Ymd-His");
        
        $tanggal_km = $_POST['tanggal_km'];

        $kode_km = $_POST['kode_km'];
        $uraian_km = $_POST['uraian_km'];
        $jumlah_km = $_POST['jumlah_km'];
        $tanggal_km = mysqli_real_escape_string($conn,stripslashes($tanggal_km));
        $kode_km = mysqli_real_escape_string($conn,stripslashes($kode_km));
        $uraian_km = mysqli_real_escape_string($conn,stripslashes($uraian_km));
        $jumlah_km = mysqli_real_escape_string($conn,stripslashes($jumlah_km));
        $input_km = mysqli_query($conn, "INSERT INTO kas_masuk (id_kkm, tanggal_km, kode_km, uraian_km, jumlah_km)
                                     VALUES ('$kode_kkm','$tanggal_km','$kode_km', '$uraian_km','$jumlah_km')");
        mysqli_close($conn);                                                            
        if($input_km){
            header('location:kas-masuk.php');
        } else{
            echo "GAGAL";   
        }
        
    } elseif ($_GET['act'] == 'hapus_kas') {
        $id_kkm = $_GET['id'];
        $hapus_kkm = mysqli_query($conn,"DELETE FROM kas_masuk WHERE id_kkm='$id_kkm'");
        if($hapus_kkm){
            header('location:kas-masuk.php');
        }
        mysqli_close($conn);
    } elseif ($_GET['act'] == 'edit-kas') {
        //edit kas masuk
        $id_kkm = $_GET['id']; 
        $tanggal_km = $_POST['tanggal_km'];
        $kode_km = $_POST['kode_km'];
        $uraian_km = $_POST['uraian_km'];
        $jumlah_km = $_POST['jumlah_km'];
        $tanggal_km = mysqli_real_escape_string($conn,stripslashes($tanggal_km));
        $kode_km = mysqli_real_escape_string($conn,stripslashes($kode_km));
        $uraian_km = mysqli_real_escape_string($conn,stripslashes($uraian_km));
        $jumlah_km = mysqli_real_escape_string($conn,stripslashes($jumlah_km));
        $edit_kas = mysqli_query($conn,"UPDATE kas_masuk SET
                                tanggal_km='$tanggal_km', kode_km='$kode_km', uraian_km='$uraian_km', jumlah_km='$jumlah_km'
                                WHERE id_kkm='$id_kkm'");
        $edit_lapor = mysqli_query($conn,"UPDATE kas_masuk SET
                                tanggal_km='$tanggal_km', kode_km='$kode_km', uraian_km='$uraian_km', jumlah_km='$jumlah_km'
                                WHERE id_kkm='$id_kkm'");
        if($edit_kas){
            header('location:kas-masuk.php');
        }
    }
?>