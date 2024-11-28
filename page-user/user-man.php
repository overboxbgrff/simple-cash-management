<?php
    $root = realpath($_SERVER['DOCUMENT_ROOT']);
    require_once $root."/kas/connector.php";
    require_once $root."/kas/session.php";

    //blokir page jika bukan admin
    if ($priv != "Administrator"){
        header("location: ../homepage.php");
    }

    

    $cek_user = mysqli_query($conn,"select * from user");
    
    //pagination
    $data_pages = 10;
    $pages = (isset($_GET['pages'])) ? (int)$_GET['pages'] : 1;
    $start_pages = ($pages > 1) ? ($pages * $data_pages) - $data_pages : 0;
    $cu_pagination = mysqli_query($conn,"select * from user");
    $total = mysqli_num_rows($cu_pagination);
    $hal = ceil($total/$data_pages)
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<!-- BS Initialize-->
    <script src="../lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.min.css">
<!-- FA Initialize -->
    <script src="../lib/font-awesome/js/solid.min.js"></script>
    <script src="../lib/font-awesome/js/fontawesome.min.js"></script>
    <script src="../lib/font-awesome/js/brands.min.js"></script>

<body style="background-color: rgb(81, 50, 252);">
    <!--navbar-->
    <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">

        <div class="container-fluid">
            <a href="../homepage.php" class="navbar-brand"><i class="fa-solid fa-money-bill-transfer"> </i> Simple Cash Management (Trial)</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-receipt"> </i> Kas
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="kas-masuk.php" class="dropdown-item"><i class="fa solid fa-cash-register"> </i> Kas Pemasukan</a></li>
                            <li><a href="kas-keluar.php" class="dropdown-item"><i class="fa-solid fa-hand-holding-dollar"> </i> Kas Pengeluaran</a></li>                            
                            <li><hr class="dropdown-divider"></li>
                            <li><a href="rekap-kas.php" class="dropdown-item"><i class="fa-solid fa-box-archive"> </i> Rekap</a></li>
                            <li><a href="print-lapor.php" class="dropdown-item"><i class="fa-solid fa-print"> </i> Cetak</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-file-pen"> </i> Edit
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="kas-masuk-m.php" class="dropdown-item <?php echo $kode_manager;?>">
                                    <i class="fa-solid fa-file-pen"> </i> Kode Kas Masuk <?php echo $status_kode;?>
                                </a>
                            </li>
                            <li>
                                <a href="kas-keluar-m.php" class="dropdown-item <?php echo $kode_manager;?>">
                                    <i class="fa-solid fa-file-pen"> </i> Kode Kas Keluar <?php echo $status_kode;?>
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a href="user/user-man.php" class="dropdown-item <?php echo $kode_manager;?>">
                                    <i class="fa-solid fa-user-pen"> </i> User <?php echo $status_kode;?>
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>

                <ul class="navbar-nav d-flex">
                    <li class="nav-item"><a href="" class="nav-link"><i class="fa-solid fa-circle-info"> </i> About</a></li>
                    <li class="nav-item"><a href="../logout.php" class="nav-link text-danger"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                </ul>

            </div>
        </div>
    </nav>
    <br>
    <!--content-->
    <div class="container">
        <div class="card border-primary">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h1><i class="fa-solid fa-user-pen"> </i> Manajemen User</h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12"><br></div>
                </div>

                <!--Tabel Data-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr class="table-dark">
                                        <th scope="col">No.</th>
                                        <th scope="col">Nama Lengkap</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Hak Akses</th>
                                        <th scope="col" colspan="2" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($td = mysqli_fetch_array($cek_user)){ ?>
                                    <tr>
                                        <?php
                                            echo "<td>".$td['id_user']."</td>";
                                            echo "<td>".$td['fullname']."</td>";
                                            echo "<td>".$td['uname']."</td>";
                                            echo "<td>".$td['priv']."</td>";
                                        ?>
                                            <td><a href="" class="btn btn-outline-danger text-center"><i class="fa-solid fa-trash"></i> Hapus</a></td>
                                            <td><a href="" class="btn btn-outline-info text-center"><i class="fa-solid fa-pen-to-square"></i> Edit</a></td>
                                    </tr>
                                        <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>