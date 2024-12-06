<?php
    require_once "connector.php";
    require_once "session.php"

    //pagination section
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cash Management - Tentang</title>
</head>
    <!-- BS Initialize-->
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
    <!-- FA Initialize -->
    <script src="lib/font-awesome/js/solid.min.js"></script>
    <script src="lib/font-awesome/js/fontawesome.min.js"></script>
    <script src="lib/font-awesome/js/brands.min.js"></script>
<body style="background-color: rgb(81, 50, 252);">
        <!--navbar-->
        <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
            <div class="container-fluid">
                <a href="homepage.php" class="navbar-brand"><i class="fa-solid fa-money-bill-transfer"> </i> Cash Management (Trial)</a>
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
                                <li><a href="page-kas-masuk/kas-masuk.php" class="dropdown-item"><i class="fa solid fa-cash-register"> </i> Kas Pemasukan</a></li>
                                <li><a href="page-kas-keluar/kas-keluar.php" class="dropdown-item"><i class="fa-solid fa-hand-holding-dollar"> </i> Kas Pengeluaran</a></li>                            
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
                                    <a href="page-kas-masuk/kas-masuk-m.php" class="dropdown-item <?php echo $kode_manager;?>">
                                        <i class="fa-solid fa-file-pen"> </i> Kode Kas Masuk <?php echo $status_kode;?>
                                    </a>
                                </li>
                                <li>
                                    <a href="page-kas-keluar/kas-keluar-m.php" class="dropdown-item <?php echo $kode_manager;?>">
                                        <i class="fa-solid fa-file-pen"> </i> Kode Kas Keluar <?php echo $status_kode;?>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a href="page-user/user-man.php" class="dropdown-item <?php echo $kode_manager;?>">
                                        <i class="fa-solid fa-user-pen"> </i> User <?php echo $status_kode;?>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>

                    <ul class="navbar-nav d-flex">
                        <li class="nav-item"><a href="about.php" class="nav-link"><i class="fa-solid fa-circle-info"> </i> About</a></li>
                        <li class="nav-item"><a href="logout.php" class="nav-link text-danger"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                    </ul>

                </div>
            </div>
        </nav>
        <br>

        <!-- content -->
        <div class="container">
            <div class="card border-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1><i class="fa-solid fa-circle-info"> </i> Tentang</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12"><br></div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="fst-italic fw-bolder">Simple Cash Management</h2>
                            <h3 class="fst-italic">Kelompok 1 - Capstone Project. 2024.</h3>
                            <h5><i class="fa-solid fa-user"></i> Danang Priyombodo (041904023)</h5>
                            <h5><i class="fa-solid fa-user"></i> Dorkas (041928133)</h5>
                            <h5><i class="fa-solid fa-user"></i> Faradila Utami (042188675)</h5>
                            <h5><i class="fa-solid fa-user"></i> Indra Mursalin (041917581)</h5>
                            <h5><i class="fa-solid fa-user"></i> Siti Khoirunnisa (042166963)</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end content -->

<br>
</body>
</html>